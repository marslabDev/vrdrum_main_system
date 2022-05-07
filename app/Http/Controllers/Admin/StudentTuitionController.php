<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStudentTuitionRequest;
use App\Http\Requests\StoreStudentTuitionRequest;
use App\Http\Requests\UpdateStudentTuitionRequest;
use App\Models\StudentTuition;
use App\Models\TuitionPackage;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentTuitionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('student_tuition_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentTuitions = StudentTuition::with(['tuition_package', 'student'])->get();

        return view('admin.studentTuitions.index', compact('studentTuitions'));
    }

    public function create()
    {
        abort_if(Gate::denies('student_tuition_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tuition_packages = TuitionPackage::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.studentTuitions.create', compact('students', 'tuition_packages'));
    }

    public function store(StoreStudentTuitionRequest $request)
    {
        $studentTuition = StudentTuition::create($request->all());

        return redirect()->route('admin.student-tuitions.index');
    }

    public function edit(StudentTuition $studentTuition)
    {
        abort_if(Gate::denies('student_tuition_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tuition_packages = TuitionPackage::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $studentTuition->load('tuition_package', 'student');

        return view('admin.studentTuitions.edit', compact('studentTuition', 'students', 'tuition_packages'));
    }

    public function update(UpdateStudentTuitionRequest $request, StudentTuition $studentTuition)
    {
        $studentTuition->update($request->all());

        return redirect()->route('admin.student-tuitions.index');
    }

    public function show(StudentTuition $studentTuition)
    {
        abort_if(Gate::denies('student_tuition_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentTuition->load('tuition_package', 'student');

        return view('admin.studentTuitions.show', compact('studentTuition'));
    }

    public function destroy(StudentTuition $studentTuition)
    {
        abort_if(Gate::denies('student_tuition_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentTuition->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentTuitionRequest $request)
    {
        StudentTuition::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
