@extends('layouts.admin')
@section('content')
@can('submit_resource_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.submit-resources.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.submitResource.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.submitResource.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SubmitResource">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.submitResource.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.submitResource.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.submitResource.fields.answer_text') }}
                        </th>
                        <th>
                            {{ trans('cruds.submitResource.fields.url') }}
                        </th>
                        <th>
                            {{ trans('cruds.submitResource.fields.student_work') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submitResources as $key => $submitResource)
                        <tr data-entry-id="{{ $submitResource->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $submitResource->id ?? '' }}
                            </td>
                            <td>
                                {{ $submitResource->title ?? '' }}
                            </td>
                            <td>
                                {{ $submitResource->answer_text ?? '' }}
                            </td>
                            <td>
                                {{ $submitResource->url ?? '' }}
                            </td>
                            <td>
                                {{ $submitResource->student_work->title ?? '' }}
                            </td>
                            <td>
                                @can('submit_resource_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.submit-resources.show', $submitResource->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('submit_resource_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.submit-resources.edit', $submitResource->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('submit_resource_delete')
                                    <form action="{{ route('admin.submit-resources.destroy', $submitResource->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('submit_resource_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.submit-resources.massDestroy') }}",
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
  let table = $('.datatable-SubmitResource:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection