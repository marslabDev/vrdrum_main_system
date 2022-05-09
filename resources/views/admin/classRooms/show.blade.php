@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.classRoom.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.class-rooms.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.classRoom.fields.id') }}
                        </th>
                        <td>
                            {{ $classRoom->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.classRoom.fields.room_title') }}
                        </th>
                        <td>
                            {{ $classRoom->room_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.classRoom.fields.is_available') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $classRoom->is_available ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <!-- <tr>
                        <th>
                            {{ trans('cruds.classRoom.fields.branch_efk') }}
                        </th>
                        <td>
                            {{ $classRoom->branch_efk }}
                        </td>
                    </tr> -->
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.class-rooms.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection