<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyWorkCommentRequest;
use App\Http\Requests\StoreWorkCommentRequest;
use App\Http\Requests\UpdateWorkCommentRequest;
use App\Models\StudentWork;
use App\Models\WorkComment;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WorkCommentController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('work_comment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = WorkComment::with(['student_work', 'created_by'])->select(sprintf('%s.*', (new WorkComment())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'work_comment_show';
                $editGate = 'work_comment_edit';
                $deleteGate = 'work_comment_delete';
                $crudRoutePart = 'work-comments';

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
            $table->editColumn('content', function ($row) {
                return $row->content ? $row->content : '';
            });
            $table->editColumn('attachment', function ($row) {
                if ($photo = $row->attachment) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->addColumn('student_work_title', function ($row) {
                return $row->student_work ? $row->student_work->title : '';
            });

            $table->editColumn('sender_efk', function ($row) {
                return $row->sender_efk ? $row->sender_efk : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'attachment', 'student_work']);

            return $table->make(true);
        }

        return view('admin.workComments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('work_comment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student_works = StudentWork::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.workComments.create', compact('student_works'));
    }

    public function store(StoreWorkCommentRequest $request)
    {
        $workComment = WorkComment::create($request->all());

        if ($request->input('attachment', false)) {
            $workComment->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $workComment->id]);
        }

        return redirect()->route('admin.work-comments.index');
    }

    public function edit(WorkComment $workComment)
    {
        abort_if(Gate::denies('work_comment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student_works = StudentWork::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workComment->load('student_work', 'created_by');

        return view('admin.workComments.edit', compact('student_works', 'workComment'));
    }

    public function update(UpdateWorkCommentRequest $request, WorkComment $workComment)
    {
        $workComment->update($request->all());

        if ($request->input('attachment', false)) {
            if (!$workComment->attachment || $request->input('attachment') !== $workComment->attachment->file_name) {
                if ($workComment->attachment) {
                    $workComment->attachment->delete();
                }
                $workComment->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
            }
        } elseif ($workComment->attachment) {
            $workComment->attachment->delete();
        }

        return redirect()->route('admin.work-comments.index');
    }

    public function show(WorkComment $workComment)
    {
        abort_if(Gate::denies('work_comment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workComment->load('student_work', 'created_by');

        return view('admin.workComments.show', compact('workComment'));
    }

    public function destroy(WorkComment $workComment)
    {
        abort_if(Gate::denies('work_comment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workComment->delete();

        return back();
    }

    public function massDestroy(MassDestroyWorkCommentRequest $request)
    {
        WorkComment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('work_comment_create') && Gate::denies('work_comment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new WorkComment();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
