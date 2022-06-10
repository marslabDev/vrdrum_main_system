<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyStudentParentRequest;
use App\Http\Requests\StoreStudentParentRequest;
use App\Http\Requests\UpdateStudentParentRequest;
use App\Models\StudentParent;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StudentParentController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('student_parent_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StudentParent::with(['created_by', 'user'])->select(sprintf('%s.*', (new StudentParent())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'student_parent_show';
                $editGate = 'student_parent_edit';
                $deleteGate = 'student_parent_delete';
                $crudRoutePart = 'student-parents';

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
            $table->editColumn('nationality', function ($row) {
                return $row->nationality ? $row->nationality : '';
            });
            $table->editColumn('relationship', function ($row) {
                return $row->relationship ? StudentParent::RELATIONSHIP_SELECT[$row->relationship] : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->editColumn('nric_no', function ($row) {
                return $row->nric_no ? $row->nric_no : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.studentParents.index');
    }

    public function create()
    {
        abort_if(Gate::denies('student_parent_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.studentParents.create');
    }

    public function store(StoreStudentParentRequest $request)
    {
        $studentParent = StudentParent::create($request->all());

        return redirect()->route('admin.student-parents.index');
    }

    public function edit(StudentParent $studentParent)
    {
        abort_if(Gate::denies('student_parent_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentParent->load('created_by', 'user');

        return view('admin.studentParents.edit', compact('studentParent'));
    }

    public function update(UpdateStudentParentRequest $request, StudentParent $studentParent)
    {
        $studentParent->update($request->all());

        return redirect()->route('admin.student-parents.index');
    }

    public function show(StudentParent $studentParent)
    {
        abort_if(Gate::denies('student_parent_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentParent->load('created_by', 'user', 'guardianStudentDetails');

        return view('admin.studentParents.show', compact('studentParent'));
    }

    public function destroy(StudentParent $studentParent)
    {
        abort_if(Gate::denies('student_parent_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentParent->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentParentRequest $request)
    {
        StudentParent::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
