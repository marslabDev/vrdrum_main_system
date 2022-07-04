@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.postSubmission.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.post-submissions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.postSubmission.fields.id') }}
                        </th>
                        <td>
                            {{ $postSubmission->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postSubmission.fields.status') }}
                        </th>
                        <td>
                            {{ $postSubmission->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postSubmission.fields.submit_at') }}
                        </th>
                        <td>
                            {{ $postSubmission->submit_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postSubmission.fields.mark') }}
                        </th>
                        <td>
                            {{ $postSubmission->mark }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postSubmission.fields.mark_at') }}
                        </th>
                        <td>
                            {{ $postSubmission->mark_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postSubmission.fields.lesson_time_post') }}
                        </th>
                        <td>
                            {{ $postSubmission->lesson_time_post->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.postSubmission.fields.student_efk') }}
                        </th>
                        <td>
                            {{ $postSubmission->student_efk }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.post-submissions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection