<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyLessonRequest;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Models\CoachDetail;
use App\Models\LessonCoach;
use App\Models\Lesson;
use App\Models\LessonCategory;
use App\Models\LessonLevel;
use Gate;
use Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

use App\Http\Controllers\Admin\LessonCoachController;
use App\Http\Requests\StoreLessonCoachRequest;

class LessonWithLessonCoachController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('lesson_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Lesson::with(['lesson_level', 'created_by'])->select(sprintf('%s.*', (new Lesson())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'lesson_show';
                $editGate = 'lesson_edit';
                $deleteGate = 'lesson_delete';
                $crudRoutePart = 'lessons';

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
            $table->editColumn('no_of_class', function ($row) {
                return $row->no_of_class ? $row->no_of_class : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('syllabus', function ($row) {
                return $row->syllabus ? $row->syllabus : '';
            });
            $table->addColumn('lesson_level_level', function ($row) {
                return $row->lesson_level ? $row->lesson_level->level : '';
            });
            $table->addColumn('coachs_efk', function ($row) {
                $coachs_efk = LessonCoach::where('lesson_id', $row->id)->get();

                $coachs_efk_str = [];
                foreach ($coachs_efk as $index => $value){
                    $coachs_efk_str[$index] = $value->coach_efk;
                }
                $coachs_efk_str = implode(", ", $coachs_efk_str);

                return $coachs_efk_str;
            });

            $table->rawColumns(['actions', 'placeholder', 'lesson_level']);

            return $table->make(true);
        }

        return view('admin.lessons.index');
    }

    public function create($errors = null)
    {
        abort_if(Gate::denies('lesson_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_levels = [ '' => trans('global.pleaseSelect') ];

        $all_lesson_level = LessonLevel::all();
        foreach ($all_lesson_level as $index => $value){
            $lesson_category = LessonCategory::find($value->lesson_category_id);
            $lesson_levels[$value->id] = $lesson_category->name . ' - ' . $value->level;
        }

        $coachs = CoachDetail::pluck('coach_efk', 'coach_efk');

        if($errors != null) return view('admin.lessons.create', compact('lesson_levels', 'coachs'))->withErrors($errors);

        return view('admin.lessons.create', compact('lesson_levels', 'coachs'));
    }

    public function store(StoreLessonRequest $request)
    {
        $request_data = $request->all();

        // ------------------------------ validation ------------------------------
        $errors = [];

        if ($request_data['lesson_level_id'] == null){
            $errors['lesson_level'] = trans('validation.lesson_level_required');
        }

        if(count($errors) > 0){
            return $this->create($errors);
        }

        // ------------------------------ data assign ------------------------------
        $request_data['no_of_class'] = Lesson::where('lesson_level_id', $request_data['lesson_level_id'])->get()->count() + 1;

        $lesson = Lesson::create($request_data);

        // ------------------------------ create lesson coach ------------------------------
        if (array_key_exists('coachs_efk', $request_data)){
            $coachs_efk = $request_data['coachs_efk'];

            foreach ($coachs_efk as $index => $value){
                $lesson_coach = [
                    'lesson_id' => $lesson->id,
                    'coach_efk' => $value
                ];

                LessonCoach::create($lesson_coach);
            }
        }

        return redirect()->route('admin.lessons.index');
    }

    public function edit(Lesson $lesson, $errors = null)
    {
        abort_if(Gate::denies('lesson_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson->load('lesson_level', 'created_by');

        $lesson_levels = [ '' => trans('global.pleaseSelect') ];

        $all_lesson_level = LessonLevel::all();
        foreach ($all_lesson_level as $index => $value){
            $lesson_category = LessonCategory::find($value->lesson_category_id);
            $lesson_levels[$value->id] = $lesson_category->name . ' - ' . $value->level;
        }

        $coachs = CoachDetail::pluck('coach_efk', 'coach_efk');

        $current_coachs_efk = LessonCoach::where('lesson_id', $lesson->id)->get();

        $old_coachs_efk = [];
        foreach ($current_coachs_efk as $index => $value){
            $old_coachs_efk[$value->coach_efk] = $value->coach_efk;
        }
        
        if($errors != null) return view('admin.lessons.edit', compact('lesson', 'lesson_levels', 'coachs', 'old_coachs_efk'))->withErrors($errors);

        return view('admin.lessons.edit', compact('lesson', 'lesson_levels', 'coachs', 'old_coachs_efk'));
    }

    public function update(UpdateLessonRequest $request, Lesson $lesson)
    {
        $request_data = $request->all();

        // ------------------------------ validation ------------------------------
        $errors = [];

        if ($request_data['lesson_level_id'] == null){
            $errors['lesson_level'] = trans('validation.lesson_level_required');
        }

        if(count($errors) > 0){
            return $this->edit($lesson, $errors);
        }

        // ------------------------------ data assign ------------------------------
        if($lesson->lesson_level_id != $request_data['lesson_level_id']){
            $request_data['no_of_class'] = Lesson::where('lesson_level_id', $request_data['lesson_level_id'])->get()->count() + 1;
        }

        $lesson->update($request_data);

        // ------------------------------ create lesson coach ------------------------------
        if (array_key_exists('coachs_efk', $request_data)){
            $current_coachs_efk = LessonCoach::where('lesson_id', $lesson->id)->get();

            $coachs_efk = $request_data['coachs_efk'];

            // for create new coach & pop the same coach
            foreach ($coachs_efk as $index => $value){
                $lesson_coach = [
                    'lesson_id' => $lesson->id,
                    'coach_efk' => $value
                ];

                $is_found = false;

                foreach ($current_coachs_efk as $current_coach_index => $current_coach_value){
                    if ($current_coach_value->lesson_id == $lesson_coach['lesson_id'] && $current_coach_value->coach_efk == $lesson_coach['coach_efk']){
                        unset($current_coachs_efk[$current_coach_index]);
                        $is_found = true;
                        break;
                    }
                }

                if($is_found == false){
                    LessonCoach::create($lesson_coach);
                }
            }

            // for delete coach
            foreach ($current_coachs_efk as $index => $value){
                LessonCoach::find($value->id)->delete();
            }
        }

        return redirect()->route('admin.lessons.index');
    }

    public function show(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson->load('lesson_level', 'created_by');

        $lesson_coach_efk = LessonCoach::where('lesson_id', $lesson->id)->get();

        $coachs_efk = [];
        foreach ($lesson_coach_efk as $index => $value){
            $coachs_efk[$index] = $value->coach_efk;
        }
        $coachs_efk = implode(", ", $coachs_efk);
        
        return view('admin.lessons.show', compact('lesson', 'coachs_efk'));
    }

    public function destroy(Lesson $lesson)
    {
        abort_if(Gate::denies('lesson_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        // ------------------------------ validation ------------------------------
        $last_lesson = Lesson::where('lesson_level_id', $lesson->lesson_level_id)->orderBy('no_of_class', 'DESC')->get()->first();

        if($last_lesson != null && $lesson->id != $last_lesson->id){
            return back()->withErrors(['lesson_level' => trans('validation.lesson_level_delete_last')]);
        }

        $lesson->delete();

        return back();
    }

    public function massDestroy(MassDestroyLessonRequest $request)
    {
        // Lesson::whereIn('id', request('ids'))->delete();
        // $lesson = Lesson::whereIn('id', request('ids'))->get();
        // return response()->json($lesson);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
