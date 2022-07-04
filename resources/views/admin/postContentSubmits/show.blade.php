@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.postContentSubmit.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.post-content-submits.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.postContentSubmit.fields.id') }}
                        </th>
                        <td>
                            {{ $postContentSubmit->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postContentSubmit.fields.title') }}
                        </th>
                        <td>
                            {{ $postContentSubmit->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postContentSubmit.fields.desc') }}
                        </th>
                        <td>
                            {!! $postContentSubmit->desc !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postContentSubmit.fields.attachment') }}
                        </th>
                        <td>
                            @foreach($postContentSubmit->attachment as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postContentSubmit.fields.mark') }}
                        </th>
                        <td>
                            {{ $postContentSubmit->mark }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postContentSubmit.fields.objective_answers') }}
                        </th>
                        <td>
                            {{ $postContentSubmit->objective_answers }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postContentSubmit.fields.post_content') }}
                        </th>
                        <td>
                            {{ $postContentSubmit->post_content->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.post-content-submits.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection