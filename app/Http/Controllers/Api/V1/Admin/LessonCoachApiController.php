<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonCoachRequest;
use App\Http\Requests\UpdateLessonCoachRequest;
use App\Http\Resources\Admin\LessonCoachResource;
use App\Models\LessonCoach;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonCoachApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lesson_coach_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonCoachResource(LessonCoach::with(['lesson', 'created_by'])->get());
    }

    public function store(StoreLessonCoachRequest $request)
    {
        $lessonCoach = LessonCoach::create($request->all());

        return (new LessonCoachResource($lessonCoach))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(LessonCoach $lessonCoach)
    {
        abort_if(Gate::denies('lesson_coach_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonCoachResource($lessonCoach->load(['lesson', 'created_by']));
    }

    public function update(UpdateLessonCoachRequest $request, LessonCoach $lessonCoach)
    {
        $lessonCoach->update($request->all());

        return (new LessonCoachResource($lessonCoach))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(LessonCoach $lessonCoach)
    {
        abort_if(Gate::denies('lesson_coach_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonCoach->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
