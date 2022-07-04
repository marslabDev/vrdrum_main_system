<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePostCommentRequest;
use App\Http\Requests\UpdatePostCommentRequest;
use App\Http\Resources\Admin\PostCommentResource;
use App\Models\PostComment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostCommentApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('post_comment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostCommentResource(PostComment::with(['lesson_time_post', 'created_by'])->get());
    }

    public function store(StorePostCommentRequest $request)
    {
        $postComment = PostComment::create($request->all());

        if ($request->input('attachment', false)) {
            $postComment->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
        }

        return (new PostCommentResource($postComment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PostComment $postComment)
    {
        abort_if(Gate::denies('post_comment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostCommentResource($postComment->load(['lesson_time_post', 'created_by']));
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

        return (new PostCommentResource($postComment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PostComment $postComment)
    {
        abort_if(Gate::denies('post_comment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postComment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
