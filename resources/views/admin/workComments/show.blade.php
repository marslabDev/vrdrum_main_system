@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.workComment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.work-comments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.workComment.fields.id') }}
                        </th>
                        <td>
                            {{ $workComment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workComment.fields.content') }}
                        </th>
                        <td>
                            {{ $workComment->content }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workComment.fields.attachment') }}
                        </th>
                        <td>
                            @if($workComment->attachment)
                                <a href="{{ $workComment->attachment->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $workComment->attachment->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workComment.fields.student_work') }}
                        </th>
                        <td>
                            {{ $workComment->student_work->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workComment.fields.sender_efk') }}
                        </th>
                        <td>
                            {{ $workComment->sender_efk }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.work-comments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection