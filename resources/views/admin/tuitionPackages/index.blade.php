@extends('layouts.admin')
@section('content')
@can('tuition_package_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tuition-packages.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.tuitionPackage.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.tuitionPackage.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-TuitionPackage">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.tuitionPackage.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.tuitionPackage.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.tuitionPackage.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.tuitionPackage.fields.total_minute') }}
                        </th>
                        <th>
                            {{ trans('cruds.tuitionPackage.fields.lesson_category') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tuitionPackages as $key => $tuitionPackage)
                        <tr data-entry-id="{{ $tuitionPackage->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $tuitionPackage->id ?? '' }}
                            </td>
                            <td>
                                {{ $tuitionPackage->name ?? '' }}
                            </td>
                            <td>
                                {{ $tuitionPackage->price ?? '' }}
                            </td>
                            <td>
                                {{ $tuitionPackage->total_minute ?? '' }}
                            </td>
                            <td>
                                {{ $tuitionPackage->lesson_category->name ?? '' }}
                            </td>
                            <td>
                                @can('tuition_package_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.tuition-packages.show', $tuitionPackage->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('tuition_package_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.tuition-packages.edit', $tuitionPackage->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('tuition_package_delete')
                                    <form action="{{ route('admin.tuition-packages.destroy', $tuitionPackage->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('tuition_package_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tuition-packages.massDestroy') }}",
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
  let table = $('.datatable-TuitionPackage:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection