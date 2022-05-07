<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStudentDetailRequest;
use App\Http\Requests\StoreStudentDetailRequest;
use App\Http\Requests\UpdateStudentDetailRequest;
use App\Models\StudentDetail;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentDetailController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('student_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentDetails = StudentDetail::with(['student'])->get();

        return view('admin.studentDetails.index', compact('studentDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('student_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.studentDetails.create', compact('students'));
    }

    public function store(StoreStudentDetailRequest $request)
    {
        $studentDetail = StudentDetail::create($request->all());

        return redirect()->route('admin.student-details.index');
    }

    public function edit(StudentDetail $studentDetail)
    {
        abort_if(Gate::denies('student_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $studentDetail->load('student');

        return view('admin.studentDetails.edit', compact('studentDetail', 'students'));
    }

    public function update(UpdateStudentDetailRequest $request, StudentDetail $studentDetail)
    {
        $studentDetail->update($request->all());

        return redirect()->route('admin.student-details.index');
    }

    public function show(StudentDetail $studentDetail)
    {
        abort_if(Gate::denies('student_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentDetail->load('student');

        return view('admin.studentDetails.show', compact('studentDetail'));
    }

    public function destroy(StudentDetail $studentDetail)
    {
        abort_if(Gate::denies('student_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentDetailRequest $request)
    {
        StudentDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
