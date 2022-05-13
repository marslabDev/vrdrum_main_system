<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLessonTimeChangeRequest;
use App\Http\Requests\StoreLessonTimeChangeRequest;
use App\Http\Requests\UpdateLessonTimeChangeRequest;
use App\Models\ClassRoom;
use App\Models\Lesson;
use App\Models\LessonTime;
use App\Models\LessonTimeChange;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LessonTimeChangeController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('lesson_time_change_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LessonTimeChange::with(['old_lesson_time', 'class_room', 'lesson', 'created_by'])->select(sprintf('%s.*', (new LessonTimeChange())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'lesson_time_change_show';
                $editGate = 'lesson_time_change_edit';
                $deleteGate = 'lesson_time_change_delete';
                $crudRoutePart = 'lesson-time-changes';

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
            $table->addColumn('old_lesson_time_lesson_code', function ($row) {
                return $row->old_lesson_time ? $row->old_lesson_time->lesson_code : '';
            });

            $table->addColumn('class_room_room_title', function ($row) {
                return $row->class_room ? $row->class_room->room_title : '';
            });

            $table->addColumn('lesson_name', function ($row) {
                return $row->lesson ? $row->lesson->name : '';
            });

            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });

            $table->editColumn('request_user_efk', function ($row) {
                return $row->request_user_efk ? $row->request_user_efk : '';
            });

            $table->editColumn('response_user_efk', function ($row) {
                return $row->response_user_efk ? $row->response_user_efk : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'old_lesson_time', 'class_room', 'lesson']);

            return $table->make(true);
        }

        return view('admin.lessonTimeChanges.index');
    }

    public function create()
    {
        abort_if(Gate::denies('lesson_time_change_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $old_lesson_times = LessonTime::pluck('lesson_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $class_rooms = ClassRoom::pluck('room_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessons = Lesson::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lessonTimeChanges.create', compact('class_rooms', 'lessons', 'old_lesson_times'));
    }

    public function store(StoreLessonTimeChangeRequest $request)
    {
        $lessonTimeChange = LessonTimeChange::create($request->all());

        return redirect()->route('admin.lesson-time-changes.index');
    }

    public function edit(LessonTimeChange $lessonTimeChange)
    {
        abort_if(Gate::denies('lesson_time_change_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $old_lesson_times = LessonTime::pluck('lesson_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $class_rooms = ClassRoom::pluck('room_title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessons = Lesson::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessonTimeChange->load('old_lesson_time', 'class_room', 'lesson', 'created_by');

        return view('admin.lessonTimeChanges.edit', compact('class_rooms', 'lessonTimeChange', 'lessons', 'old_lesson_times'));
    }

    public function update(UpdateLessonTimeChangeRequest $request, LessonTimeChange $lessonTimeChange)
    {
        $lessonTimeChange->update($request->all());

        return redirect()->route('admin.lesson-time-changes.index');
    }

    public function show(LessonTimeChange $lessonTimeChange)
    {
        abort_if(Gate::denies('lesson_time_change_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTimeChange->load('old_lesson_time', 'class_room', 'lesson', 'created_by');

        return view('admin.lessonTimeChanges.show', compact('lessonTimeChange'));
    }

    public function destroy(LessonTimeChange $lessonTimeChange)
    {
        abort_if(Gate::denies('lesson_time_change_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTimeChange->delete();

        return back();
    }

    public function massDestroy(MassDestroyLessonTimeChangeRequest $request)
    {
        LessonTimeChange::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
