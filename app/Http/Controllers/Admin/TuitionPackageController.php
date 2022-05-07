<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTuitionPackageRequest;
use App\Http\Requests\StoreTuitionPackageRequest;
use App\Http\Requests\UpdateTuitionPackageRequest;
use App\Models\LessonCategory;
use App\Models\TuitionPackage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TuitionPackageController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tuition_package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tuitionPackages = TuitionPackage::with(['lesson_category'])->get();

        return view('admin.tuitionPackages.index', compact('tuitionPackages'));
    }

    public function create()
    {
        abort_if(Gate::denies('tuition_package_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_categories = LessonCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.tuitionPackages.create', compact('lesson_categories'));
    }

    public function store(StoreTuitionPackageRequest $request)
    {
        $tuitionPackage = TuitionPackage::create($request->all());

        return redirect()->route('admin.tuition-packages.index');
    }

    public function edit(TuitionPackage $tuitionPackage)
    {
        abort_if(Gate::denies('tuition_package_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_categories = LessonCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tuitionPackage->load('lesson_category');

        return view('admin.tuitionPackages.edit', compact('lesson_categories', 'tuitionPackage'));
    }

    public function update(UpdateTuitionPackageRequest $request, TuitionPackage $tuitionPackage)
    {
        $tuitionPackage->update($request->all());

        return redirect()->route('admin.tuition-packages.index');
    }

    public function show(TuitionPackage $tuitionPackage)
    {
        abort_if(Gate::denies('tuition_package_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tuitionPackage->load('lesson_category');

        return view('admin.tuitionPackages.show', compact('tuitionPackage'));
    }

    public function destroy(TuitionPackage $tuitionPackage)
    {
        abort_if(Gate::denies('tuition_package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tuitionPackage->delete();

        return back();
    }

    public function massDestroy(MassDestroyTuitionPackageRequest $request)
    {
        TuitionPackage::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
