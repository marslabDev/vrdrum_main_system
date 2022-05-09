@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.submitResource.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.submit-resources.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.submitResource.fields.id') }}
                        </th>
                        <td>
                            {{ $submitResource->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.submitResource.fields.title') }}
                        </th>
                        <td>
                            {{ $submitResource->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.submitResource.fields.answer_text') }}
                        </th>
                        <td>
                            {{ $submitResource->answer_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.submitResource.fields.url') }}
                        </th>
                        <td>
                            {{ $submitResource->url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.submitResource.fields.student_work') }}
                        </th>
                        <td>
                            {{ $submitResource->student_work->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.submit-resources.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection