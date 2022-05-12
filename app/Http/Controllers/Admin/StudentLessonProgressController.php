<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStudentLessonProgressRequest;
use App\Http\Requests\StoreStudentLessonProgressRequest;
use App\Http\Requests\UpdateStudentLessonProgressRequest;
use App\Models\LessonCategory;
use App\Models\LessonLevel;
use App\Models\Lesson;
use App\Models\StudentLessonProgress;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class StudentLessonProgressController extends Controller
{
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
                $editGate = 'null';
                // $editGate = 'student_lesson_progress_edit';
                $deleteGate = 'null';
                // $deleteGate = 'student_lesson_progress_delete';
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

        // ------------------------------ check has next level ------------------------------
        $has_next_level = false;

        $progress_ary = explode(",", $studentLessonProgress->progress);
        $level = (int)$progress_ary[0];
        $lesson = (int)$progress_ary[1];

        $current_lesson_level = LessonLevel::find($level);
        $total_lesson_level = LessonLevel::where('lesson_category_id', $studentLessonProgress->lesson_category_id)->get();
        $total_lesson = Lesson::where('lesson_level_id', $current_lesson_level->id)->get();

        if($lesson + 1 <= count($total_lesson)){
            $has_next_level = true;
        }else if($level + 1 <= count($total_lesson_level)){
            $next_lesson_level = null;

            foreach ($total_lesson_level as $index => $value){
                if($value->level == $level + 1){
                    $next_lesson_level = $value;
                    break;
                }
            }
            
            if($next_lesson_level != null){
                $total_lesson = Lesson::where('lesson_level_id', $next_lesson_level->id)->get();

                if(count($total_lesson) >= 1){
                    $has_next_level = true;
                }
            }
        }

        // ------------------------------ check has low level ------------------------------
        $has_low_level = true;

        $progress_ary = explode(",", $studentLessonProgress->progress);
        $level = (int)$progress_ary[0];
        $lesson = (int)$progress_ary[1];

        if($level == 1 && $lesson == 1){
            $has_low_level = false;
        }

        return view('admin.studentLessonProgresses.show', compact('studentLessonProgress', 'has_next_level', 'has_low_level'));
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
