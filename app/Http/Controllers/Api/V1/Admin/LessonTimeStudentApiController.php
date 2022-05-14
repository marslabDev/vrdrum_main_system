<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonTimeStudentRequest;
use App\Http\Requests\UpdateLessonTimeStudentRequest;
use App\Http\Resources\Admin\LessonTimeStudentResource;
use App\Models\LessonTimeStudent;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonTimeStudentApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('lesson_time_student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonTimeStudentResource(LessonTimeStudent::with(['lesson_time', 'created_by'])->get());
    }

    public function store(StoreLessonTimeStudentRequest $request)
    {
        $lessonTimeStudent = LessonTimeStudent::create($request->all());

        return (new LessonTimeStudentResource($lessonTimeStudent))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(LessonTimeStudent $lessonTimeStudent)
    {
        abort_if(Gate::denies('lesson_time_student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonTimeStudentResource($lessonTimeStudent->load(['lesson_time', 'created_by']));
    }

    public function update(UpdateLessonTimeStudentRequest $request, LessonTimeStudent $lessonTimeStudent)
    {
        $lessonTimeStudent->update($request->all());

        return (new LessonTimeStudentResource($lessonTimeStudent))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(LessonTimeStudent $lessonTimeStudent)
    {
        abort_if(Gate::denies('lesson_time_student_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTimeStudent->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
