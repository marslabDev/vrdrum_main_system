@extends('layouts.admin')
@section('content')
@can('work_resource_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.work-resources.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.workResource.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.workResource.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-WorkResource">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.workResource.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.workResource.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.workResource.fields.question_text') }}
                        </th>
                        <th>
                            {{ trans('cruds.workResource.fields.url') }}
                        </th>
                        <th>
                            {{ trans('cruds.workResource.fields.student_work') }}
                        </th>
                        <th>
                            {{ trans('cruds.studentWork.fields.title') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($workResources as $key => $workResource)
                        <tr data-entry-id="{{ $workResource->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $workResource->id ?? '' }}
                            </td>
                            <td>
                                {{ $workResource->title ?? '' }}
                            </td>
                            <td>
                                {{ $workResource->question_text ?? '' }}
                            </td>
                            <td>
                                {{ $workResource->url ?? '' }}
                            </td>
                            <td>
                                {{ $workResource->student_work->title ?? '' }}
                            </td>
                            <td>
                                {{ $workResource->student_work->title ?? '' }}
                            </td>
                            <td>
                                @can('work_resource_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.work-resources.show', $workResource->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('work_resource_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.work-resources.edit', $workResource->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('work_resource_delete')
                                    <form action="{{ route('admin.work-resources.destroy', $workResource->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('work_resource_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.work-resources.massDestroy') }}",
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
  let table = $('.datatable-WorkResource:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection