@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.studentDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $studentDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.full_name') }}
                        </th>
                        <td>
                            {{ $studentDetail->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.is_handicapped') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $studentDetail->is_handicapped ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\StudentDetail::GENDER_SELECT[$studentDetail->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.country') }}
                        </th>
                        <td>
                            {{ $studentDetail->country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.home_address') }}
                        </th>
                        <td>
                            {{ $studentDetail->home_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.mail_address') }}
                        </th>
                        <td>
                            {{ $studentDetail->mail_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.state') }}
                        </th>
                        <td>
                            {{ $studentDetail->state }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.city') }}
                        </th>
                        <td>
                            {{ $studentDetail->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.postcode') }}
                        </th>
                        <td>
                            {{ $studentDetail->postcode }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.phone') }}
                        </th>
                        <td>
                            {{ $studentDetail->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.nric_no') }}
                        </th>
                        <td>
                            {{ $studentDetail->nric_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.user') }}
                        </th>
                        <td>
                            {{ $studentDetail->user->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentDetail.fields.guardian') }}
                        </th>
                        <td>
                            @foreach($studentDetail->guardians as $key => $guardian)
                                <span class="label label-info">{{ $guardian->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection