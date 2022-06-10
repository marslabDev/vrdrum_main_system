<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyStudentDetailRequest;
use App\Http\Requests\StoreStudentDetailRequest;
use App\Http\Requests\UpdateStudentDetailRequest;
use App\Models\StudentDetail;
use App\Models\StudentParent;
use App\Models\User;
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
            $query = StudentDetail::with(['user', 'created_by', 'guardians'])->select(sprintf('%s.*', (new StudentDetail())->table));
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
            $table->editColumn('is_handicapped', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->is_handicapped ? 'checked' : null) . '>';
            });
            $table->editColumn('gender', function ($row) {
                return $row->gender ? StudentDetail::GENDER_SELECT[$row->gender] : '';
            });
            $table->editColumn('country', function ($row) {
                return $row->country ? $row->country : '';
            });
            $table->editColumn('home_address', function ($row) {
                return $row->home_address ? $row->home_address : '';
            });
            $table->editColumn('mail_address', function ($row) {
                return $row->mail_address ? $row->mail_address : '';
            });
            $table->editColumn('state', function ($row) {
                return $row->state ? $row->state : '';
            });
            $table->editColumn('city', function ($row) {
                return $row->city ? $row->city : '';
            });
            $table->editColumn('postcode', function ($row) {
                return $row->postcode ? $row->postcode : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            $table->editColumn('nric_no', function ($row) {
                return $row->nric_no ? $row->nric_no : '';
            });
            $table->addColumn('user_email', function ($row) {
                return $row->user ? $row->user->email : '';
            });

            $table->editColumn('user.name', function ($row) {
                return $row->user ? (is_string($row->user) ? $row->user : $row->user->name) : '';
            });
            $table->editColumn('guardian', function ($row) {
                $labels = [];
                foreach ($row->guardians as $guardian) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $guardian->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'is_handicapped', 'user', 'guardian']);

            return $table->make(true);
        }

        $users           = User::get();
        $student_parents = StudentParent::get();

        return view('admin.studentDetails.index', compact('users', 'student_parents'));
    }

    public function create()
    {
        abort_if(Gate::denies('student_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $guardians = StudentParent::pluck('name', 'id');

        return view('admin.studentDetails.create', compact('guardians', 'users'));
    }

    public function store(StoreStudentDetailRequest $request)
    {
        $studentDetail = StudentDetail::create($request->all());
        $studentDetail->guardians()->sync($request->input('guardians', []));

        return redirect()->route('admin.student-details.index');
    }

    public function edit(StudentDetail $studentDetail)
    {
        abort_if(Gate::denies('student_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $guardians = StudentParent::pluck('name', 'id');

        $studentDetail->load('user', 'created_by', 'guardians');

        return view('admin.studentDetails.edit', compact('guardians', 'studentDetail', 'users'));
    }

    public function update(UpdateStudentDetailRequest $request, StudentDetail $studentDetail)
    {
        $studentDetail->update($request->all());
        $studentDetail->guardians()->sync($request->input('guardians', []));

        return redirect()->route('admin.student-details.index');
    }

    public function show(StudentDetail $studentDetail)
    {
        abort_if(Gate::denies('student_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentDetail->load('user', 'created_by', 'guardians');

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
