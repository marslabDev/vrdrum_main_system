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
use Yajra\DataTables\Facades\DataTables;

class WorkResourceController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('work_resource_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = WorkResource::with(['student_work', 'created_by'])->select(sprintf('%s.*', (new WorkResource())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'work_resource_show';
                $editGate = 'work_resource_edit';
                $deleteGate = 'work_resource_delete';
                $crudRoutePart = 'work-resources';

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
            $table->editColumn('question_text', function ($row) {
                return $row->question_text ? $row->question_text : '';
            });
            $table->editColumn('url', function ($row) {
                return $row->url ? $row->url : '';
            });
            $table->addColumn('student_work_title', function ($row) {
                return $row->student_work ? $row->student_work->title : '';
            });

            $table->editColumn('student_work.title', function ($row) {
                return $row->student_work ? (is_string($row->student_work) ? $row->student_work : $row->student_work->title) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'student_work']);

            return $table->make(true);
        }

        return view('admin.workResources.index');
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

        $workResource->load('student_work', 'created_by');

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

        $workResource->load('student_work', 'created_by');

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
