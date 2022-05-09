<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTuitionGiftRequest;
use App\Http\Requests\StoreTuitionGiftRequest;
use App\Http\Requests\UpdateTuitionGiftRequest;
use App\Models\TuitionGift;
use App\Models\TuitionPackage;
use Gate;
use Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TuitionGiftController extends Controller
{
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
            $table->editColumn('total_lesson', function ($row) {
                $total_lesson = $row->total_minute || $row->total_minute == 0 
                    ? $row->total_minute / config('constants.lesson.one_lesson_time') 
                    : '';

                return $total_lesson;
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

    public function create($errors = null)
    {
        abort_if(Gate::denies('tuition_gift_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tuition_packages = TuitionPackage::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        if($errors != null) return view('admin.tuitionGifts.create', compact('tuition_packages', 'errors'));

        return view('admin.tuitionGifts.create', compact('tuition_packages'));
    }

    public function store(StoreTuitionGiftRequest $request)
    {
        $request_data = $request->all();
        
        // ------------------------------ validation ------------------------------
        $validated = Validator::make([],[]);

        if ($request_data['type'] == 'lesson' && $request_data['total_lesson'] == '0'){
            $validated->getMessageBag()->add('total_lesson', trans('validation.total_lesson_required'));
        }

        if ($request_data['type'] == 'product' && $request_data['quantity'] == '0'){
            $validated->getMessageBag()->add('quantity', trans('validation.quantity_required'));
        }

        if ($request_data['type'] == 'product' && $request_data['inventory_efk'] == null){
            $validated->getMessageBag()->add('inventory_efk', trans('validation.inventory_required'));
        }

        if ($request_data['tuition_package_id'] == null){
            $validated->getMessageBag()->add('tuition_package', trans('validation.tuition_package_required'));
        }

        if($validated->errors()->count() > 0){
            return $this->create($validated->errors());
        }

        // ------------------------------ data assign ------------------------------
        $request_data['total_minute'] = $request_data['total_lesson'] * config('constants.lesson.one_lesson_time');

        $tuitionGift = TuitionGift::create($request_data);

        return redirect()->route('admin.tuition-gifts.index');
    }

    public function edit(TuitionGift $tuitionGift, $errors = null)
    {
        abort_if(Gate::denies('tuition_gift_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tuition_packages = TuitionPackage::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tuitionGift->load('tuition_package', 'created_by');

        $tuitionGift->total_lesson = $tuitionGift->total_minute / config('constants.lesson.one_lesson_time') ;

        if($errors != null) return view('admin.tuitionGifts.edit', compact('tuitionGift', 'tuition_packages', 'errors'));

        return view('admin.tuitionGifts.edit', compact('tuitionGift', 'tuition_packages'));
    }

    public function update(UpdateTuitionGiftRequest $request, TuitionGift $tuitionGift)
    {
        $request_data = $request->all();
        
        // ------------------------------ validation ------------------------------
        $validated = Validator::make([],[]);

        if ($request_data['type'] == 'lesson' && $request_data['total_lesson'] == '0'){
            $validated->getMessageBag()->add('total_lesson', trans('validation.total_lesson_required'));
        }

        if ($request_data['type'] == 'product' && $request_data['quantity'] == '0'){
            $validated->getMessageBag()->add('quantity', trans('validation.quantity_required'));
        }

        if ($request_data['type'] == 'product' && $request_data['inventory_efk'] == null){
            $validated->getMessageBag()->add('inventory_efk', trans('validation.inventory_required'));
        }

        if ($request_data['tuition_package_id'] == null){
            $validated->getMessageBag()->add('tuition_package', trans('validation.tuition_package_required'));
        }

        if($validated->errors()->count() > 0){
            return $this->edit($tuitionGift, $validated->errors());
        }

        // ------------------------------ data assign ------------------------------
        $request_data['total_minute'] = $request_data['total_lesson'] * config('constants.lesson.one_lesson_time');

        $tuitionGift->update($request_data);

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
