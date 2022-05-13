<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyStudentMetumRequest;
use App\Http\Requests\StoreStudentMetumRequest;
use App\Http\Requests\UpdateStudentMetumRequest;
use App\Models\StudentMetum;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StudentMetaController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('student_metum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StudentMetum::with(['created_by'])->select(sprintf('%s.*', (new StudentMetum())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'student_metum_show';
                $editGate = 'student_metum_edit';
                $deleteGate = 'student_metum_delete';
                $crudRoutePart = 'student-meta';

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
            $table->editColumn('student_efk', function ($row) {
                return $row->student_efk ? $row->student_efk : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.studentMeta.index');
    }

    public function create()
    {
        abort_if(Gate::denies('student_metum_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.studentMeta.create');
    }

    public function store(StoreStudentMetumRequest $request)
    {
        $studentMetum = StudentMetum::create($request->all());

        return redirect()->route('admin.student-meta.index');
    }

    public function edit(StudentMetum $studentMetum)
    {
        abort_if(Gate::denies('student_metum_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentMetum->load('created_by');

        return view('admin.studentMeta.edit', compact('studentMetum'));
    }

    public function update(UpdateStudentMetumRequest $request, StudentMetum $studentMetum)
    {
        $studentMetum->update($request->all());

        return redirect()->route('admin.student-meta.index');
    }

    public function show(StudentMetum $studentMetum)
    {
        abort_if(Gate::denies('student_metum_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentMetum->load('created_by');

        return view('admin.studentMeta.show', compact('studentMetum'));
    }

    public function destroy(StudentMetum $studentMetum)
    {
        abort_if(Gate::denies('student_metum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentMetum->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentMetumRequest $request)
    {
        StudentMetum::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
