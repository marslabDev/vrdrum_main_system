@can('student_detail_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.student-details.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.studentDetail.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.studentDetail.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userStudentDetails">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.studentDetail.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentDetail.fields.full_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentDetail.fields.nric_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentDetail.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentDetail.fields.is_handicapped') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentDetail.fields.home_address') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.address_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.state') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.postcode') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentDetail.fields.mail_address') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.address_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.state') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.postcode') }}
                        </th>
                        <th>
                            {{ trans('cruds.address.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentDetail.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentDetail.fields.guardian') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($studentDetails as $key => $studentDetail)
                        <tr data-entry-id="{{ $studentDetail->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $studentDetail->id ?? '' }}
                            </td>
                            <td>
                                {{ $studentDetail->full_name ?? '' }}
                            </td>
                            <td>
                                {{ $studentDetail->nric_no ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\StudentDetail::GENDER_SELECT[$studentDetail->gender] ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $studentDetail->is_handicapped ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $studentDetail->is_handicapped ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{ $studentDetail->home_address->address_1 ?? '' }}
                            </td>
                            <td>
                                {{ $studentDetail->home_address->address_2 ?? '' }}
                            </td>
                            <td>
                                {{ $studentDetail->home_address->city ?? '' }}
                            </td>
                            <td>
                                {{ $studentDetail->home_address->state ?? '' }}
                            </td>
                            <td>
                                {{ $studentDetail->home_address->postcode ?? '' }}
                            </td>
                            <td>
                                {{ $studentDetail->home_address->phone ?? '' }}
                            </td>
                            <td>
                                {{ $studentDetail->mail_address->address_1 ?? '' }}
                            </td>
                            <td>
                                {{ $studentDetail->mail_address->address_2 ?? '' }}
                            </td>
                            <td>
                                {{ $studentDetail->mail_address->city ?? '' }}
                            </td>
                            <td>
                                {{ $studentDetail->mail_address->state ?? '' }}
                            </td>
                            <td>
                                {{ $studentDetail->mail_address->postcode ?? '' }}
                            </td>
                            <td>
                                {{ $studentDetail->mail_address->phone ?? '' }}
                            </td>
                            <td>
                                {{ $studentDetail->user->email ?? '' }}
                            </td>
                            <td>
                                {{ $studentDetail->user->name ?? '' }}
                            </td>
                            <td>
                                @foreach($studentDetail->guardians as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('student_detail_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.student-details.show', $studentDetail->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('student_detail_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.student-details.edit', $studentDetail->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('student_detail_delete')
                                    <form action="{{ route('admin.student-details.destroy', $studentDetail->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('student_detail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.student-details.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-userStudentDetails:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection