<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentMetumRequest;
use App\Http\Requests\UpdateStudentMetumRequest;
use App\Http\Resources\Admin\StudentMetumResource;
use App\Models\StudentMetum;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentMetaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('student_metum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentMetumResource(StudentMetum::with(['created_by'])->get());
    }

    public function store(StoreStudentMetumRequest $request)
    {
        $studentMetum = StudentMetum::create($request->all());

        return (new StudentMetumResource($studentMetum))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StudentMetum $studentMetum)
    {
        abort_if(Gate::denies('student_metum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentMetumResource($studentMetum->load(['created_by']));
    }

    public function update(UpdateStudentMetumRequest $request, StudentMetum $studentMetum)
    {
        $studentMetum->update($request->all());

        return (new StudentMetumResource($studentMetum))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StudentMetum $studentMetum)
    {
        abort_if(Gate::denies('student_metum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentMetum->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
