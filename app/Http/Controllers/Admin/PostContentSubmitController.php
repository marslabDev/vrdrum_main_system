<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPostContentSubmitRequest;
use App\Http\Requests\StorePostContentSubmitRequest;
use App\Http\Requests\UpdatePostContentSubmitRequest;
use App\Models\PostContent;
use App\Models\PostContentSubmit;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PostContentSubmitController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('post_content_submit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PostContentSubmit::with(['post_content', 'created_by'])->select(sprintf('%s.*', (new PostContentSubmit())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'post_content_submit_show';
                $editGate = 'post_content_submit_edit';
                $deleteGate = 'post_content_submit_delete';
                $crudRoutePart = 'post-content-submits';

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
            $table->editColumn('objective_answers', function ($row) {
                return $row->objective_answers ? $row->objective_answers : '';
            });
            $table->addColumn('post_content_title', function ($row) {
                return $row->post_content ? $row->post_content->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'attachment', 'post_content']);

            return $table->make(true);
        }

        return view('admin.postContentSubmits.index');
    }

    public function create()
    {
        abort_if(Gate::denies('post_content_submit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post_contents = PostContent::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.postContentSubmits.create', compact('post_contents'));
    }

    public function store(StorePostContentSubmitRequest $request)
    {
        $postContentSubmit = PostContentSubmit::create($request->all());

        foreach ($request->input('attachment', []) as $file) {
            $postContentSubmit->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachment');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $postContentSubmit->id]);
        }

        return redirect()->route('admin.post-content-submits.index');
    }

    public function edit(PostContentSubmit $postContentSubmit)
    {
        abort_if(Gate::denies('post_content_submit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $post_contents = PostContent::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $postContentSubmit->load('post_content', 'created_by');

        return view('admin.postContentSubmits.edit', compact('postContentSubmit', 'post_contents'));
    }

    public function update(UpdatePostContentSubmitRequest $request, PostContentSubmit $postContentSubmit)
    {
        $postContentSubmit->update($request->all());

        if (count($postContentSubmit->attachment) > 0) {
            foreach ($postContentSubmit->attachment as $media) {
                if (!in_array($media->file_name, $request->input('attachment', []))) {
                    $media->delete();
                }
            }
        }
        $media = $postContentSubmit->attachment->pluck('file_name')->toArray();
        foreach ($request->input('attachment', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $postContentSubmit->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('attachment');
            }
        }

        return redirect()->route('admin.post-content-submits.index');
    }

    public function show(PostContentSubmit $postContentSubmit)
    {
        abort_if(Gate::denies('post_content_submit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postContentSubmit->load('post_content', 'created_by');

        return view('admin.postContentSubmits.show', compact('postContentSubmit'));
    }

    public function destroy(PostContentSubmit $postContentSubmit)
    {
        abort_if(Gate::denies('post_content_submit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $postContentSubmit->delete();

        return back();
    }

    public function massDestroy(MassDestroyPostContentSubmitRequest $request)
    {
        PostContentSubmit::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('post_content_submit_create') && Gate::denies('post_content_submit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new PostContentSubmit();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
