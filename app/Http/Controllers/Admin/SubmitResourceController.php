<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroySubmitResourceRequest;
use App\Http\Requests\StoreSubmitResourceRequest;
use App\Http\Requests\UpdateSubmitResourceRequest;
use App\Models\StudentWork;
use App\Models\SubmitResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SubmitResourceController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('submit_resource_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SubmitResource::with(['student_work', 'created_by'])->select(sprintf('%s.*', (new SubmitResource())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'submit_resource_show';
                $editGate = 'submit_resource_edit';
                $deleteGate = 'submit_resource_delete';
                $crudRoutePart = 'submit-resources';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('answer_text', function ($row) {
                return $row->answer_text ? $row->answer_text : '';
            });
            $table->editColumn('url', function ($row) {
                return $row->url ? $row->url : '';
            });
            $table->addColumn('student_work_title', function ($row) {
                return $row->student_work ? $row->student_work->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'student_work']);

            return $table->make(true);
        }

        return view('admin.submitResources.index');
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

        $submitResource->load('student_work', 'created_by');

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

        $submitResource->load('student_work', 'created_by');

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
