<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTuitionGiftRequest;
use App\Http\Requests\StoreTuitionGiftRequest;
use App\Http\Requests\UpdateTuitionGiftRequest;
use App\Models\TuitionGift;
use App\Models\TuitionPackage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TuitionGiftController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tuition_gift_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tuitionGifts = TuitionGift::with(['tuition_package'])->get();

        return view('admin.tuitionGifts.index', compact('tuitionGifts'));
    }

    public function create()
    {
        abort_if(Gate::denies('tuition_gift_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tuition_packages = TuitionPackage::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tuitionGifts.create', compact('tuition_packages'));
    }

    public function store(StoreTuitionGiftRequest $request)
    {
        $tuitionGift = TuitionGift::create($request->all());

        return redirect()->route('admin.tuition-gifts.index');
    }

    public function edit(TuitionGift $tuitionGift)
    {
        abort_if(Gate::denies('tuition_gift_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tuition_packages = TuitionPackage::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tuitionGift->load('tuition_package');

        return view('admin.tuitionGifts.edit', compact('tuitionGift', 'tuition_packages'));
    }

    public function update(UpdateTuitionGiftRequest $request, TuitionGift $tuitionGift)
    {
        $tuitionGift->update($request->all());

        return redirect()->route('admin.tuition-gifts.index');
    }

    public function show(TuitionGift $tuitionGift)
    {
        abort_if(Gate::denies('tuition_gift_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tuitionGift->load('tuition_package');

        return view('admin.tuitionGifts.show', compact('tuitionGift'));
    }

    public function destroy(TuitionGift $tuitionGift)
    {
        abort_if(Gate::denies('tuition_gift_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tuitionGift->delete();

        return back();
    }

    public function massDestroy(MassDestroyTuitionGiftRequest $request)
    {
        TuitionGift::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
