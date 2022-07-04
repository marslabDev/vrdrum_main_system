@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.postComment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.post-comments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.postComment.fields.id') }}
                        </th>
                        <td>
                            {{ $postComment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postComment.fields.content') }}
                        </th>
                        <td>
                            {!! $postComment->content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postComment.fields.attachment') }}
                        </th>
                        <td>
                            @if($postComment->attachment)
                                <a href="{{ $postComment->attachment->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postComment.fields.lesson_time_post') }}
                        </th>
                        <td>
                            {{ $postComment->lesson_time_post->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postComment.fields.sender_efk') }}
                        </th>
                        <td>
                            {{ $postComment->sender_efk }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.post-comments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection