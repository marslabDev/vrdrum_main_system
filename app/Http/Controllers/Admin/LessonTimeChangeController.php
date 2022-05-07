<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLessonTimeChangeRequest;
use App\Http\Requests\StoreLessonTimeChangeRequest;
use App\Http\Requests\UpdateLessonTimeChangeRequest;
use App\Models\ClassRoom;
use App\Models\Lesson;
use App\Models\LessonTime;
use App\Models\LessonTimeChange;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonTimeChangeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lesson_time_change_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTimeChanges = LessonTimeChange::with(['old_lesson_time', 'class_room', 'lesson', 'student', 'request_user', 'response_user'])->get();

        return view('admin.lessonTimeChanges.index', compact('lessonTimeChanges'));
    }

    public function create()
    {
        abort_if(Gate::denies('lesson_time_change_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $old_lesson_times = LessonTime::pluck('lesson_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $class_rooms = ClassRoom::pluck('room_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessons = Lesson::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $request_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $response_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lessonTimeChanges.create', compact('class_rooms', 'lessons', 'old_lesson_times', 'request_users', 'response_users', 'students'));
    }

    public function store(StoreLessonTimeChangeRequest $request)
    {
        $lessonTimeChange = LessonTimeChange::create($request->all());

        return redirect()->route('admin.lesson-time-changes.index');
    }

    public function edit(LessonTimeChange $lessonTimeChange)
    {
        abort_if(Gate::denies('lesson_time_change_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $old_lesson_times = LessonTime::pluck('lesson_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $class_rooms = ClassRoom::pluck('room_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessons = Lesson::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $request_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $response_users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessonTimeChange->load('old_lesson_time', 'class_room', 'lesson', 'student', 'request_user', 'response_user');

        return view('admin.lessonTimeChanges.edit', compact('class_rooms', 'lessonTimeChange', 'lessons', 'old_lesson_times', 'request_users', 'response_users', 'students'));
    }

    public function update(UpdateLessonTimeChangeRequest $request, LessonTimeChange $lessonTimeChange)
    {
        $lessonTimeChange->update($request->all());

        return redirect()->route('admin.lesson-time-changes.index');
    }

    public function show(LessonTimeChange $lessonTimeChange)
    {
        abort_if(Gate::denies('lesson_time_change_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTimeChange->load('old_lesson_time', 'class_room', 'lesson', 'student', 'request_user', 'response_user');

        return view('admin.lessonTimeChanges.show', compact('lessonTimeChange'));
    }

    public function destroy(LessonTimeChange $lessonTimeChange)
    {
        abort_if(Gate::denies('lesson_time_change_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTimeChange->delete();

        return back();
    }

    public function massDestroy(MassDestroyLessonTimeChangeRequest $request)
    {
        LessonTimeChange::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
