<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLessonTimeRequest;
use App\Http\Requests\StoreLessonTimeRequest;
use App\Http\Requests\UpdateLessonTimeRequest;
use App\Models\ClassRoom;
use App\Models\Lesson;
use App\Models\LessonTime;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonTimeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lesson_time_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTimes = LessonTime::with(['class_room', 'lesson', 'student'])->get();

        return view('admin.lessonTimes.index', compact('lessonTimes'));
    }

    public function create()
    {
        abort_if(Gate::denies('lesson_time_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $class_rooms = ClassRoom::pluck('room_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessons = Lesson::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lessonTimes.create', compact('class_rooms', 'lessons', 'students'));
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

        $students = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessonTime->load('class_room', 'lesson', 'student');

        return view('admin.lessonTimes.edit', compact('class_rooms', 'lessonTime', 'lessons', 'students'));
    }

    public function update(UpdateLessonTimeRequest $request, LessonTime $lessonTime)
    {
        $lessonTime->update($request->all());

        return redirect()->route('admin.lesson-times.index');
    }

    public function show(LessonTime $lessonTime)
    {
        abort_if(Gate::denies('lesson_time_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTime->load('class_room', 'lesson', 'student');

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
