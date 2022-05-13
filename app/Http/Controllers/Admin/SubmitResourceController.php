<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySubmitResourceRequest;
use App\Http\Requests\StoreSubmitResourceRequest;
use App\Http\Requests\UpdateSubmitResourceRequest;
use App\Models\StudentWork;
use App\Models\SubmitResource;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class SubmitResourceController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('submit_resource_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = SubmitResource::with(['student_work', 'created_by'])->select(sprintf('%s.*', (new SubmitResource())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'submit_resource_show';
                $editGate = 'submit_resource_edit';
                $deleteGate = 'submit_resource_delete';
                $crudRoutePart = 'submit-resources';

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
            $table->editColumn('answer_text', function ($row) {
                return $row->answer_text ? $row->answer_text : '';
            });
            $table->editColumn('attachment', function ($row) {
                return $row->attachment ? '<a href="' . $row->attachment->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->addColumn('student_work_title', function ($row) {
                return $row->student_work ? $row->student_work->title : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'attachment', 'student_work']);

            return $table->make(true);
        }

        return view('admin.submitResources.index');
    }

    public function create()
    {
        abort_if(Gate::denies('submit_resource_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student_works = StudentWork::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.submitResources.create', compact('student_works'));
    }

    public function store(StoreSubmitResourceRequest $request)
    {
        $submitResource = SubmitResource::create($request->all());

        if ($request->input('attachment', false)) {
            $submitResource->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $submitResource->id]);
        }

        return redirect()->route('admin.submit-resources.index');
    }

    public function edit(SubmitResource $submitResource)
    {
        abort_if(Gate::denies('submit_resource_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student_works = StudentWork::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $submitResource->load('student_work', 'created_by');

        return view('admin.submitResources.edit', compact('student_works', 'submitResource'));
    }

    public function update(UpdateSubmitResourceRequest $request, SubmitResource $submitResource)
    {
        $submitResource->update($request->all());

        if ($request->input('attachment', false)) {
            if (!$submitResource->attachment || $request->input('attachment') !== $submitResource->attachment->file_name) {
                if ($submitResource->attachment) {
                    $submitResource->attachment->delete();
                }
                $submitResource->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
            }
        } elseif ($submitResource->attachment) {
            $submitResource->attachment->delete();
        }

        return redirect()->route('admin.submit-resources.index');
    }

    public function show(SubmitResource $submitResource)
    {
        abort_if(Gate::denies('submit_resource_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $submitResource->load('student_work', 'created_by');

        return view('admin.submitResources.show', compact('submitResource'));
    }

    public function destroy(SubmitResource $submitResource)
    {
        abort_if(Gate::denies('submit_resource_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $submitResource->delete();

        return back();
    }

    public function massDestroy(MassDestroySubmitResourceRequest $request)
    {
        SubmitResource::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('submit_resource_create') && Gate::denies('submit_resource_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SubmitResource();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
