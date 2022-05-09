<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCoachDetailRequest;
use App\Http\Requests\StoreCoachDetailRequest;
use App\Http\Requests\UpdateCoachDetailRequest;
use App\Models\CoachDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CoachDetailController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('coach_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CoachDetail::with(['created_by'])->select(sprintf('%s.*', (new CoachDetail())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'coach_detail_show';
                $editGate = 'coach_detail_edit';
                $deleteGate = 'coach_detail_delete';
                $crudRoutePart = 'coach-details';

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
            $table->editColumn('enrollment_status', function ($row) {
                return $row->enrollment_status ? CoachDetail::ENROLLMENT_STATUS_SELECT[$row->enrollment_status] : '';
            });
            $table->editColumn('coach_efk', function ($row) {
                return $row->coach_efk ? $row->coach_efk : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.coachDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('coach_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.coachDetails.create');
    }

    public function store(StoreCoachDetailRequest $request)
    {
        $coachDetail = CoachDetail::create($request->all());

        return redirect()->route('admin.coach-details.index');
    }

    public function edit(CoachDetail $coachDetail)
    {
        abort_if(Gate::denies('coach_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coachDetail->load('created_by');

        return view('admin.coachDetails.edit', compact('coachDetail'));
    }

    public function update(UpdateCoachDetailRequest $request, CoachDetail $coachDetail)
    {
        $coachDetail->update($request->all());

        return redirect()->route('admin.coach-details.index');
    }

    public function show(CoachDetail $coachDetail)
    {
        abort_if(Gate::denies('coach_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coachDetail->load('created_by');

        return view('admin.coachDetails.show', compact('coachDetail'));
    }

    public function destroy(CoachDetail $coachDetail)
    {
        abort_if(Gate::denies('coach_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $coachDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyCoachDetailRequest $request)
    {
        CoachDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
