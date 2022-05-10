<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLessonTimeRequest;
use App\Http\Requests\StoreLessonTimeRequest;
use App\Http\Requests\UpdateLessonTimeRequest;
use App\Models\CoachDetail;
use App\Models\ClassRoom;
use App\Models\Lesson;
use App\Models\LessonCoach;
use App\Models\LessonTime;
use App\Models\LessonTimeCoach;
use Carbon\Carbon;
use Gate;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LessonTimeWithLessonTimeCoachController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('lesson_time_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LessonTime::with(['class_room', 'lesson', 'created_by'])->select(sprintf('%s.*', (new LessonTime())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'lesson_time_show';
                $editGate = 'lesson_time_edit';
                $deleteGate = 'lesson_time_delete';
                $crudRoutePart = 'lesson-times';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('lesson_code', function ($row) {
                return $row->lesson_code ? $row->lesson_code : '';
            });

            $table->addColumn('class_room_room_title', function ($row) {
                return $row->class_room ? $row->class_room->room_title : '';
            });

            $table->addColumn('lesson_name', function ($row) {
                return $row->lesson ? $row->lesson->name : '';
            });

            $table->editColumn('student_efk', function ($row) {
                return $row->student_efk ? $row->student_efk : '';
            });
            $table->addColumn('coachs_efk', function ($row) {
                $coachs_efk = LessonTimeCoach::where('lesson_time_id', $row->id)->get();

                $coachs_efk_str = [];
                foreach ($coachs_efk as $index => $value){
                    $coachs_efk_str[$index] = $value->coach_efk;
                }
                $coachs_efk_str = implode(", ", $coachs_efk_str);

                return $coachs_efk_str;
            });

            $table->rawColumns(['actions', 'placeholder', 'class_room', 'lesson']);

            return $table->make(true);
        }

        return view('admin.lessonTimes.index');
    }

    public function create($errors = null)
    {
        abort_if(Gate::denies('lesson_time_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $class_rooms = ClassRoom::pluck('room_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessons = Lesson::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lesson_coachs = [ "" => trans('cruds.lessonTimeCoach.fields.please_select') ];
        foreach ($lessons as $id => $value){
            if($id != ""){
                $lesson_coachs[$id] = LessonCoach::where('lesson_id', $id)->get();
            }
        }

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $dateNow = Carbon::now()->toDateTimeString();

        $lesson_time_used = LessonTime::where('date_from', '>', $dateNow)->get();
        foreach ($lesson_time_used as $time_index => $time_value){
            $lesson_time_coach = LessonTimeCoach::where('lesson_time_id', $time_value->id)->get();
            
            $coachs_efk = [];

            foreach ($lesson_time_coach as $index => $value){
                $coachs_efk[$index] = $value->coach_efk;
            }

            $lesson_time_used[$time_index]->coachs_efk = $coachs_efk;
        }

        if($errors != null) return view('admin.lessonTimes.create', compact('class_rooms', 'lessons', 'lesson_coachs', 'lesson_time_used', 'errors'));
        
        return view('admin.lessonTimes.create', compact('class_rooms', 'lessons', 'lesson_coachs', 'lesson_time_used'));
    }

    public function store(StoreLessonTimeRequest $request)
    {
        $request_data = $request->all();

        // ------------------------------ validation ------------------------------
        $validated = Validator::make([],[]);
        
        if ($request_data['class_room_id'] == null){
            $validated->getMessageBag()->add('class_room', trans('validation.class_room_required'));
        }

        if ($request_data['lesson_id'] == null){
            $validated->getMessageBag()->add('lesson', trans('validation.lesson_required'));
        }

        if (!array_key_exists('coachs_efk', $request_data)){
            $validated->getMessageBag()->add('lesson', trans('validation.coach_required'));

        }else if ($request_data['coachs_efk'] != null && count($request_data['coachs_efk']) <= 0){
            $validated->getMessageBag()->add('lesson', trans('validation.coach_required'));
        }

        if($validated->errors()->count() > 0){
            return $this->create($validated->errors());
        }

        // ------------------------------ data assign ------------------------------
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $dateNow = Carbon::now()->toDateTimeString();
        $newCode = '';

        do {
            $newCode = Str::uuid()->toString();
            $start = stripos($newCode, '-') + 1;
            $end   = strripos($newCode, '-');

            $newCode = substr($newCode, $start, $end - $start);

        } while (LessonTime::where([
            ['lesson_code', '=', $newCode],
            ['date_from', '>', $dateNow]
        ])->get()->first() != null);

        $dateTo = Carbon::parse($request_data['date_from']);
        $dateTo->addMinute(30);

        $request_data['lesson_code'] = $newCode;
        $request_data['date_to'] = $dateTo->toDateTimeString();

        $lessonTime = LessonTime::create($request_data);

        // ------------------------------ create lesson time coach ------------------------------
        $coachs_efk = $request_data['coachs_efk'];

        foreach ($coachs_efk as $index => $value){
            $lesson_time_coach = [
                'lesson_time_id' => $lessonTime->id,
                'coach_efk' => $value
            ];

            LessonTimeCoach::create($lesson_time_coach);
        }
        
        return redirect()->route('admin.lesson-times.index');
    }

    public function edit(LessonTime $lessonTime, $errors = null)
    {
        abort_if(Gate::denies('lesson_time_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $class_rooms = ClassRoom::pluck('room_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessons = Lesson::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessonTime->load('class_room', 'lesson', 'created_by');

        $lesson_coachs = [ "" => trans('cruds.lessonTimeCoach.fields.please_select') ];
        foreach ($lessons as $id => $value){
            if($id != ""){
                $lesson_coachs[$id] = LessonCoach::where('lesson_id', $id)->get();
            }
        }

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $dateNow = Carbon::now()->toDateTimeString();

        $lesson_time_used = LessonTime::where('date_from', '>', $dateNow)->get();
        foreach ($lesson_time_used as $time_index => $time_value){
            $lesson_time_coach = LessonTimeCoach::where('lesson_time_id', $time_value->id)->get();
            
            $coachs_efk = [];

            foreach ($lesson_time_coach as $index => $value){
                $coachs_efk[$index] = $value->coach_efk;
            }

            $lesson_time_used[$time_index]->coachs_efk = $coachs_efk;
        }

        if($errors != null) return view('admin.lessonTimes.edit', compact('class_rooms', 'lessonTime', 'lessons', 'lesson_coachs', 'lesson_time_used', 'errors'));

        return view('admin.lessonTimes.edit', compact('class_rooms', 'lessonTime', 'lessons', 'lesson_coachs', 'lesson_time_used'));
    }

    public function update(UpdateLessonTimeRequest $request, LessonTime $lessonTime)
    {
        $request_data = $request->all();

        // ------------------------------ validation ------------------------------
        $validated = Validator::make([],[]);
        
        if ($request_data['class_room_id'] == null){
            $validated->getMessageBag()->add('class_room', trans('validation.class_room_required'));
        }

        if ($request_data['lesson_id'] == null){
            $validated->getMessageBag()->add('lesson', trans('validation.lesson_required'));
        }

        if (!array_key_exists('coachs_efk', $request_data)){
            $validated->getMessageBag()->add('lesson', trans('validation.coach_required'));

        }else if ($request_data['coachs_efk'] != null && count($request_data['coachs_efk']) <= 0){
            $validated->getMessageBag()->add('lesson', trans('validation.coach_required'));
        }

        if($validated->errors()->count() > 0){
            return $this->edit($lessonTime, $validated->errors());
        }

        // ------------------------------ data assign ------------------------------
        $dateTo = Carbon::parse($request_data['date_from']);
        $dateTo->addMinute(30);

        $request_data['date_to'] = $dateTo->toDateTimeString();

        $lessonTime->update($request_data);

        // ------------------------------ create lesson time coach ------------------------------
        $current_coachs_efk = LessonTimeCoach::where('lesson_time_id', $lessonTime->id)->get();

        $coachs_efk = $request_data['coachs_efk'];

        // for create new coach & pop the same coach
        foreach ($coachs_efk as $index => $value){
            $lesson_time_coach = [
                'lesson_time_id' => $lessonTime->id,
                'coach_efk' => $value
            ];

            $is_found = false;

            foreach ($current_coachs_efk as $current_coach_index => $current_coach_value){
                if ($current_coach_value->lesson_time_id == $lesson_time_coach['lesson_time_id'] && $current_coach_value->coach_efk == $lesson_time_coach['coach_efk']){
                    unset($current_coachs_efk[$current_coach_index]);
                    $is_found = true;
                    break;
                }
            }

            if($is_found == false){
                LessonTimeCoach::create($lesson_time_coach);
            }
        }

        // for delete coach
        foreach ($current_coachs_efk as $index => $value){
            LessonTimeCoach::find($value->id)->delete();
        }

        return redirect()->route('admin.lesson-times.index');
    }

    public function show(LessonTime $lessonTime)
    {
        abort_if(Gate::denies('lesson_time_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTime->load('class_room', 'lesson', 'created_by');

        $lesson_time_coach_efk = LessonTimeCoach::where('lesson_time_id', $lessonTime->id)->get();

        $coachs_efk = [];
        foreach ($lesson_time_coach_efk as $index => $value){
            $coachs_efk[$index] = $value->coach_efk;
        }
        $coachs_efk = implode(", ", $coachs_efk);

        return view('admin.lessonTimes.show', compact('lessonTime', 'coachs_efk'));
    }

    public function destroy(LessonTime $lessonTime)
    {
        abort_if(Gate::denies('lesson_time_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTime->delete();

        return back();
    }

    public function massDestroy(MassDestroyLessonTimeRequest $request)
    {
        LessonTime::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
