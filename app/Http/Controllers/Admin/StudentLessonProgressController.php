<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyStudentLessonProgressRequest;
use App\Http\Requests\StoreStudentLessonProgressRequest;
use App\Http\Requests\UpdateStudentLessonProgressRequest;
use App\Models\LessonCategory;
use App\Models\StudentLessonProgress;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StudentLessonProgressController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('student_lesson_progress_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = StudentLessonProgress::with(['lesson_category', 'created_by'])->select(sprintf('%s.*', (new StudentLessonProgress())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'student_lesson_progress_show';
                $editGate = 'student_lesson_progress_edit';
                $deleteGate = 'student_lesson_progress_delete';
                $crudRoutePart = 'student-lesson-progresses';

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
            $table->editColumn('progress', function ($row) {
                return $row->progress ? $row->progress : '';
            });
            $table->addColumn('lesson_category_name', function ($row) {
                return $row->lesson_category ? $row->lesson_category->name : '';
            });

            $table->editColumn('student_efk', function ($row) {
                return $row->student_efk ? $row->student_efk : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'lesson_category']);

            return $table->make(true);
        }

        return view('admin.studentLessonProgresses.index');
    }

    public function create()
    {
        abort_if(Gate::denies('student_lesson_progress_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_categories = LessonCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.studentLessonProgresses.create', compact('lesson_categories'));
    }

    public function store(StoreStudentLessonProgressRequest $request)
    {
        $studentLessonProgress = StudentLessonProgress::create($request->all());

        return redirect()->route('admin.student-lesson-progresses.index');
    }

    public function edit(StudentLessonProgress $studentLessonProgress)
    {
        abort_if(Gate::denies('student_lesson_progress_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_categories = LessonCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $studentLessonProgress->load('lesson_category', 'created_by');

        return view('admin.studentLessonProgresses.edit', compact('lesson_categories', 'studentLessonProgress'));
    }

    public function update(UpdateStudentLessonProgressRequest $request, StudentLessonProgress $studentLessonProgress)
    {
        $studentLessonProgress->update($request->all());

        return redirect()->route('admin.student-lesson-progresses.index');
    }

    public function show(StudentLessonProgress $studentLessonProgress)
    {
        abort_if(Gate::denies('student_lesson_progress_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentLessonProgress->load('lesson_category', 'created_by');

        return view('admin.studentLessonProgresses.show', compact('studentLessonProgress'));
    }

    public function destroy(StudentLessonProgress $studentLessonProgress)
    {
        abort_if(Gate::denies('student_lesson_progress_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $studentLessonProgress->delete();

        return back();
    }

    public function massDestroy(MassDestroyStudentLessonProgressRequest $request)
    {
        StudentLessonProgress::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
