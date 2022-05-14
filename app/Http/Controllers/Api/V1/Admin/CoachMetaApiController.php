<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoachMetumRequest;
use App\Http\Requests\UpdateCoachMetumRequest;
use App\Http\Resources\Admin\CoachMetumResource;
use App\Models\CoachMetum;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CoachMetaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('coach_metum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CoachMetumResource(CoachMetum::with(['created_by'])->get());
    }

    public function store(StoreCoachMetumRequest $request)
    {
        $coachMetum = CoachMetum::create($request->all());

        return (new CoachMetumResource($coachMetum))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CoachMetum $coachMetum)
    {
        abort_if(Gate::denies('coach_metum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CoachMetumResource($coachMetum->load(['created_by']));
    }

    public function update(UpdateCoachMetumRequest $request, CoachMetum $coachMetum)
    {
        $coachMetum->update($request->all());

        return (new CoachMetumResource($coachMetum))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CoachMetum $coachMetum)
    {
        abort_if(Gate::denies('coach_metum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coachMetum->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
