<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLessonTimeStudentRequest;
use App\Http\Requests\StoreLessonTimeStudentRequest;
use App\Http\Requests\UpdateLessonTimeStudentRequest;
use App\Models\LessonTime;
use App\Models\LessonTimeStudent;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LessonTimeStudentController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('lesson_time_student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LessonTimeStudent::with(['lesson_time', 'created_by'])->select(sprintf('%s.*', (new LessonTimeStudent())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'lesson_time_student_show';
                $editGate = 'lesson_time_student_edit';
                $deleteGate = 'lesson_time_student_delete';
                $crudRoutePart = 'lesson-time-students';

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

            $table->addColumn('lesson_time_lesson_code', function ($row) {
                return $row->lesson_time ? $row->lesson_time->lesson_code : '';
            });

            $table->editColumn('student_efk', function ($row) {
                return $row->student_efk ? $row->student_efk : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'lesson_time']);

            return $table->make(true);
        }

        return view('admin.lessonTimeStudents.index');
    }

    public function create()
    {
        abort_if(Gate::denies('lesson_time_student_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_times = LessonTime::pluck('lesson_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lessonTimeStudents.create', compact('lesson_times'));
    }

    public function store(StoreLessonTimeStudentRequest $request)
    {
        $lessonTimeStudent = LessonTimeStudent::create($request->all());

        return redirect()->route('admin.lesson-time-students.index');
    }

    public function edit(LessonTimeStudent $lessonTimeStudent)
    {
        abort_if(Gate::denies('lesson_time_student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_times = LessonTime::pluck('lesson_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessonTimeStudent->load('lesson_time', 'created_by');

        return view('admin.lessonTimeStudents.edit', compact('lessonTimeStudent', 'lesson_times'));
    }

    public function update(UpdateLessonTimeStudentRequest $request, LessonTimeStudent $lessonTimeStudent)
    {
        $lessonTimeStudent->update($request->all());

        return redirect()->route('admin.lesson-time-students.index');
    }

    public function show(LessonTimeStudent $lessonTimeStudent)
    {
        abort_if(Gate::denies('lesson_time_student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTimeStudent->load('lesson_time', 'created_by');

        return view('admin.lessonTimeStudents.show', compact('lessonTimeStudent'));
    }

    public function destroy(LessonTimeStudent $lessonTimeStudent)
    {
        abort_if(Gate::denies('lesson_time_student_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTimeStudent->delete();

        return back();
    }

    public function massDestroy(MassDestroyLessonTimeStudentRequest $request)
    {
        LessonTimeStudent::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
