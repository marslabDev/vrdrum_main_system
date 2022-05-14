<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonTimeRequest;
use App\Http\Requests\UpdateLessonTimeRequest;
use App\Http\Resources\Admin\LessonTimeResource;
use App\Models\LessonTime;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonTimeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lesson_time_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonTimeResource(LessonTime::with(['class_room', 'lesson', 'created_by'])->get());
    }

    public function store(StoreLessonTimeRequest $request)
    {
        $lessonTime = LessonTime::create($request->all());

        return (new LessonTimeResource($lessonTime))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(LessonTime $lessonTime)
    {
        abort_if(Gate::denies('lesson_time_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonTimeResource($lessonTime->load(['class_room', 'lesson', 'created_by']));
    }

    public function update(UpdateLessonTimeRequest $request, LessonTime $lessonTime)
    {
        $lessonTime->update($request->all());

        return (new LessonTimeResource($lessonTime))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(LessonTime $lessonTime)
    {
        abort_if(Gate::denies('lesson_time_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTime->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
