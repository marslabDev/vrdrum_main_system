<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonLevelRequest;
use App\Http\Requests\UpdateLessonLevelRequest;
use App\Http\Resources\Admin\LessonLevelResource;
use App\Models\LessonLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonLevelApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lesson_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonLevelResource(LessonLevel::with(['lesson_category', 'created_by'])->get());
    }

    public function store(StoreLessonLevelRequest $request)
    {
        $lessonLevel = LessonLevel::create($request->all());

        return (new LessonLevelResource($lessonLevel))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(LessonLevel $lessonLevel)
    {
        abort_if(Gate::denies('lesson_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonLevelResource($lessonLevel->load(['lesson_category', 'created_by']));
    }

    public function update(UpdateLessonLevelRequest $request, LessonLevel $lessonLevel)
    {
        $lessonLevel->update($request->all());

        return (new LessonLevelResource($lessonLevel))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(LessonLevel $lessonLevel)
    {
        abort_if(Gate::denies('lesson_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonLevel->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
