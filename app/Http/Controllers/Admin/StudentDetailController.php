<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStudentDetailRequest;
use App\Http\Requests\StoreStudentDetailRequest;
use App\Http\Requests\UpdateStudentDetailRequest;
use App\Models\LessonCategory;
use App\Models\Role;
use App\Models\StudentDetail;
use App\Models\User;
// use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StudentDetailController extends Controller
{
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
            $table->editColumn('group', function ($row) {
                return $row->group ? $row->group : '';
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
        
        $lessonCategories = LessonCategory::pluck('name')->toArray();
        /* TODO: Add Lesson Group
        * $lessonGroup = LessonGroup::pluck('name')->toArray(); 
        */    
        return view('admin.studentDetails.create', compact('lessonCategories'));
    }

    public function store(StoreStudentDetailRequest $request)
    {
        $request->validate([
            'full_name' => [
                function ($attribute, $value, $fail) use ($request) {
                    if ($value == $request->input('email')) {
                        $fail(trans('validation.name_cannot_same_with_email'));
                        return;
                    }
                },
            ],
            'parent_name' => [
                function ($attribute, $value, $fail) use ($request) {
                    if ($value == $request->input('full_name')) {
                        $fail(trans('validation.parent_cannot_same_with_student'));
                        return;
                    }
                },
            ],
        ]);
        $request->merge([
            "name"=>$request->input('full_name', ''),
            "is_disabled"=>$request->input('is_disabled', 0),
            "group"=>$request->input('lesson_group', '')//TODO: Add update db group
        ]);

        var_dump($request->all());
        $user = User::create($request->all());
        $prefix = '';
        switch (trim(strtoupper($request->input('lesson_group', '')))) {
            case 'PRIMARY':
                $prefix = 'primary_';
                break;
            case 'SECONDARY':
                $prefix = 'secondary_';
                break;
        }
        if(Role::where('title', $prefix.'student')->exists()) {
            $user->roles()->sync([$prefix.'Student']);
        } else if (Role::where('title', 'student')->exists()) {
            $user->roles()->sync(['Student']);
        } else {
            $user->roles()->sync([Role::first()->id]);
        }
        $request->merge([
            "student_efk"=>$user->id,
        ]);
        var_dump($request->all());
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
