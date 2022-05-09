@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.coachMetum.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.coach-meta.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.coachMetum.fields.id') }}
                        </th>
                        <td>
                            {{ $coachMetum->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coachMetum.fields.meta_key') }}
                        </th>
                        <td>
                            {{ $coachMetum->meta_key }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coachMetum.fields.meta_value') }}
                        </th>
                        <td>
                            {{ $coachMetum->meta_value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.coachMetum.fields.coach_efk') }}
                        </th>
                        <td>
                            {{ $coachMetum->coach_efk }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.coach-meta.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection