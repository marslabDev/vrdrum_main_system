<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonCategoryRequest;
use App\Http\Requests\UpdateLessonCategoryRequest;
use App\Http\Resources\Admin\LessonCategoryResource;
use App\Models\LessonCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonCategoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lesson_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonCategoryResource(LessonCategory::with(['created_by'])->get());
    }

    public function store(StoreLessonCategoryRequest $request)
    {
        $lessonCategory = LessonCategory::create($request->all());

        return (new LessonCategoryResource($lessonCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(LessonCategory $lessonCategory)
    {
        abort_if(Gate::denies('lesson_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonCategoryResource($lessonCategory->load(['created_by']));
    }

    public function update(UpdateLessonCategoryRequest $request, LessonCategory $lessonCategory)
    {
        $lessonCategory->update($request->all());

        return (new LessonCategoryResource($lessonCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(LessonCategory $lessonCategory)
    {
        abort_if(Gate::denies('lesson_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
