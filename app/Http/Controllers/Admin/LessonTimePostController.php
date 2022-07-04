<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLessonTimePostRequest;
use App\Http\Requests\StoreLessonTimePostRequest;
use App\Http\Requests\UpdateLessonTimePostRequest;
use App\Models\LessonTime;
use App\Models\LessonTimePost;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LessonTimePostController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('lesson_time_post_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = LessonTimePost::with(['lesson_time', 'created_by'])->select(sprintf('%s.*', (new LessonTimePost())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'lesson_time_post_show';
                $editGate = 'lesson_time_post_edit';
                $deleteGate = 'lesson_time_post_delete';
                $crudRoutePart = 'lesson-time-posts';

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
            $table->editColumn('group', function ($row) {
                return $row->group ? $row->group : '';
            });
            $table->editColumn('category', function ($row) {
                return $row->category ? LessonTimePost::CATEGORY_SELECT[$row->category] : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->editColumn('required_response', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->required_response ? 'checked' : null) . '>';
            });
            $table->addColumn('lesson_time_lesson_code', function ($row) {
                return $row->lesson_time ? $row->lesson_time->lesson_code : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'required_response', 'lesson_time']);

            return $table->make(true);
        }

        return view('admin.lessonTimePosts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('lesson_time_post_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_times = LessonTime::pluck('lesson_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lessonTimePosts.create', compact('lesson_times'));
    }

    public function store(StoreLessonTimePostRequest $request)
    {
        $lessonTimePost = LessonTimePost::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $lessonTimePost->id]);
        }

        return redirect()->route('admin.lesson-time-posts.index');
    }

    public function edit(LessonTimePost $lessonTimePost)
    {
        abort_if(Gate::denies('lesson_time_post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_times = LessonTime::pluck('lesson_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lessonTimePost->load('lesson_time', 'created_by');

        return view('admin.lessonTimePosts.edit', compact('lessonTimePost', 'lesson_times'));
    }

    public function update(UpdateLessonTimePostRequest $request, LessonTimePost $lessonTimePost)
    {
        $lessonTimePost->update($request->all());

        return redirect()->route('admin.lesson-time-posts.index');
    }

    public function show(LessonTimePost $lessonTimePost)
    {
        abort_if(Gate::denies('lesson_time_post_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTimePost->load('lesson_time', 'created_by');

        return view('admin.lessonTimePosts.show', compact('lessonTimePost'));
    }

    public function destroy(LessonTimePost $lessonTimePost)
    {
        abort_if(Gate::denies('lesson_time_post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lessonTimePost->delete();

        return back();
    }

    public function massDestroy(MassDestroyLessonTimePostRequest $request)
    {
        LessonTimePost::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('lesson_time_post_create') && Gate::denies('lesson_time_post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new LessonTimePost();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
