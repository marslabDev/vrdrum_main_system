<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStudentMetumRequest;
use App\Http\Requests\StoreStudentMetumRequest;
use App\Http\Requests\UpdateStudentMetumRequest;
use App\Models\StudentMetum;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentMetaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('student_metum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentMeta = StudentMetum::with(['student'])->get();

        return view('admin.studentMeta.index', compact('studentMeta'));
    }

    public function create()
    {
        abort_if(Gate::denies('student_metum_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.studentMeta.create', compact('students'));
    }

    public function store(StoreStudentMetumRequest $request)
    {
        $studentMetum = StudentMetum::create($request->all());

        return redirect()->route('admin.student-meta.index');
    }

    public function edit(StudentMetum $studentMetum)
    {
        abort_if(Gate::denies('student_metum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $students = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $studentMetum->load('student');

        return view('admin.studentMeta.edit', compact('studentMetum', 'students'));
    }

    public function update(UpdateStudentMetumRequest $request, StudentMetum $studentMetum)
    {
        $studentMetum->update($request->all());

        return redirect()->route('admin.student-meta.index');
    }

    public function show(StudentMetum $studentMetum)
    {
        abort_if(Gate::denies('student_metum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentMetum->load('student');

        return view('admin.studentMeta.show', compact('studentMetum'));
    }

    public function destroy(StudentMetum $studentMetum)
    {
        abort_if(Gate::denies('student_metum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentMetum->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentMetumRequest $request)
    {
        StudentMetum::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
