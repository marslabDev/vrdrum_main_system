<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCoachDetailRequest;
use App\Http\Requests\UpdateCoachDetailRequest;
use App\Http\Resources\Admin\CoachDetailResource;
use App\Models\CoachDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CoachDetailApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('coach_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CoachDetailResource(CoachDetail::with(['created_by'])->get());
    }

    public function store(StoreCoachDetailRequest $request)
    {
        $coachDetail = CoachDetail::create($request->all());

        return (new CoachDetailResource($coachDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CoachDetail $coachDetail)
    {
        abort_if(Gate::denies('coach_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CoachDetailResource($coachDetail->load(['created_by']));
    }

    public function update(UpdateCoachDetailRequest $request, CoachDetail $coachDetail)
    {
        $coachDetail->update($request->all());

        return (new CoachDetailResource($coachDetail))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CoachDetail $coachDetail)
    {
        abort_if(Gate::denies('coach_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coachDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
