<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStudentWorkRequest;
use App\Http\Requests\StoreStudentWorkRequest;
use App\Http\Requests\UpdateStudentWorkRequest;
use App\Models\LessonTime;
use App\Models\StudentWork;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentWorkController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('student_work_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentWorks = StudentWork::with(['lesson_time'])->get();

        return view('admin.studentWorks.index', compact('studentWorks'));
    }

    public function create()
    {
        abort_if(Gate::denies('student_work_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_times = LessonTime::pluck('lesson_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.studentWorks.create', compact('lesson_times'));
    }

    public function store(StoreStudentWorkRequest $request)
    {
        $studentWork = StudentWork::create($request->all());

        return redirect()->route('admin.student-works.index');
    }

    public function edit(StudentWork $studentWork)
    {
        abort_if(Gate::denies('student_work_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_times = LessonTime::pluck('lesson_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $studentWork->load('lesson_time');

        return view('admin.studentWorks.edit', compact('lesson_times', 'studentWork'));
    }

    public function update(UpdateStudentWorkRequest $request, StudentWork $studentWork)
    {
        $studentWork->update($request->all());

        return redirect()->route('admin.student-works.index');
    }

    public function show(StudentWork $studentWork)
    {
        abort_if(Gate::denies('student_work_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentWork->load('lesson_time');

        return view('admin.studentWorks.show', compact('studentWork'));
    }

    public function destroy(StudentWork $studentWork)
    {
        abort_if(Gate::denies('student_work_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentWork->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentWorkRequest $request)
    {
        StudentWork::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
