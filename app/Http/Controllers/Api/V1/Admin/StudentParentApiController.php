<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentParentRequest;
use App\Http\Requests\UpdateStudentParentRequest;
use App\Http\Resources\Admin\StudentParentResource;
use App\Models\StudentParent;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentParentApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('student_parent_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentParentResource(StudentParent::with(['created_by', 'user'])->get());
    }

    public function store(StoreStudentParentRequest $request)
    {
        $studentParent = StudentParent::create($request->all());

        return (new StudentParentResource($studentParent))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(StudentParent $studentParent)
    {
        abort_if(Gate::denies('student_parent_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StudentParentResource($studentParent->load(['created_by', 'user']));
    }

    public function update(UpdateStudentParentRequest $request, StudentParent $studentParent)
    {
        $studentParent->update($request->all());

        return (new StudentParentResource($studentParent))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(StudentParent $studentParent)
    {
        abort_if(Gate::denies('student_parent_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentParent->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
