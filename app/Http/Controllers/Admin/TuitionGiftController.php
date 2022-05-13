<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyTuitionGiftRequest;
use App\Http\Requests\StoreTuitionGiftRequest;
use App\Http\Requests\UpdateTuitionGiftRequest;
use App\Models\TuitionGift;
use App\Models\TuitionPackage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TuitionGiftController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('tuition_gift_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = TuitionGift::with(['tuition_package', 'created_by'])->select(sprintf('%s.*', (new TuitionGift())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'tuition_gift_show';
                $editGate = 'tuition_gift_edit';
                $deleteGate = 'tuition_gift_delete';
                $crudRoutePart = 'tuition-gifts';

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
            $table->editColumn('type', function ($row) {
                return $row->type ? TuitionGift::TYPE_SELECT[$row->type] : '';
            });
            $table->editColumn('total_minute', function ($row) {
                return $row->total_minute ? $row->total_minute : '';
            });
            $table->editColumn('quantity', function ($row) {
                return $row->quantity ? $row->quantity : '';
            });
            $table->addColumn('tuition_package_name', function ($row) {
                return $row->tuition_package ? $row->tuition_package->name : '';
            });

            $table->editColumn('inventory_efk', function ($row) {
                return $row->inventory_efk ? $row->inventory_efk : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'tuition_package']);

            return $table->make(true);
        }

        return view('admin.tuitionGifts.index');
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

        $tuitionGift->load('tuition_package', 'created_by');

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

        $tuitionGift->load('tuition_package', 'created_by');

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
