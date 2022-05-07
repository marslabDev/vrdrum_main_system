<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySubmitResourceRequest;
use App\Http\Requests\StoreSubmitResourceRequest;
use App\Http\Requests\UpdateSubmitResourceRequest;
use App\Models\StudentWork;
use App\Models\SubmitResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubmitResourceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('submit_resource_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $submitResources = SubmitResource::with(['student_work'])->get();

        return view('admin.submitResources.index', compact('submitResources'));
    }

    public function create()
    {
        abort_if(Gate::denies('submit_resource_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student_works = StudentWork::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.submitResources.create', compact('student_works'));
    }

    public function store(StoreSubmitResourceRequest $request)
    {
        $submitResource = SubmitResource::create($request->all());

        return redirect()->route('admin.submit-resources.index');
    }

    public function edit(SubmitResource $submitResource)
    {
        abort_if(Gate::denies('submit_resource_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student_works = StudentWork::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $submitResource->load('student_work');

        return view('admin.submitResources.edit', compact('student_works', 'submitResource'));
    }

    public function update(UpdateSubmitResourceRequest $request, SubmitResource $submitResource)
    {
        $submitResource->update($request->all());

        return redirect()->route('admin.submit-resources.index');
    }

    public function show(SubmitResource $submitResource)
    {
        abort_if(Gate::denies('submit_resource_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $submitResource->load('student_work');

        return view('admin.submitResources.show', compact('submitResource'));
    }

    public function destroy(SubmitResource $submitResource)
    {
        abort_if(Gate::denies('submit_resource_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $submitResource->delete();

        return back();
    }

    public function massDestroy(MassDestroySubmitResourceRequest $request)
    {
        SubmitResource::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
