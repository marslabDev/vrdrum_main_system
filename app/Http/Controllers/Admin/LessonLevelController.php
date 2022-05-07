<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLessonLevelRequest;
use App\Http\Requests\StoreLessonLevelRequest;
use App\Http\Requests\UpdateLessonLevelRequest;
use App\Models\LessonCategory;
use App\Models\LessonLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonLevelController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lesson_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonLevels = LessonLevel::with(['lesson_category'])->get();

        return view('admin.lessonLevels.index', compact('lessonLevels'));
    }

    public function create()
    {
        abort_if(Gate::denies('lesson_level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_categories = LessonCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lessonLevels.create', compact('lesson_categories'));
    }

    public function store(StoreLessonLevelRequest $request)
    {
        $lessonLevel = LessonLevel::create($request->all());

        return redirect()->route('admin.lesson-levels.index');
    }

    public function edit(LessonLevel $lessonLevel)
    {
        abort_if(Gate::denies('lesson_level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_categories = LessonCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessonLevel->load('lesson_category');

        return view('admin.lessonLevels.edit', compact('lessonLevel', 'lesson_categories'));
    }

    public function update(UpdateLessonLevelRequest $request, LessonLevel $lessonLevel)
    {
        $lessonLevel->update($request->all());

        return redirect()->route('admin.lesson-levels.index');
    }

    public function show(LessonLevel $lessonLevel)
    {
        abort_if(Gate::denies('lesson_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonLevel->load('lesson_category');

        return view('admin.lessonLevels.show', compact('lessonLevel'));
    }

    public function destroy(LessonLevel $lessonLevel)
    {
        abort_if(Gate::denies('lesson_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonLevel->delete();

        return back();
    }

    public function massDestroy(MassDestroyLessonLevelRequest $request)
    {
        LessonLevel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
