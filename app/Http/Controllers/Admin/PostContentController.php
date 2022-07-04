<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPostContentRequest;
use App\Http\Requests\StorePostContentRequest;
use App\Http\Requests\UpdatePostContentRequest;
use App\Models\LessonTimePost;
use App\Models\PostContent;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PostContentController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('post_content_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PostContent::with(['lesson_time_post', 'created_by'])->select(sprintf('%s.*', (new PostContent())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'post_content_show';
                $editGate = 'post_content_edit';
                $deleteGate = 'post_content_delete';
                $crudRoutePart = 'post-contents';

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
            $table->editColumn('resource_type', function ($row) {
                return $row->resource_type ? PostContent::RESOURCE_TYPE_SELECT[$row->resource_type] : '';
            });
            $table->editColumn('submit_type', function ($row) {
                return $row->submit_type ? PostContent::SUBMIT_TYPE_SELECT[$row->submit_type] : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('attachment', function ($row) {
                if (!$row->attachment) {
                    return '';
                }
                $links = [];
                foreach ($row->attachment as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('mark', function ($row) {
                return $row->mark ? $row->mark : '';
            });
            $table->editColumn('required_response', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->required_response ? 'checked' : null) . '>';
            });
            $table->editColumn('objective_selections', function ($row) {
                return $row->objective_selections ? $row->objective_selections : '';
            });
            $table->editColumn('objective_answers', function ($row) {
                return $row->objective_answers ? $row->objective_answers : '';
            });
            $table->addColumn('lesson_time_post_title', function ($row) {
                return $row->lesson_time_post ? $row->lesson_time_post->title : '';
            });

            $table->editColumn('lesson_time_post.title', function ($row) {
                return $row->lesson_time_post ? (is_string($row->lesson_time_post) ? $row->lesson_time_post : $row->lesson_time_post->title) : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'attachment', 'required_response', 'lesson_time_post']);

            return $table->make(true);
        }

        return view('admin.postContents.index');
    }

    public function create()
    {
        abort_if(Gate::denies('post_content_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_time_posts = LessonTimePost::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.postContents.create', compact('lesson_time_posts'));
    }

    public function store(StorePostContentRequest $request)
    {
        $postContent = PostContent::create($request->all());

        foreach ($request->input('attachment', []) as $file) {
            $postContent->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachment');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $postContent->id]);
        }

        return redirect()->route('admin.post-contents.index');
    }

    public function edit(PostContent $postContent)
    {
        abort_if(Gate::denies('post_content_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lesson_time_posts = LessonTimePost::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $postContent->load('lesson_time_post', 'created_by');

        return view('admin.postContents.edit', compact('lesson_time_posts', 'postContent'));
    }

    public function update(UpdatePostContentRequest $request, PostContent $postContent)
    {
        $postContent->update($request->all());

        if (count($postContent->attachment) > 0) {
            foreach ($postContent->attachment as $media) {
                if (!in_array($media->file_name, $request->input('attachment', []))) {
                    $media->delete();
                }
            }
        }
        $media = $postContent->attachment->pluck('file_name')->toArray();
        foreach ($request->input('attachment', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $postContent->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachment');
            }
        }

        return redirect()->route('admin.post-contents.index');
    }

    public function show(PostContent $postContent)
    {
        abort_if(Gate::denies('post_content_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postContent->load('lesson_time_post', 'created_by');

        return view('admin.postContents.show', compact('postContent'));
    }

    public function destroy(PostContent $postContent)
    {
        abort_if(Gate::denies('post_content_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postContent->delete();

        return back();
    }

    public function massDestroy(MassDestroyPostContentRequest $request)
    {
        PostContent::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('post_content_create') && Gate::denies('post_content_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PostContent();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
