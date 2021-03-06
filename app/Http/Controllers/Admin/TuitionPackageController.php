<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTuitionPackageRequest;
use App\Http\Requests\StoreTuitionPackageRequest;
use App\Http\Requests\UpdateTuitionPackageRequest;
use App\Models\LessonCategory;
use App\Models\TuitionPackage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TuitionPackageController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('tuition_package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TuitionPackage::with(['lesson_category', 'created_by'])->select(sprintf('%s.*', (new TuitionPackage())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'tuition_package_show';
                $editGate = 'tuition_package_edit';
                $deleteGate = 'tuition_package_delete';
                $crudRoutePart = 'tuition-packages';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->editColumn('total_minute', function ($row) {
                return $row->total_minute ? $row->total_minute : '';
            });
            $table->addColumn('lesson_category_name', function ($row) {
                return $row->lesson_category ? $row->lesson_category->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'lesson_category']);

            return $table->make(true);
        }

        return view('admin.tuitionPackages.index');
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

        $tuitionPackage->load('lesson_category', 'created_by');

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

        $tuitionPackage->load('lesson_category', 'created_by');

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
