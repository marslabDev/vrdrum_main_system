<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLessonCoachRequest;
use App\Http\Requests\StoreLessonCoachRequest;
use App\Http\Requests\UpdateLessonCoachRequest;
use App\Models\Lesson;
use App\Models\LessonCoach;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LessonCoachController extends Controller
{
    use CsvImportTrait;
    
    public function index(Request $request)
    {
        abort_if(Gate::denies('lesson_coach_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LessonCoach::with(['lesson', 'created_by'])->select(sprintf('%s.*', (new LessonCoach())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'lesson_coach_show';
                $editGate = 'lesson_coach_edit';
                $deleteGate = 'lesson_coach_delete';
                $crudRoutePart = 'lesson-coaches';

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
            $table->addColumn('lesson_name', function ($row) {
                return $row->lesson ? $row->lesson->name : '';
            });

            $table->editColumn('coach_efk', function ($row) {
                return $row->coach_efk ? $row->coach_efk : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'lesson']);

            return $table->make(true);
        }

        return view('admin.lessonCoaches.index');
    }

    public function create()
    {
        abort_if(Gate::denies('lesson_coach_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessons = Lesson::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lessonCoaches.create', compact('lessons'));
    }

    public function store(StoreLessonCoachRequest $request)
    {
        $lessonCoach = LessonCoach::create($request->all());

        return redirect()->route('admin.lesson-coaches.index');
    }

    public function edit(LessonCoach $lessonCoach)
    {
        abort_if(Gate::denies('lesson_coach_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessons = Lesson::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessonCoach->load('lesson', 'created_by');

        return view('admin.lessonCoaches.edit', compact('lessonCoach', 'lessons'));
    }

    public function update(UpdateLessonCoachRequest $request, LessonCoach $lessonCoach)
    {
        $lessonCoach->update($request->all());

        return redirect()->route('admin.lesson-coaches.index');
    }

    public function show(LessonCoach $lessonCoach)
    {
        abort_if(Gate::denies('lesson_coach_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonCoach->load('lesson', 'created_by');

        return view('admin.lessonCoaches.show', compact('lessonCoach'));
    }

    public function destroy(LessonCoach $lessonCoach)
    {
        abort_if(Gate::denies('lesson_coach_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonCoach->delete();

        return back();
    }

    public function massDestroy(MassDestroyLessonCoachRequest $request)
    {
        LessonCoach::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
