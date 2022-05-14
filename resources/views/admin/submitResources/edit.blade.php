@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.submitResource.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.submit-resources.update", [$submitResource->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.submitResource.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $submitResource->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.submitResource.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="answer_text">{{ trans('cruds.submitResource.fields.answer_text') }}</label>
                <input class="form-control {{ $errors->has('answer_text') ? 'is-invalid' : '' }}" type="text" name="answer_text" id="answer_text" value="{{ old('answer_text', $submitResource->answer_text) }}">
                @if($errors->has('answer_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('answer_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.submitResource.fields.answer_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attachment">{{ trans('cruds.submitResource.fields.attachment') }}</label>
                <div class="needsclick dropzone {{ $errors->has('attachment') ? 'is-invalid' : '' }}" id="attachment-dropzone">
                </div>
                @if($errors->has('attachment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attachment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.submitResource.fields.attachment_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="student_work_id">{{ trans('cruds.submitResource.fields.student_work') }}</label>
                <select class="form-control select2 {{ $errors->has('student_work') ? 'is-invalid' : '' }}" name="student_work_id" id="student_work_id">
                    @foreach($student_works as $id => $entry)
                        <option value="{{ $id }}" {{ (old('student_work_id') ? old('student_work_id') : $submitResource->student_work->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('student_work'))
                    <div class="invalid-feedback">
                        {{ $errors->first('student_work') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.submitResource.fields.student_work_helper') }}</span>
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
    url: '{{ route('admin.submit-resources.storeMedia') }}',
    maxFilesize: 100, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 100
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
@if(isset($submitResource) && $submitResource->attachment)
      var file = {!! json_encode($submitResource->attachment) !!}
          this.options.addedfile.call(this, file)
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