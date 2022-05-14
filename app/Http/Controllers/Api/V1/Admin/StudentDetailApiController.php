<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentDetailRequest;
use App\Http\Requests\UpdateStudentDetailRequest;
use App\Http\Resources\Admin\StudentDetailResource;
use App\Models\StudentDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentDetailApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('student_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentDetailResource(StudentDetail::with(['created_by'])->get());
    }

    public function store(StoreStudentDetailRequest $request)
    {
        $studentDetail = StudentDetail::create($request->all());

        return (new StudentDetailResource($studentDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StudentDetail $studentDetail)
    {
        abort_if(Gate::denies('student_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentDetailResource($studentDetail->load(['created_by']));
    }

    public function update(UpdateStudentDetailRequest $request, StudentDetail $studentDetail)
    {
        $studentDetail->update($request->all());

        return (new StudentDetailResource($studentDetail))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StudentDetail $studentDetail)
    {
        abort_if(Gate::denies('student_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
