@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.workResource.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.work-resources.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.workResource.fields.id') }}
                        </th>
                        <td>
                            {{ $workResource->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workResource.fields.title') }}
                        </th>
                        <td>
                            {{ $workResource->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workResource.fields.question_text') }}
                        </th>
                        <td>
                            {{ $workResource->question_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workResource.fields.attachment') }}
                        </th>
                        <td>
                            @if($workResource->attachment)
                                <a href="{{ $workResource->attachment->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.workResource.fields.student_work') }}
                        </th>
                        <td>
                            {{ $workResource->student_work->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.work-resources.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection