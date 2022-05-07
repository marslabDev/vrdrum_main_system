@extends('layouts.admin')
@section('content')
@can('lesson_time_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.lesson-times.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.lessonTime.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.lessonTime.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-LessonTime">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.lessonTime.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTime.fields.lesson_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTime.fields.date_from') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTime.fields.date_to') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTime.fields.attended_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTime.fields.leaved_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTime.fields.class_room') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTime.fields.lesson') }}
                        </th>
                        <th>
                            {{ trans('cruds.lessonTime.fields.student') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lessonTimes as $key => $lessonTime)
                        <tr data-entry-id="{{ $lessonTime->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $lessonTime->id ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTime->lesson_code ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTime->date_from ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTime->date_to ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTime->attended_at ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTime->leaved_at ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTime->class_room->room_title ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTime->lesson->name ?? '' }}
                            </td>
                            <td>
                                {{ $lessonTime->student->name ?? '' }}
                            </td>
                            <td>
                                @can('lesson_time_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.lesson-times.show', $lessonTime->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('lesson_time_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.lesson-times.edit', $lessonTime->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('lesson_time_delete')
                                    <form action="{{ route('admin.lesson-times.destroy', $lessonTime->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('lesson_time_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.lesson-times.massDestroy') }}",
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
  let table = $('.datatable-LessonTime:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection