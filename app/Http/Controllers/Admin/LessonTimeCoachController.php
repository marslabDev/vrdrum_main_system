<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLessonTimeCoachRequest;
use App\Http\Requests\StoreLessonTimeCoachRequest;
use App\Http\Requests\UpdateLessonTimeCoachRequest;
use App\Models\LessonTime;
use App\Models\LessonTimeCoach;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LessonTimeCoachController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('lesson_time_coach_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LessonTimeCoach::with(['lesson_time', 'created_by'])->select(sprintf('%s.*', (new LessonTimeCoach())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'lesson_time_coach_show';
                $editGate = 'lesson_time_coach_edit';
                $deleteGate = 'lesson_time_coach_delete';
                $crudRoutePart = 'lesson-time-coaches';

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

            $table->editColumn('coach_efk', function ($row) {
                return $row->coach_efk ? $row->coach_efk : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'lesson_time']);

            return $table->make(true);
        }

        return view('admin.lessonTimeCoaches.index');
    }

    public function create()
    {
        abort_if(Gate::denies('lesson_time_coach_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_times = LessonTime::pluck('lesson_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lessonTimeCoaches.create', compact('lesson_times'));
    }

    public function store(StoreLessonTimeCoachRequest $request)
    {
        $lessonTimeCoach = LessonTimeCoach::create($request->all());

        return redirect()->route('admin.lesson-time-coaches.index');
    }

    public function edit(LessonTimeCoach $lessonTimeCoach)
    {
        abort_if(Gate::denies('lesson_time_coach_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_times = LessonTime::pluck('lesson_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessonTimeCoach->load('lesson_time', 'created_by');

        return view('admin.lessonTimeCoaches.edit', compact('lessonTimeCoach', 'lesson_times'));
    }

    public function update(UpdateLessonTimeCoachRequest $request, LessonTimeCoach $lessonTimeCoach)
    {
        $lessonTimeCoach->update($request->all());

        return redirect()->route('admin.lesson-time-coaches.index');
    }

    public function show(LessonTimeCoach $lessonTimeCoach)
    {
        abort_if(Gate::denies('lesson_time_coach_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTimeCoach->load('lesson_time', 'created_by');

        return view('admin.lessonTimeCoaches.show', compact('lessonTimeCoach'));
    }

    public function destroy(LessonTimeCoach $lessonTimeCoach)
    {
        abort_if(Gate::denies('lesson_time_coach_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTimeCoach->delete();

        return back();
    }

    public function massDestroy(MassDestroyLessonTimeCoachRequest $request)
    {
        LessonTimeCoach::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
