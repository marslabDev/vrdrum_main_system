<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTuitionPackageRequest;
use App\Http\Requests\UpdateTuitionPackageRequest;
use App\Http\Resources\Admin\TuitionPackageResource;
use App\Models\TuitionPackage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TuitionPackageApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tuition_package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TuitionPackageResource(TuitionPackage::with(['lesson_category', 'created_by'])->get());
    }

    public function store(StoreTuitionPackageRequest $request)
    {
        $tuitionPackage = TuitionPackage::create($request->all());

        return (new TuitionPackageResource($tuitionPackage))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TuitionPackage $tuitionPackage)
    {
        abort_if(Gate::denies('tuition_package_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TuitionPackageResource($tuitionPackage->load(['lesson_category', 'created_by']));
    }

    public function update(UpdateTuitionPackageRequest $request, TuitionPackage $tuitionPackage)
    {
        $tuitionPackage->update($request->all());

        return (new TuitionPackageResource($tuitionPackage))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TuitionPackage $tuitionPackage)
    {
        abort_if(Gate::denies('tuition_package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tuitionPackage->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
