<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLessonCategoryRequest;
use App\Http\Requests\StoreLessonCategoryRequest;
use App\Http\Requests\UpdateLessonCategoryRequest;
use App\Models\LessonCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LessonCategoryController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('lesson_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LessonCategory::with(['created_by'])->select(sprintf('%s.*', (new LessonCategory())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'lesson_category_show';
                $editGate = 'lesson_category_edit';
                $deleteGate = 'lesson_category_delete';
                $crudRoutePart = 'lesson-categories';

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
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('desc', function ($row) {
                return $row->desc ? $row->desc : '';
            });
            $table->editColumn('group', function ($row) {
                return $row->group ? LessonCategory::GROUP_SELECT[$row->group] : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.lessonCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('lesson_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.lessonCategories.create');
    }

    public function store(StoreLessonCategoryRequest $request)
    {
        $lessonCategory = LessonCategory::create($request->all());

        return redirect()->route('admin.lesson-categories.index');
    }

    public function edit(LessonCategory $lessonCategory)
    {
        abort_if(Gate::denies('lesson_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonCategory->load('created_by');

        return view('admin.lessonCategories.edit', compact('lessonCategory'));
    }

    public function update(UpdateLessonCategoryRequest $request, LessonCategory $lessonCategory)
    {
        $lessonCategory->update($request->all());

        return redirect()->route('admin.lesson-categories.index');
    }

    public function show(LessonCategory $lessonCategory)
    {
        abort_if(Gate::denies('lesson_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonCategory->load('created_by');

        return view('admin.lessonCategories.show', compact('lessonCategory'));
    }

    public function destroy(LessonCategory $lessonCategory)
    {
        abort_if(Gate::denies('lesson_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyLessonCategoryRequest $request)
    {
        LessonCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
