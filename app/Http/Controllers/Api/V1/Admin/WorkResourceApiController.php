<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreWorkResourceRequest;
use App\Http\Requests\UpdateWorkResourceRequest;
use App\Http\Resources\Admin\WorkResourceResource;
use App\Models\WorkResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkResourceApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('work_resource_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkResourceResource(WorkResource::with(['student_work', 'created_by'])->get());
    }

    public function store(StoreWorkResourceRequest $request)
    {
        $workResource = WorkResource::create($request->all());

        if ($request->input('attachment', false)) {
            $workResource->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
        }

        return (new WorkResourceResource($workResource))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(WorkResource $workResource)
    {
        abort_if(Gate::denies('work_resource_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WorkResourceResource($workResource->load(['student_work', 'created_by']));
    }

    public function update(UpdateWorkResourceRequest $request, WorkResource $workResource)
    {
        $workResource->update($request->all());

        if ($request->input('attachment', false)) {
            if (!$workResource->attachment || $request->input('attachment') !== $workResource->attachment->file_name) {
                if ($workResource->attachment) {
                    $workResource->attachment->delete();
                }
                $workResource->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
            }
        } elseif ($workResource->attachment) {
            $workResource->attachment->delete();
        }

        return (new WorkResourceResource($workResource))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(WorkResource $workResource)
    {
        abort_if(Gate::denies('work_resource_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workResource->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
