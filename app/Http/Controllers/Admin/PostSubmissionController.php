<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyPostSubmissionRequest;
use App\Http\Requests\StorePostSubmissionRequest;
use App\Http\Requests\UpdatePostSubmissionRequest;
use App\Models\LessonTimePost;
use App\Models\PostSubmission;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PostSubmissionController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('post_submission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PostSubmission::with(['lesson_time_post', 'created_by'])->select(sprintf('%s.*', (new PostSubmission())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'post_submission_show';
                $editGate = 'post_submission_edit';
                $deleteGate = 'post_submission_delete';
                $crudRoutePart = 'post-submissions';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });

            $table->editColumn('mark', function ($row) {
                return $row->mark ? $row->mark : '';
            });

            $table->addColumn('lesson_time_post_title', function ($row) {
                return $row->lesson_time_post ? $row->lesson_time_post->title : '';
            });

            $table->editColumn('student_efk', function ($row) {
                return $row->student_efk ? $row->student_efk : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'lesson_time_post']);

            return $table->make(true);
        }

        return view('admin.postSubmissions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('post_submission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_time_posts = LessonTimePost::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.postSubmissions.create', compact('lesson_time_posts'));
    }

    public function store(StorePostSubmissionRequest $request)
    {
        $postSubmission = PostSubmission::create($request->all());

        return redirect()->route('admin.post-submissions.index');
    }

    public function edit(PostSubmission $postSubmission)
    {
        abort_if(Gate::denies('post_submission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_time_posts = LessonTimePost::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $postSubmission->load('lesson_time_post', 'created_by');

        return view('admin.postSubmissions.edit', compact('lesson_time_posts', 'postSubmission'));
    }

    public function update(UpdatePostSubmissionRequest $request, PostSubmission $postSubmission)
    {
        $postSubmission->update($request->all());

        return redirect()->route('admin.post-submissions.index');
    }

    public function show(PostSubmission $postSubmission)
    {
        abort_if(Gate::denies('post_submission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postSubmission->load('lesson_time_post', 'created_by');

        return view('admin.postSubmissions.show', compact('postSubmission'));
    }

    public function destroy(PostSubmission $postSubmission)
    {
        abort_if(Gate::denies('post_submission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postSubmission->delete();

        return back();
    }

    public function massDestroy(MassDestroyPostSubmissionRequest $request)
    {
        PostSubmission::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
