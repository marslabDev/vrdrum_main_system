<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentLessonProgressRequest;
use App\Http\Requests\UpdateStudentLessonProgressRequest;
use App\Http\Resources\Admin\StudentLessonProgressResource;
use App\Models\StudentLessonProgress;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentLessonProgressApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('student_lesson_progress_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentLessonProgressResource(StudentLessonProgress::with(['lesson_category', 'created_by'])->get());
    }

    public function store(StoreStudentLessonProgressRequest $request)
    {
        $studentLessonProgress = StudentLessonProgress::create($request->all());

        return (new StudentLessonProgressResource($studentLessonProgress))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StudentLessonProgress $studentLessonProgress)
    {
        abort_if(Gate::denies('student_lesson_progress_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentLessonProgressResource($studentLessonProgress->load(['lesson_category', 'created_by']));
    }

    public function update(UpdateStudentLessonProgressRequest $request, StudentLessonProgress $studentLessonProgress)
    {
        $studentLessonProgress->update($request->all());

        return (new StudentLessonProgressResource($studentLessonProgress))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StudentLessonProgress $studentLessonProgress)
    {
        abort_if(Gate::denies('student_lesson_progress_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentLessonProgress->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
