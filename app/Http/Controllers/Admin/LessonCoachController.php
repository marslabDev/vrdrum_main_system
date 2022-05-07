<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLessonCoachRequest;
use App\Http\Requests\StoreLessonCoachRequest;
use App\Http\Requests\UpdateLessonCoachRequest;
use App\Models\Lesson;
use App\Models\LessonCoach;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonCoachController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lesson_coach_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonCoaches = LessonCoach::with(['lesson', 'coach'])->get();

        return view('admin.lessonCoaches.index', compact('lessonCoaches'));
    }

    public function create()
    {
        abort_if(Gate::denies('lesson_coach_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessons = Lesson::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $coaches = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lessonCoaches.create', compact('coaches', 'lessons'));
    }

    public function store(StoreLessonCoachRequest $request)
    {
        $lessonCoach = LessonCoach::create($request->all());

        return redirect()->route('admin.lesson-coaches.index');
    }

    public function edit(LessonCoach $lessonCoach)
    {
        abort_if(Gate::denies('lesson_coach_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessons = Lesson::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $coaches = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessonCoach->load('lesson', 'coach');

        return view('admin.lessonCoaches.edit', compact('coaches', 'lessonCoach', 'lessons'));
    }

    public function update(UpdateLessonCoachRequest $request, LessonCoach $lessonCoach)
    {
        $lessonCoach->update($request->all());

        return redirect()->route('admin.lesson-coaches.index');
    }

    public function show(LessonCoach $lessonCoach)
    {
        abort_if(Gate::denies('lesson_coach_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonCoach->load('lesson', 'coach');

        return view('admin.lessonCoaches.show', compact('lessonCoach'));
    }

    public function destroy(LessonCoach $lessonCoach)
    {
        abort_if(Gate::denies('lesson_coach_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonCoach->delete();

        return back();
    }

    public function massDestroy(MassDestroyLessonCoachRequest $request)
    {
        LessonCoach::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
