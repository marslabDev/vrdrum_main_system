<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStudentLessonProgressRequest;
use App\Http\Requests\StoreStudentLessonProgressRequest;
use App\Http\Requests\UpdateStudentLessonProgressRequest;
use App\Models\LessonCategory;
use App\Models\StudentLessonProgress;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentLessonProgressController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('student_lesson_progress_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentLessonProgresses = StudentLessonProgress::with(['lesson_category', 'student'])->get();

        return view('admin.studentLessonProgresses.index', compact('studentLessonProgresses'));
    }

    public function create()
    {
        abort_if(Gate::denies('student_lesson_progress_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_categories = LessonCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.studentLessonProgresses.create', compact('lesson_categories', 'students'));
    }

    public function store(StoreStudentLessonProgressRequest $request)
    {
        $studentLessonProgress = StudentLessonProgress::create($request->all());

        return redirect()->route('admin.student-lesson-progresses.index');
    }

    public function edit(StudentLessonProgress $studentLessonProgress)
    {
        abort_if(Gate::denies('student_lesson_progress_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_categories = LessonCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $studentLessonProgress->load('lesson_category', 'student');

        return view('admin.studentLessonProgresses.edit', compact('lesson_categories', 'studentLessonProgress', 'students'));
    }

    public function update(UpdateStudentLessonProgressRequest $request, StudentLessonProgress $studentLessonProgress)
    {
        $studentLessonProgress->update($request->all());

        return redirect()->route('admin.student-lesson-progresses.index');
    }

    public function show(StudentLessonProgress $studentLessonProgress)
    {
        abort_if(Gate::denies('student_lesson_progress_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentLessonProgress->load('lesson_category', 'student');

        return view('admin.studentLessonProgresses.show', compact('studentLessonProgress'));
    }

    public function destroy(StudentLessonProgress $studentLessonProgress)
    {
        abort_if(Gate::denies('student_lesson_progress_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentLessonProgress->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentLessonProgressRequest $request)
    {
        StudentLessonProgress::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
