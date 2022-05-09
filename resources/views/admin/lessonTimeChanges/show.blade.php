@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.lessonTimeChange.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lesson-time-changes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.id') }}
                        </th>
                        <td>
                            {{ $lessonTimeChange->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.old_lesson_time') }}
                        </th>
                        <td>
                            {{ $lessonTimeChange->old_lesson_time->lesson_code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.date_from') }}
                        </th>
                        <td>
                            {{ $lessonTimeChange->date_from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.date_to') }}
                        </th>
                        <td>
                            {{ $lessonTimeChange->date_to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.class_room') }}
                        </th>
                        <td>
                            {{ $lessonTimeChange->class_room->room_title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.lesson') }}
                        </th>
                        <td>
                            {{ $lessonTimeChange->lesson->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.status') }}
                        </th>
                        <td>
                            {{ $lessonTimeChange->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.request_date') }}
                        </th>
                        <td>
                            {{ $lessonTimeChange->request_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.request_user_efk') }}
                        </th>
                        <td>
                            {{ $lessonTimeChange->request_user_efk }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.response_date') }}
                        </th>
                        <td>
                            {{ $lessonTimeChange->response_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lessonTimeChange.fields.response_user_efk') }}
                        </th>
                        <td>
                            {{ $lessonTimeChange->response_user_efk }}
                        </td>
                    </tr>
                </tbody>
            </table>
            @if($lessonTimeChange->status == config('constants.lesson_time_change.status.pending'))
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <form method="POST" action="{{ route("admin.lesson-time-changes.toApproved", [$lessonTimeChange->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">
                                    {{ trans('global.approve') }}
                                </button>
                            </div>
                        </form>
                        <form method="POST" action="{{ route("admin.lesson-time-changes.toRejected", [$lessonTimeChange->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <button class="btn btn-danger" type="submit">
                                    {{ trans('global.reject') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lesson-time-changes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection