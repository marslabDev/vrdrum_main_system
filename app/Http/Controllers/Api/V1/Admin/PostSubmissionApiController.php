<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostSubmissionRequest;
use App\Http\Requests\UpdatePostSubmissionRequest;
use App\Http\Resources\Admin\PostSubmissionResource;
use App\Models\PostSubmission;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PostSubmissionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('post_submission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostSubmissionResource(PostSubmission::with(['lesson_time_post', 'created_by'])->get());
    }

    public function store(StorePostSubmissionRequest $request)
    {
        $postSubmission = PostSubmission::create($request->all());

        return (new PostSubmissionResource($postSubmission))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PostSubmission $postSubmission)
    {
        abort_if(Gate::denies('post_submission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PostSubmissionResource($postSubmission->load(['lesson_time_post', 'created_by']));
    }

    public function update(UpdatePostSubmissionRequest $request, PostSubmission $postSubmission)
    {
        $postSubmission->update($request->all());

        return (new PostSubmissionResource($postSubmission))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PostSubmission $postSubmission)
    {
        abort_if(Gate::denies('post_submission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postSubmission->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
