@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.studentParent.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-parents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.studentParent.fields.id') }}
                        </th>
                        <td>
                            {{ $studentParent->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentParent.fields.name') }}
                        </th>
                        <td>
                            {{ $studentParent->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentParent.fields.nationality') }}
                        </th>
                        <td>
                            {{ $studentParent->nationality }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentParent.fields.relationship') }}
                        </th>
                        <td>
                            {{ App\Models\StudentParent::RELATIONSHIP_SELECT[$studentParent->relationship] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentParent.fields.address') }}
                        </th>
                        <td>
                            {{ $studentParent->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.studentParent.fields.nric_no') }}
                        </th>
                        <td>
                            {{ $studentParent->nric_no }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.student-parents.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#guardian_student_details" role="tab" data-toggle="tab">
                {{ trans('cruds.studentDetail.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="guardian_student_details">
            @includeIf('admin.studentParents.relationships.guardianStudentDetails', ['studentDetails' => $studentParent->guardianStudentDetails])
        </div>
    </div>
</div>

@endsection