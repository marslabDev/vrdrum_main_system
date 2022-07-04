<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePostContentSubmitRequest;
use App\Http\Requests\UpdatePostContentSubmitRequest;
use App\Http\Resources\Admin\PostContentSubmitResource;
use App\Models\PostContentSubmit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostContentSubmitApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('post_content_submit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostContentSubmitResource(PostContentSubmit::with(['post_content', 'created_by'])->get());
    }

    public function store(StorePostContentSubmitRequest $request)
    {
        $postContentSubmit = PostContentSubmit::create($request->all());

        foreach ($request->input('attachment', []) as $file) {
            $postContentSubmit->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachment');
        }

        return (new PostContentSubmitResource($postContentSubmit))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PostContentSubmit $postContentSubmit)
    {
        abort_if(Gate::denies('post_content_submit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostContentSubmitResource($postContentSubmit->load(['post_content', 'created_by']));
    }

    public function update(UpdatePostContentSubmitRequest $request, PostContentSubmit $postContentSubmit)
    {
        $postContentSubmit->update($request->all());

        if (count($postContentSubmit->attachment) > 0) {
            foreach ($postContentSubmit->attachment as $media) {
                if (!in_array($media->file_name, $request->input('attachment', []))) {
                    $media->delete();
                }
            }
        }
        $media = $postContentSubmit->attachment->pluck('file_name')->toArray();
        foreach ($request->input('attachment', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $postContentSubmit->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachment');
            }
        }

        return (new PostContentSubmitResource($postContentSubmit))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PostContentSubmit $postContentSubmit)
    {
        abort_if(Gate::denies('post_content_submit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postContentSubmit->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
