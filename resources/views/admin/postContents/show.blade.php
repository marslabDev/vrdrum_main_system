@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.postContent.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.post-contents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.postContent.fields.id') }}
                        </th>
                        <td>
                            {{ $postContent->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postContent.fields.resource_type') }}
                        </th>
                        <td>
                            {{ App\Models\PostContent::RESOURCE_TYPE_SELECT[$postContent->resource_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postContent.fields.submit_type') }}
                        </th>
                        <td>
                            {{ App\Models\PostContent::SUBMIT_TYPE_SELECT[$postContent->submit_type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postContent.fields.title') }}
                        </th>
                        <td>
                            {{ $postContent->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postContent.fields.desc') }}
                        </th>
                        <td>
                            {!! $postContent->desc !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postContent.fields.attachment') }}
                        </th>
                        <td>
                            @foreach($postContent->attachment as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postContent.fields.mark') }}
                        </th>
                        <td>
                            {{ $postContent->mark }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postContent.fields.required_response') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $postContent->required_response ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postContent.fields.objective_selections') }}
                        </th>
                        <td>
                            {{ $postContent->objective_selections }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postContent.fields.objective_answers') }}
                        </th>
                        <td>
                            {{ $postContent->objective_answers }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postContent.fields.lesson_time_post') }}
                        </th>
                        <td>
                            {{ $postContent->lesson_time_post->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.post-contents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection