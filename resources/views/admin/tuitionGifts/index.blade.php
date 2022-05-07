@extends('layouts.admin')
@section('content')
@can('tuition_gift_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tuition-gifts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.tuitionGift.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.tuitionGift.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-TuitionGift">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.tuitionGift.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.tuitionGift.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.tuitionGift.fields.total_minute') }}
                        </th>
                        <th>
                            {{ trans('cruds.tuitionGift.fields.quantity') }}
                        </th>
                        <th>
                            {{ trans('cruds.tuitionGift.fields.tuition_package') }}
                        </th>
                        <th>
                            {{ trans('cruds.tuitionGift.fields.inventory_efk') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tuitionGifts as $key => $tuitionGift)
                        <tr data-entry-id="{{ $tuitionGift->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $tuitionGift->id ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\TuitionGift::TYPE_SELECT[$tuitionGift->type] ?? '' }}
                            </td>
                            <td>
                                {{ $tuitionGift->total_minute ?? '' }}
                            </td>
                            <td>
                                {{ $tuitionGift->quantity ?? '' }}
                            </td>
                            <td>
                                {{ $tuitionGift->tuition_package->name ?? '' }}
                            </td>
                            <td>
                                {{ $tuitionGift->inventory_efk ?? '' }}
                            </td>
                            <td>
                                @can('tuition_gift_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.tuition-gifts.show', $tuitionGift->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('tuition_gift_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.tuition-gifts.edit', $tuitionGift->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('tuition_gift_delete')
                                    <form action="{{ route('admin.tuition-gifts.destroy', $tuitionGift->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('tuition_gift_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tuition-gifts.massDestroy') }}",
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
  let table = $('.datatable-TuitionGift:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection