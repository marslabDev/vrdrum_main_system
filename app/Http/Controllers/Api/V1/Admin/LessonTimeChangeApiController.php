<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonTimeChangeRequest;
use App\Http\Requests\UpdateLessonTimeChangeRequest;
use App\Http\Resources\Admin\LessonTimeChangeResource;
use App\Models\LessonTimeChange;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonTimeChangeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lesson_time_change_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonTimeChangeResource(LessonTimeChange::with(['old_lesson_time', 'class_room', 'lesson', 'created_by'])->get());
    }

    public function store(StoreLessonTimeChangeRequest $request)
    {
        $lessonTimeChange = LessonTimeChange::create($request->all());

        return (new LessonTimeChangeResource($lessonTimeChange))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(LessonTimeChange $lessonTimeChange)
    {
        abort_if(Gate::denies('lesson_time_change_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonTimeChangeResource($lessonTimeChange->load(['old_lesson_time', 'class_room', 'lesson', 'created_by']));
    }

    public function update(UpdateLessonTimeChangeRequest $request, LessonTimeChange $lessonTimeChange)
    {
        $lessonTimeChange->update($request->all());

        return (new LessonTimeChangeResource($lessonTimeChange))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(LessonTimeChange $lessonTimeChange)
    {
        abort_if(Gate::denies('lesson_time_change_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTimeChange->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
