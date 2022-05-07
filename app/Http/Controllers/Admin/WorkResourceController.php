<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWorkResourceRequest;
use App\Http\Requests\StoreWorkResourceRequest;
use App\Http\Requests\UpdateWorkResourceRequest;
use App\Models\StudentWork;
use App\Models\WorkResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkResourceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('work_resource_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workResources = WorkResource::with(['student_work'])->get();

        return view('admin.workResources.index', compact('workResources'));
    }

    public function create()
    {
        abort_if(Gate::denies('work_resource_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student_works = StudentWork::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.workResources.create', compact('student_works'));
    }

    public function store(StoreWorkResourceRequest $request)
    {
        $workResource = WorkResource::create($request->all());

        return redirect()->route('admin.work-resources.index');
    }

    public function edit(WorkResource $workResource)
    {
        abort_if(Gate::denies('work_resource_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student_works = StudentWork::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $workResource->load('student_work');

        return view('admin.workResources.edit', compact('student_works', 'workResource'));
    }

    public function update(UpdateWorkResourceRequest $request, WorkResource $workResource)
    {
        $workResource->update($request->all());

        return redirect()->route('admin.work-resources.index');
    }

    public function show(WorkResource $workResource)
    {
        abort_if(Gate::denies('work_resource_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workResource->load('student_work');

        return view('admin.workResources.show', compact('workResource'));
    }

    public function destroy(WorkResource $workResource)
    {
        abort_if(Gate::denies('work_resource_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workResource->delete();

        return back();
    }

    public function massDestroy(MassDestroyWorkResourceRequest $request)
    {
        WorkResource::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
