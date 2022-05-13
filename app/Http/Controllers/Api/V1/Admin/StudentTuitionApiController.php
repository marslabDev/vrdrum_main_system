<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentTuitionRequest;
use App\Http\Requests\UpdateStudentTuitionRequest;
use App\Http\Resources\Admin\StudentTuitionResource;
use App\Models\StudentTuition;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentTuitionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('student_tuition_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentTuitionResource(StudentTuition::with(['tuition_package', 'created_by'])->get());
    }

    public function store(StoreStudentTuitionRequest $request)
    {
        $studentTuition = StudentTuition::create($request->all());

        return (new StudentTuitionResource($studentTuition))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StudentTuition $studentTuition)
    {
        abort_if(Gate::denies('student_tuition_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentTuitionResource($studentTuition->load(['tuition_package', 'created_by']));
    }

    public function update(UpdateStudentTuitionRequest $request, StudentTuition $studentTuition)
    {
        $studentTuition->update($request->all());

        return (new StudentTuitionResource($studentTuition))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StudentTuition $studentTuition)
    {
        abort_if(Gate::denies('student_tuition_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentTuition->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
