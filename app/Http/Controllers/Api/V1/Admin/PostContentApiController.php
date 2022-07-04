<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePostContentRequest;
use App\Http\Requests\UpdatePostContentRequest;
use App\Http\Resources\Admin\PostContentResource;
use App\Models\PostContent;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostContentApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('post_content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostContentResource(PostContent::with(['lesson_time_post', 'created_by'])->get());
    }

    public function store(StorePostContentRequest $request)
    {
        $postContent = PostContent::create($request->all());

        foreach ($request->input('attachment', []) as $file) {
            $postContent->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachment');
        }

        return (new PostContentResource($postContent))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PostContent $postContent)
    {
        abort_if(Gate::denies('post_content_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostContentResource($postContent->load(['lesson_time_post', 'created_by']));
    }

    public function update(UpdatePostContentRequest $request, PostContent $postContent)
    {
        $postContent->update($request->all());

        if (count($postContent->attachment) > 0) {
            foreach ($postContent->attachment as $media) {
                if (!in_array($media->file_name, $request->input('attachment', []))) {
                    $media->delete();
                }
            }
        }
        $media = $postContent->attachment->pluck('file_name')->toArray();
        foreach ($request->input('attachment', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $postContent->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachment');
            }
        }

        return (new PostContentResource($postContent))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PostContent $postContent)
    {
        abort_if(Gate::denies('post_content_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postContent->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
