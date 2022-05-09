<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLessonTimeRequest;
use App\Http\Requests\StoreLessonTimeRequest;
use App\Http\Requests\UpdateLessonTimeRequest;
use App\Models\ClassRoom;
use App\Models\Lesson;
use App\Models\LessonTime;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LessonTimeController extends Controller
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

            $table->rawColumns(['actions', 'placeholder', 'class_room', 'lesson']);

            return $table->make(true);
        }

        return view('admin.lessonTimes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('lesson_time_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $class_rooms = ClassRoom::pluck('room_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessons = Lesson::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lessonTimes.create', compact('class_rooms', 'lessons'));
    }

    public function store(StoreLessonTimeRequest $request)
    {
        $lessonTime = LessonTime::create($request->all());

        return redirect()->route('admin.lesson-times.index');
    }

    public function edit(LessonTime $lessonTime)
    {
        abort_if(Gate::denies('lesson_time_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $class_rooms = ClassRoom::pluck('room_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessons = Lesson::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessonTime->load('class_room', 'lesson', 'created_by');

        return view('admin.lessonTimes.edit', compact('class_rooms', 'lessonTime', 'lessons'));
    }

    public function update(UpdateLessonTimeRequest $request, LessonTime $lessonTime)
    {
        $lessonTime->update($request->all());

        return redirect()->route('admin.lesson-times.index');
    }

    public function show(LessonTime $lessonTime)
    {
        abort_if(Gate::denies('lesson_time_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTime->load('class_room', 'lesson', 'created_by');

        return view('admin.lessonTimes.show', compact('lessonTime'));
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
