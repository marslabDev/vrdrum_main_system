<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLessonLevelRequest;
use App\Http\Requests\StoreLessonLevelRequest;
use App\Http\Requests\UpdateLessonLevelRequest;
use App\Models\LessonCategory;
use App\Models\LessonLevel;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LessonLevelController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('lesson_level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LessonLevel::with(['lesson_category', 'created_by'])->select(sprintf('%s.*', (new LessonLevel())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'lesson_level_show';
                $editGate = 'lesson_level_edit';
                $deleteGate = 'lesson_level_delete';
                $crudRoutePart = 'lesson-levels';

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
            $table->editColumn('level', function ($row) {
                return $row->level ? $row->level : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->addColumn('lesson_category_name', function ($row) {
                return $row->lesson_category ? $row->lesson_category->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'lesson_category']);

            return $table->make(true);
        }

        return view('admin.lessonLevels.index');
    }

    public function create()
    {
        abort_if(Gate::denies('lesson_level_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_categories = LessonCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lessonLevels.create', compact('lesson_categories'));
    }

    public function store(StoreLessonLevelRequest $request)
    {
        $lessonLevel = LessonLevel::create($request->all());

        return redirect()->route('admin.lesson-levels.index');
    }

    public function edit(LessonLevel $lessonLevel)
    {
        abort_if(Gate::denies('lesson_level_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_categories = LessonCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessonLevel->load('lesson_category', 'created_by');

        return view('admin.lessonLevels.edit', compact('lessonLevel', 'lesson_categories'));
    }

    public function update(UpdateLessonLevelRequest $request, LessonLevel $lessonLevel)
    {
        $lessonLevel->update($request->all());

        return redirect()->route('admin.lesson-levels.index');
    }

    public function show(LessonLevel $lessonLevel)
    {
        abort_if(Gate::denies('lesson_level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonLevel->load('lesson_category', 'created_by');

        return view('admin.lessonLevels.show', compact('lessonLevel'));
    }

    public function destroy(LessonLevel $lessonLevel)
    {
        abort_if(Gate::denies('lesson_level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonLevel->delete();

        return back();
    }

    public function massDestroy(MassDestroyLessonLevelRequest $request)
    {
        LessonLevel::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
