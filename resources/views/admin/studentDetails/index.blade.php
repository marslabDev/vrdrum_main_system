@extends('layouts.admin')
@section('content')
@can('student_detail_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.student-details.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.studentDetail.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'StudentDetail', 'route' => 'admin.student-details.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.studentDetail.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-StudentDetail">
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
                <tr>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\StudentDetail::GENDER_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($addresses as $key => $item)
                                <option value="{{ $item->address_1 }}">{{ $item->address_1 }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($addresses as $key => $item)
                                <option value="{{ $item->address_1 }}">{{ $item->address_1 }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->email }}">{{ $item->email }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($student_parents as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('student_detail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.student-details.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.student-details.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'full_name', name: 'full_name' },
{ data: 'nric_no', name: 'nric_no' },
{ data: 'gender', name: 'gender' },
{ data: 'is_handicapped', name: 'is_handicapped' },
{ data: 'home_address_address_1', name: 'home_address.address_1' },
{ data: 'home_address.address_2', name: 'home_address.address_2' },
{ data: 'home_address.city', name: 'home_address.city' },
{ data: 'home_address.state', name: 'home_address.state' },
{ data: 'home_address.postcode', name: 'home_address.postcode' },
{ data: 'home_address.phone', name: 'home_address.phone' },
{ data: 'mail_address_address_1', name: 'mail_address.address_1' },
{ data: 'mail_address.address_2', name: 'mail_address.address_2' },
{ data: 'mail_address.city', name: 'mail_address.city' },
{ data: 'mail_address.state', name: 'mail_address.state' },
{ data: 'mail_address.postcode', name: 'mail_address.postcode' },
{ data: 'mail_address.phone', name: 'mail_address.phone' },
{ data: 'user_email', name: 'user.email' },
{ data: 'user.name', name: 'user.name' },
{ data: 'guardian', name: 'guardians.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-StudentDetail').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection