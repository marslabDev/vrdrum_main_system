<?php

namespace App\Http\Controllers\Function;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStudentLessonProgressRequest;
use App\Http\Requests\StoreStudentLessonProgressRequest;
use App\Http\Requests\UpdateStudentLessonProgressRequest;
use App\Models\LessonCategory;
use App\Models\LessonLevel;
use App\Models\Lesson;
use App\Models\StudentLessonProgress;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StudentLessonProgressControlController extends Controller
{
    public function toNextLevel($id) {
        abort_if(Gate::denies('student_lesson_progress_upgrade'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student_lesson_progress = StudentLessonProgress::find($id);
        
        $progress_ary = explode(",", $student_lesson_progress->progress);
        $level = (int)$progress_ary[0];
        $lesson = (int)$progress_ary[1];

        $current_lesson_level = LessonLevel::find($level);
        $total_lesson_level = LessonLevel::where('lesson_category_id', $student_lesson_progress->lesson_category_id)->get();
        $total_lesson = Lesson::where('lesson_level_id', $current_lesson_level->id)->get();

        $new_progress = '';
        
        if($lesson + 1 <= count($total_lesson)){
            $new_progress = $level . ',' . $lesson + 1;
        }else if($level + 1 <= count($total_lesson_level)){
            $next_lesson_level = null;

            foreach ($total_lesson_level as $index => $value){
                if($value->level == $level + 1){
                    $next_lesson_level = $value;
                    break;
                }
            }
            
            if($next_lesson_level != null){
                $total_lesson = Lesson::where('lesson_level_id', $next_lesson_level->id)->get();

                if(count($total_lesson) >= 1){
                    $new_progress = $level + 1 . ',1';
                }
            }
        }

        if ($new_progress != ''){
            $student_lesson_progress_ary = [];
            $student_lesson_progress_ary['progress'] = $new_progress;

            $student_lesson_progress->update($student_lesson_progress_ary);
        }

        return redirect()->route('admin.student-lesson-progresses.index');
    }

    public function toLowLevel($id) {
        abort_if(Gate::denies('student_lesson_progress_downgrade'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student_lesson_progress = StudentLessonProgress::find($id);
        
        $progress_ary = explode(",", $student_lesson_progress->progress);
        $level = (int)$progress_ary[0];
        $lesson = (int)$progress_ary[1];

        $total_lesson_level = LessonLevel::where('lesson_category_id', $student_lesson_progress->lesson_category_id)->get();

        $new_progress = '';
        
        if($lesson - 1 >= 1){
            $new_progress = $level . ',' . $lesson - 1;
        }else if($level - 1 >= 1){
            $low_lesson_level = null;

            foreach ($total_lesson_level as $index => $value){
                if($value->level == $level - 1){
                    $low_lesson_level = $value;
                    break;
                }
            }
            
            if($low_lesson_level != null){
                $total_lesson = Lesson::where('lesson_level_id', $low_lesson_level->id)->get();

                if(count($total_lesson) >= 1){
                    $new_progress = $level - 1 . ',' . count($total_lesson);
                }
            }
        }

        if ($new_progress != ''){
            $student_lesson_progress_ary = [];
            $student_lesson_progress_ary['progress'] = $new_progress;

            $student_lesson_progress->update($student_lesson_progress_ary);
        }

        return redirect()->route('admin.student-lesson-progresses.index');
    }
}
