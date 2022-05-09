<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTuitionPackageRequest;
use App\Http\Requests\StoreTuitionPackageRequest;
use App\Http\Requests\UpdateTuitionPackageRequest;
use App\Models\LessonCategory;
use App\Models\TuitionGift;
use App\Models\TuitionPackage;
use Gate;
use Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TuitionPackageController extends Controller
{
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
                return $row->price || $row->price == 0 ? $row->price : '';
            });
            $table->editColumn('total_lesson', function ($row) {
                $total_lesson = $row->total_minute || $row->total_minute == 0 
                    ? $row->total_minute / config('constants.lesson.one_lesson_time') 
                    : '';

                $tuitionGifts = TuitionGift::where([
                    ['tuition_package_id', '=', $row->id],
                    ['type', '=', 'lesson']
                ])->get();
                
                $addition_lesson = 0;

                foreach ($tuitionGifts as $index => $value){
                    $addition_lesson += $tuitionGifts[$index]->total_minute / config('constants.lesson.one_lesson_time');
                }

                return $total_lesson . ($addition_lesson == 0 ? '' : ' + ' .$addition_lesson);
            });
            $table->addColumn('lesson_category_name', function ($row) {
                return $row->lesson_category ? $row->lesson_category->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'lesson_category']);

            return $table->make(true);
        }

        return view('admin.tuitionPackages.index');
    }

    public function create($errors = null)
    {
        abort_if(Gate::denies('tuition_package_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_categories = LessonCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        if($errors != null) return view('admin.tuitionPackages.create', compact('lesson_categories', 'errors'));

        return view('admin.tuitionPackages.create', compact('lesson_categories'));
    }

    public function store(StoreTuitionPackageRequest $request)
    {
        $request_data = $request->all();

        // ------------------------------ validation ------------------------------
        $validated = Validator::make([],[]);

        if ($request_data['lesson_category_id'] == null){
            $validated->getMessageBag()->add('lesson_category', trans('validation.lesson_category_required'));
        }

        if($validated->errors()->count() > 0){
            return $this->create($validated->errors());
        }

        // ------------------------------ data assign ------------------------------
        $request_data['total_minute'] = $request_data['total_lesson'] * config('constants.lesson.one_lesson_time') ;
        $request_data['price'] = $request_data['total_lesson'] * config('constants.lesson.one_lesson_price') ;

        $tuitionPackage = TuitionPackage::create($request_data);

        return redirect()->route('admin.tuition-packages.index');
    }

    public function edit(TuitionPackage $tuitionPackage, $errors = null)
    {
        abort_if(Gate::denies('tuition_package_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_categories = LessonCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $tuitionPackage->load('lesson_category', 'created_by');

        $tuitionPackage->total_lesson = $tuitionPackage->total_minute / config('constants.lesson.one_lesson_time');

        if($errors != null) return view('admin.tuitionPackages.edit', compact('lesson_categories', 'tuitionPackage', 'errors'));

        return view('admin.tuitionPackages.edit', compact('lesson_categories', 'tuitionPackage'));
    }

    public function update(UpdateTuitionPackageRequest $request, TuitionPackage $tuitionPackage)
    {
        $request_data = $request->all();

        // ------------------------------ validation ------------------------------
        $validated = Validator::make([],[]);

        if ($request_data['lesson_category_id'] == null){
            $validated->getMessageBag()->add('lesson_category', trans('validation.lesson_category_required'));
        }

        if($validated->errors()->count() > 0){
            return $this->edit($tuitionPackage, $validated->errors());
        }

        // ------------------------------ data assign ------------------------------
        $request_data['total_minute'] = $request_data['total_lesson'] * config('constants.lesson.one_lesson_time') ;
        $request_data['price'] = $request_data['total_lesson'] * config('constants.lesson.one_lesson_price') ;

        $tuitionPackage->update($request_data);

        return redirect()->route('admin.tuition-packages.index');
    }

    public function show(TuitionPackage $tuitionPackage)
    {
        abort_if(Gate::denies('tuition_package_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tuitionPackage->load('lesson_category', 'created_by');

        $tuitionPackage->total_lesson = $tuitionPackage->total_minute / config('constants.lesson.one_lesson_time');

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
