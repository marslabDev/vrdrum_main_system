<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLessonTimeCoachRequest;
use App\Http\Requests\StoreLessonTimeCoachRequest;
use App\Http\Requests\UpdateLessonTimeCoachRequest;
use App\Models\LessonTime;
use App\Models\LessonTimeCoach;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonTimeCoachController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lesson_time_coach_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTimeCoaches = LessonTimeCoach::with(['lesson_time', 'coach'])->get();

        return view('admin.lessonTimeCoaches.index', compact('lessonTimeCoaches'));
    }

    public function create()
    {
        abort_if(Gate::denies('lesson_time_coach_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_times = LessonTime::pluck('lesson_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $coaches = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lessonTimeCoaches.create', compact('coaches', 'lesson_times'));
    }

    public function store(StoreLessonTimeCoachRequest $request)
    {
        $lessonTimeCoach = LessonTimeCoach::create($request->all());

        return redirect()->route('admin.lesson-time-coaches.index');
    }

    public function edit(LessonTimeCoach $lessonTimeCoach)
    {
        abort_if(Gate::denies('lesson_time_coach_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_times = LessonTime::pluck('lesson_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $coaches = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessonTimeCoach->load('lesson_time', 'coach');

        return view('admin.lessonTimeCoaches.edit', compact('coaches', 'lessonTimeCoach', 'lesson_times'));
    }

    public function update(UpdateLessonTimeCoachRequest $request, LessonTimeCoach $lessonTimeCoach)
    {
        $lessonTimeCoach->update($request->all());

        return redirect()->route('admin.lesson-time-coaches.index');
    }

    public function show(LessonTimeCoach $lessonTimeCoach)
    {
        abort_if(Gate::denies('lesson_time_coach_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTimeCoach->load('lesson_time', 'coach');

        return view('admin.lessonTimeCoaches.show', compact('lessonTimeCoach'));
    }

    public function destroy(LessonTimeCoach $lessonTimeCoach)
    {
        abort_if(Gate::denies('lesson_time_coach_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTimeCoach->delete();

        return back();
    }

    public function massDestroy(MassDestroyLessonTimeCoachRequest $request)
    {
        LessonTimeCoach::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
