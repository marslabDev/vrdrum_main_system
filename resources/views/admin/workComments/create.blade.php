@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.workComment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.work-comments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="content">{{ trans('cruds.workComment.fields.content') }}</label>
                <input class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" type="text" name="content" id="content" value="{{ old('content', '') }}" required>
                @if($errors->has('content'))
                    <div class="invalid-feedback">
                        {{ $errors->first('content') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workComment.fields.content_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attachment">{{ trans('cruds.workComment.fields.attachment') }}</label>
                <div class="needsclick dropzone {{ $errors->has('attachment') ? 'is-invalid' : '' }}" id="attachment-dropzone">
                </div>
                @if($errors->has('attachment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attachment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workComment.fields.attachment_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="student_work_id">{{ trans('cruds.workComment.fields.student_work') }}</label>
                <select class="form-control select2 {{ $errors->has('student_work') ? 'is-invalid' : '' }}" name="student_work_id" id="student_work_id">
                    @foreach($student_works as $id => $entry)
                        <option value="{{ $id }}" {{ old('student_work_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('student_work'))
                    <div class="invalid-feedback">
                        {{ $errors->first('student_work') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workComment.fields.student_work_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sender_efk">{{ trans('cruds.workComment.fields.sender_efk') }}</label>
                <input class="form-control {{ $errors->has('sender_efk') ? 'is-invalid' : '' }}" type="number" name="sender_efk" id="sender_efk" value="{{ old('sender_efk', '') }}" step="1" required>
                @if($errors->has('sender_efk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sender_efk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.workComment.fields.sender_efk_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.attachmentDropzone = {
    url: '{{ route('admin.work-comments.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="attachment"]').remove()
      $('form').append('<input type="hidden" name="attachment" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="attachment"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($workComment) && $workComment->attachment)
      var file = {!! json_encode($workComment->attachment) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="attachment" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection