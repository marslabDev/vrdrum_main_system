<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyStudentTuitionRequest;
use App\Http\Requests\StoreStudentTuitionRequest;
use App\Http\Requests\UpdateStudentTuitionRequest;
use App\Models\StudentTuition;
use App\Models\TuitionPackage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StudentTuitionController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('student_tuition_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StudentTuition::with(['tuition_package', 'created_by'])->select(sprintf('%s.*', (new StudentTuition())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'student_tuition_show';
                $editGate = 'student_tuition_edit';
                $deleteGate = 'student_tuition_delete';
                $crudRoutePart = 'student-tuitions';

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
            $table->editColumn('minute_left', function ($row) {
                return $row->minute_left ? $row->minute_left : '';
            });
            $table->addColumn('tuition_package_name', function ($row) {
                return $row->tuition_package ? $row->tuition_package->name : '';
            });

            $table->editColumn('student_efk', function ($row) {
                return $row->student_efk ? $row->student_efk : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'tuition_package']);

            return $table->make(true);
        }

        return view('admin.studentTuitions.index');
    }

    public function create()
    {
        abort_if(Gate::denies('student_tuition_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tuition_packages = TuitionPackage::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.studentTuitions.create', compact('tuition_packages'));
    }

    public function store(StoreStudentTuitionRequest $request)
    {
        $studentTuition = StudentTuition::create($request->all());

        return redirect()->route('admin.student-tuitions.index');
    }

    public function edit(StudentTuition $studentTuition)
    {
        abort_if(Gate::denies('student_tuition_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tuition_packages = TuitionPackage::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $studentTuition->load('tuition_package', 'created_by');

        return view('admin.studentTuitions.edit', compact('studentTuition', 'tuition_packages'));
    }

    public function update(UpdateStudentTuitionRequest $request, StudentTuition $studentTuition)
    {
        $studentTuition->update($request->all());

        return redirect()->route('admin.student-tuitions.index');
    }

    public function show(StudentTuition $studentTuition)
    {
        abort_if(Gate::denies('student_tuition_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentTuition->load('tuition_package', 'created_by');

        return view('admin.studentTuitions.show', compact('studentTuition'));
    }

    public function destroy(StudentTuition $studentTuition)
    {
        abort_if(Gate::denies('student_tuition_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentTuition->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentTuitionRequest $request)
    {
        StudentTuition::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
