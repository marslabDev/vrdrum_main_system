<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLessonTimeChangeRequest;
use App\Http\Requests\StoreLessonTimeChangeRequest;
use App\Http\Requests\UpdateLessonTimeChangeRequest;
use App\Models\ClassRoom;
use App\Models\Lesson;
use App\Models\LessonTime;
use App\Models\LessonTimeCoach;
use App\Models\LessonTimeChange;
use Carbon\Carbon;
use Gate;
use Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

use App\Http\Controllers\Admin\LessonTimeChangeController;

class LessonTimeChangeActionController extends Controller
{
    public function toApproved($id)
    {
        $lesson_time_change = LessonTimeChange::find($id);
        $lesson_time = LessonTime::find($lesson_time_change->old_lesson_time_id);

        // ------------------------------ data assign ------------------------------
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date_now = Carbon::now()->toDateTimeString();

        $request_data['status'] = config('constants.lesson_time_change.status.approved');
        $request_data['response_user_efk'] = '5555';
        $request_data['response_date'] = $date_now;

        // ------------------------------ new lesson time create ------------------------------
        $new_lesson_time_ary = [];
        $new_lesson_time_ary['lesson_code'] = $lesson_time->lesson_code;
        $new_lesson_time_ary['date_from'] = $lesson_time_change->date_from;
        $new_lesson_time_ary['date_to'] = $lesson_time_change->date_to;
        $new_lesson_time_ary['class_room_id'] = $lesson_time_change->class_room_id;
        $new_lesson_time_ary['lesson_id'] = $lesson_time_change->lesson_id;
        $new_lesson_time_ary['student_efk'] = $lesson_time->student_efk;
        
        $new_lesson_time = LessonTime::create($new_lesson_time_ary);

        // ------------------------------ create lesson time coach for new lesson time ------------------------------
        $current_coachs_efk = LessonTimeCoach::where('lesson_time_id', $lesson_time->id)->get();
        foreach ($current_coachs_efk as $index => $value){
            $lesson_time_coach = [
                'lesson_time_id' => $new_lesson_time->id,
                'coach_efk' => $value->coach_efk
            ];

            LessonTimeCoach::create($lesson_time_coach);
        }

        // ------------------------------ update lesson time change ------------------------------
        $lesson_time_change->update($request_data);

        // ------------------------------ remove old lesson time ------------------------------
        $lesson_time->delete();

        return redirect()->route('admin.lesson-time-changes.index');
    }

    public function toRejected($id)
    {
        $lesson_time_change = LessonTimeChange::find($id);

        // ------------------------------ data assign ------------------------------
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date_now = Carbon::now()->toDateTimeString();

        $request_data['status'] = config('constants.lesson_time_change.status.rejected');
        $request_data['response_user_efk'] = '5555';
        $request_data['response_date'] = $date_now;

        $lesson_time_change->update($request_data);

        return redirect()->route('admin.lesson-time-changes.index');
    }
}
