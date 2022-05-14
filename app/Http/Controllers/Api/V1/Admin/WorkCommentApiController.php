<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreWorkCommentRequest;
use App\Http\Requests\UpdateWorkCommentRequest;
use App\Http\Resources\Admin\WorkCommentResource;
use App\Models\WorkComment;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkCommentApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('work_comment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkCommentResource(WorkComment::with(['student_work', 'created_by'])->get());
    }

    public function store(StoreWorkCommentRequest $request)
    {
        $workComment = WorkComment::create($request->all());

        if ($request->input('attachment', false)) {
            $workComment->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
        }

        return (new WorkCommentResource($workComment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(WorkComment $workComment)
    {
        abort_if(Gate::denies('work_comment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkCommentResource($workComment->load(['student_work', 'created_by']));
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

        return (new WorkCommentResource($workComment))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(WorkComment $workComment)
    {
        abort_if(Gate::denies('work_comment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workComment->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
