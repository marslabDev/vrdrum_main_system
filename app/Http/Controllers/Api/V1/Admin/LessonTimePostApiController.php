<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreLessonTimePostRequest;
use App\Http\Requests\UpdateLessonTimePostRequest;
use App\Http\Resources\Admin\LessonTimePostResource;
use App\Models\LessonTimePost;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LessonTimePostApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('lesson_time_post_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonTimePostResource(LessonTimePost::with(['lesson_time', 'created_by'])->get());
    }

    public function store(StoreLessonTimePostRequest $request)
    {
        $lessonTimePost = LessonTimePost::create($request->all());

        return (new LessonTimePostResource($lessonTimePost))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(LessonTimePost $lessonTimePost)
    {
        abort_if(Gate::denies('lesson_time_post_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LessonTimePostResource($lessonTimePost->load(['lesson_time', 'created_by']));
    }

    public function update(UpdateLessonTimePostRequest $request, LessonTimePost $lessonTimePost)
    {
        $lessonTimePost->update($request->all());

        return (new LessonTimePostResource($lessonTimePost))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(LessonTimePost $lessonTimePost)
    {
        abort_if(Gate::denies('lesson_time_post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTimePost->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
