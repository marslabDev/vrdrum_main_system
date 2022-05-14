<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentWorkRequest;
use App\Http\Requests\UpdateStudentWorkRequest;
use App\Http\Resources\Admin\StudentWorkResource;
use App\Models\StudentWork;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentWorkApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('student_work_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentWorkResource(StudentWork::with(['lesson_time', 'created_by'])->get());
    }

    public function store(StoreStudentWorkRequest $request)
    {
        $studentWork = StudentWork::create($request->all());

        return (new StudentWorkResource($studentWork))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StudentWork $studentWork)
    {
        abort_if(Gate::denies('student_work_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentWorkResource($studentWork->load(['lesson_time', 'created_by']));
    }

    public function update(UpdateStudentWorkRequest $request, StudentWork $studentWork)
    {
        $studentWork->update($request->all());

        return (new StudentWorkResource($studentWork))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StudentWork $studentWork)
    {
        abort_if(Gate::denies('student_work_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentWork->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
