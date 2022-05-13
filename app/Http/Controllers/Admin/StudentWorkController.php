<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyStudentWorkRequest;
use App\Http\Requests\StoreStudentWorkRequest;
use App\Http\Requests\UpdateStudentWorkRequest;
use App\Models\LessonTime;
use App\Models\StudentWork;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StudentWorkController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('student_work_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StudentWork::with(['lesson_time', 'created_by'])->select(sprintf('%s.*', (new StudentWork())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'student_work_show';
                $editGate = 'student_work_edit';
                $deleteGate = 'student_work_delete';
                $crudRoutePart = 'student-works';

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
            $table->editColumn('category', function ($row) {
                return $row->category ? StudentWork::CATEGORY_SELECT[$row->category] : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('desc', function ($row) {
                return $row->desc ? $row->desc : '';
            });

            $table->editColumn('time_given_minute', function ($row) {
                return $row->time_given_minute ? $row->time_given_minute : '';
            });
            $table->addColumn('lesson_time_lesson_code', function ($row) {
                return $row->lesson_time ? $row->lesson_time->lesson_code : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'lesson_time']);

            return $table->make(true);
        }

        return view('admin.studentWorks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('student_work_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_times = LessonTime::pluck('lesson_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.studentWorks.create', compact('lesson_times'));
    }

    public function store(StoreStudentWorkRequest $request)
    {
        $studentWork = StudentWork::create($request->all());

        return redirect()->route('admin.student-works.index');
    }

    public function edit(StudentWork $studentWork)
    {
        abort_if(Gate::denies('student_work_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_times = LessonTime::pluck('lesson_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $studentWork->load('lesson_time', 'created_by');

        return view('admin.studentWorks.edit', compact('lesson_times', 'studentWork'));
    }

    public function update(UpdateStudentWorkRequest $request, StudentWork $studentWork)
    {
        $studentWork->update($request->all());

        return redirect()->route('admin.student-works.index');
    }

    public function show(StudentWork $studentWork)
    {
        abort_if(Gate::denies('student_work_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentWork->load('lesson_time', 'created_by');

        return view('admin.studentWorks.show', compact('studentWork'));
    }

    public function destroy(StudentWork $studentWork)
    {
        abort_if(Gate::denies('student_work_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentWork->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentWorkRequest $request)
    {
        StudentWork::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
