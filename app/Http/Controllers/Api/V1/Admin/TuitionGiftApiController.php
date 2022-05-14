<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTuitionGiftRequest;
use App\Http\Requests\UpdateTuitionGiftRequest;
use App\Http\Resources\Admin\TuitionGiftResource;
use App\Models\TuitionGift;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TuitionGiftApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tuition_gift_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TuitionGiftResource(TuitionGift::with(['tuition_package', 'created_by'])->get());
    }

    public function store(StoreTuitionGiftRequest $request)
    {
        $tuitionGift = TuitionGift::create($request->all());

        return (new TuitionGiftResource($tuitionGift))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(TuitionGift $tuitionGift)
    {
        abort_if(Gate::denies('tuition_gift_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new TuitionGiftResource($tuitionGift->load(['tuition_package', 'created_by']));
    }

    public function update(UpdateTuitionGiftRequest $request, TuitionGift $tuitionGift)
    {
        $tuitionGift->update($request->all());

        return (new TuitionGiftResource($tuitionGift))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(TuitionGift $tuitionGift)
    {
        abort_if(Gate::denies('tuition_gift_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tuitionGift->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
