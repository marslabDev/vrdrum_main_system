<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonTimeCoachRequest;
use App\Http\Requests\UpdateLessonTimeCoachRequest;
use App\Http\Resources\Admin\LessonTimeCoachResource;
use App\Models\LessonTimeCoach;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonTimeCoachApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lesson_time_coach_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonTimeCoachResource(LessonTimeCoach::with(['lesson_time', 'created_by'])->get());
    }

    public function store(StoreLessonTimeCoachRequest $request)
    {
        $lessonTimeCoach = LessonTimeCoach::create($request->all());

        return (new LessonTimeCoachResource($lessonTimeCoach))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(LessonTimeCoach $lessonTimeCoach)
    {
        abort_if(Gate::denies('lesson_time_coach_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonTimeCoachResource($lessonTimeCoach->load(['lesson_time', 'created_by']));
    }

    public function update(UpdateLessonTimeCoachRequest $request, LessonTimeCoach $lessonTimeCoach)
    {
        $lessonTimeCoach->update($request->all());

        return (new LessonTimeCoachResource($lessonTimeCoach))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(LessonTimeCoach $lessonTimeCoach)
    {
        abort_if(Gate::denies('lesson_time_coach_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTimeCoach->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
