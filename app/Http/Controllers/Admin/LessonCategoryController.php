<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLessonCategoryRequest;
use App\Http\Requests\StoreLessonCategoryRequest;
use App\Http\Requests\UpdateLessonCategoryRequest;
use App\Models\LessonCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lesson_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonCategories = LessonCategory::all();

        return view('admin.lessonCategories.index', compact('lessonCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('lesson_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lessonCategories.create');
    }

    public function store(StoreLessonCategoryRequest $request)
    {
        $lessonCategory = LessonCategory::create($request->all());

        return redirect()->route('admin.lesson-categories.index');
    }

    public function edit(LessonCategory $lessonCategory)
    {
        abort_if(Gate::denies('lesson_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lessonCategories.edit', compact('lessonCategory'));
    }

    public function update(UpdateLessonCategoryRequest $request, LessonCategory $lessonCategory)
    {
        $lessonCategory->update($request->all());

        return redirect()->route('admin.lesson-categories.index');
    }

    public function show(LessonCategory $lessonCategory)
    {
        abort_if(Gate::denies('lesson_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lessonCategories.show', compact('lessonCategory'));
    }

    public function destroy(LessonCategory $lessonCategory)
    {
        abort_if(Gate::denies('lesson_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyLessonCategoryRequest $request)
    {
        LessonCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
