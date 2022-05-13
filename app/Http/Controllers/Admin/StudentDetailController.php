<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyStudentDetailRequest;
use App\Http\Requests\StoreStudentDetailRequest;
use App\Http\Requests\UpdateStudentDetailRequest;
use App\Models\StudentDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StudentDetailController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('student_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StudentDetail::with(['created_by'])->select(sprintf('%s.*', (new StudentDetail())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'student_detail_show';
                $editGate = 'student_detail_edit';
                $deleteGate = 'student_detail_delete';
                $crudRoutePart = 'student-details';

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
            $table->editColumn('full_name', function ($row) {
                return $row->full_name ? $row->full_name : '';
            });
            $table->editColumn('parent_name', function ($row) {
                return $row->parent_name ? $row->parent_name : '';
            });
            $table->editColumn('parent_phone', function ($row) {
                return $row->parent_phone ? $row->parent_phone : '';
            });
            $table->editColumn('lesson_categories', function ($row) {
                return $row->lesson_categories ? StudentDetail::LESSON_CATEGORIES_SELECT[$row->lesson_categories] : '';
            });
            $table->editColumn('lesson_group', function ($row) {
                return $row->lesson_group ? StudentDetail::LESSON_GROUP_SELECT[$row->lesson_group] : '';
            });
            $table->editColumn('is_disabled', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_disabled ? 'checked' : null) . '>';
            });
            $table->editColumn('student_efk', function ($row) {
                return $row->student_efk ? $row->student_efk : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'is_disabled']);

            return $table->make(true);
        }

        return view('admin.studentDetails.index');
    }

    public function create()
    {
        abort_if(Gate::denies('student_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.studentDetails.create');
    }

    public function store(StoreStudentDetailRequest $request)
    {
        $studentDetail = StudentDetail::create($request->all());

        return redirect()->route('admin.student-details.index');
    }

    public function edit(StudentDetail $studentDetail)
    {
        abort_if(Gate::denies('student_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentDetail->load('created_by');

        return view('admin.studentDetails.edit', compact('studentDetail'));
    }

    public function update(UpdateStudentDetailRequest $request, StudentDetail $studentDetail)
    {
        $studentDetail->update($request->all());

        return redirect()->route('admin.student-details.index');
    }

    public function show(StudentDetail $studentDetail)
    {
        abort_if(Gate::denies('student_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentDetail->load('created_by');

        return view('admin.studentDetails.show', compact('studentDetail'));
    }

    public function destroy(StudentDetail $studentDetail)
    {
        abort_if(Gate::denies('student_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentDetailRequest $request)
    {
        StudentDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
