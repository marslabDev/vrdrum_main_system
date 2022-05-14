<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSubmitResourceRequest;
use App\Http\Requests\UpdateSubmitResourceRequest;
use App\Http\Resources\Admin\SubmitResourceResource;
use App\Models\SubmitResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubmitResourceApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('submit_resource_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubmitResourceResource(SubmitResource::with(['student_work', 'created_by'])->get());
    }

    public function store(StoreSubmitResourceRequest $request)
    {
        $submitResource = SubmitResource::create($request->all());

        if ($request->input('attachment', false)) {
            $submitResource->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
        }

        return (new SubmitResourceResource($submitResource))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SubmitResource $submitResource)
    {
        abort_if(Gate::denies('submit_resource_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubmitResourceResource($submitResource->load(['student_work', 'created_by']));
    }

    public function update(UpdateSubmitResourceRequest $request, SubmitResource $submitResource)
    {
        $submitResource->update($request->all());

        if ($request->input('attachment', false)) {
            if (!$submitResource->attachment || $request->input('attachment') !== $submitResource->attachment->file_name) {
                if ($submitResource->attachment) {
                    $submitResource->attachment->delete();
                }
                $submitResource->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
            }
        } elseif ($submitResource->attachment) {
            $submitResource->attachment->delete();
        }

        return (new SubmitResourceResource($submitResource))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SubmitResource $submitResource)
    {
        abort_if(Gate::denies('submit_resource_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $submitResource->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
