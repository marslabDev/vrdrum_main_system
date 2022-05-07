<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySubmissionRequest;
use App\Http\Requests\StoreSubmissionRequest;
use App\Http\Requests\UpdateSubmissionRequest;
use App\Models\StudentWork;
use App\Models\Submission;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubmissionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('submission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $submissions = Submission::with(['student_work', 'student'])->get();

        return view('admin.submissions.index', compact('submissions'));
    }

    public function create()
    {
        abort_if(Gate::denies('submission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student_works = StudentWork::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.submissions.create', compact('student_works', 'students'));
    }

    public function store(StoreSubmissionRequest $request)
    {
        $submission = Submission::create($request->all());

        return redirect()->route('admin.submissions.index');
    }

    public function edit(Submission $submission)
    {
        abort_if(Gate::denies('submission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student_works = StudentWork::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $students = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $submission->load('student_work', 'student');

        return view('admin.submissions.edit', compact('student_works', 'students', 'submission'));
    }

    public function update(UpdateSubmissionRequest $request, Submission $submission)
    {
        $submission->update($request->all());

        return redirect()->route('admin.submissions.index');
    }

    public function show(Submission $submission)
    {
        abort_if(Gate::denies('submission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $submission->load('student_work', 'student');

        return view('admin.submissions.show', compact('submission'));
    }

    public function destroy(Submission $submission)
    {
        abort_if(Gate::denies('submission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $submission->delete();

        return back();
    }

    public function massDestroy(MassDestroySubmissionRequest $request)
    {
        Submission::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
