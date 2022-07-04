<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPostCommentRequest;
use App\Http\Requests\StorePostCommentRequest;
use App\Http\Requests\UpdatePostCommentRequest;
use App\Models\LessonTimePost;
use App\Models\PostComment;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PostCommentController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('post_comment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PostComment::with(['lesson_time_post', 'created_by'])->select(sprintf('%s.*', (new PostComment())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'post_comment_show';
                $editGate = 'post_comment_edit';
                $deleteGate = 'post_comment_delete';
                $crudRoutePart = 'post-comments';

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
            $table->editColumn('attachment', function ($row) {
                return $row->attachment ? '<a href="' . $row->attachment->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->addColumn('lesson_time_post_title', function ($row) {
                return $row->lesson_time_post ? $row->lesson_time_post->title : '';
            });

            $table->editColumn('sender_efk', function ($row) {
                return $row->sender_efk ? $row->sender_efk : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'attachment', 'lesson_time_post']);

            return $table->make(true);
        }

        return view('admin.postComments.index');
    }

    public function create()
    {
        abort_if(Gate::denies('post_comment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_time_posts = LessonTimePost::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.postComments.create', compact('lesson_time_posts'));
    }

    public function store(StorePostCommentRequest $request)
    {
        $postComment = PostComment::create($request->all());

        if ($request->input('attachment', false)) {
            $postComment->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $postComment->id]);
        }

        return redirect()->route('admin.post-comments.index');
    }

    public function edit(PostComment $postComment)
    {
        abort_if(Gate::denies('post_comment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_time_posts = LessonTimePost::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $postComment->load('lesson_time_post', 'created_by');

        return view('admin.postComments.edit', compact('lesson_time_posts', 'postComment'));
    }

    public function update(UpdatePostCommentRequest $request, PostComment $postComment)
    {
        $postComment->update($request->all());

        if ($request->input('attachment', false)) {
            if (!$postComment->attachment || $request->input('attachment') !== $postComment->attachment->file_name) {
                if ($postComment->attachment) {
                    $postComment->attachment->delete();
                }
                $postComment->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
            }
        } elseif ($postComment->attachment) {
            $postComment->attachment->delete();
        }

        return redirect()->route('admin.post-comments.index');
    }

    public function show(PostComment $postComment)
    {
        abort_if(Gate::denies('post_comment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postComment->load('lesson_time_post', 'created_by');

        return view('admin.postComments.show', compact('postComment'));
    }

    public function destroy(PostComment $postComment)
    {
        abort_if(Gate::denies('post_comment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postComment->delete();

        return back();
    }

    public function massDestroy(MassDestroyPostCommentRequest $request)
    {
        PostComment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('post_comment_create') && Gate::denies('post_comment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PostComment();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
