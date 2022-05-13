<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCoachMetumRequest;
use App\Http\Requests\StoreCoachMetumRequest;
use App\Http\Requests\UpdateCoachMetumRequest;
use App\Models\CoachMetum;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CoachMetaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('coach_metum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CoachMetum::with(['created_by'])->select(sprintf('%s.*', (new CoachMetum())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'coach_metum_show';
                $editGate = 'coach_metum_edit';
                $deleteGate = 'coach_metum_delete';
                $crudRoutePart = 'coach-meta';

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
            $table->editColumn('meta_key', function ($row) {
                return $row->meta_key ? $row->meta_key : '';
            });
            $table->editColumn('meta_value', function ($row) {
                return $row->meta_value ? $row->meta_value : '';
            });
            $table->editColumn('coach_efk', function ($row) {
                return $row->coach_efk ? $row->coach_efk : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.coachMeta.index');
    }

    public function create()
    {
        abort_if(Gate::denies('coach_metum_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.coachMeta.create');
    }

    public function store(StoreCoachMetumRequest $request)
    {
        $coachMetum = CoachMetum::create($request->all());

        return redirect()->route('admin.coach-meta.index');
    }

    public function edit(CoachMetum $coachMetum)
    {
        abort_if(Gate::denies('coach_metum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coachMetum->load('created_by');

        return view('admin.coachMeta.edit', compact('coachMetum'));
    }

    public function update(UpdateCoachMetumRequest $request, CoachMetum $coachMetum)
    {
        $coachMetum->update($request->all());

        return redirect()->route('admin.coach-meta.index');
    }

    public function show(CoachMetum $coachMetum)
    {
        abort_if(Gate::denies('coach_metum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coachMetum->load('created_by');

        return view('admin.coachMeta.show', compact('coachMetum'));
    }

    public function destroy(CoachMetum $coachMetum)
    {
        abort_if(Gate::denies('coach_metum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coachMetum->delete();

        return back();
    }

    public function massDestroy(MassDestroyCoachMetumRequest $request)
    {
        CoachMetum::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
