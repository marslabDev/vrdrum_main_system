@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.postComment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.post-comments.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="content">{{ trans('cruds.postComment.fields.content') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" id="content">{!! old('content') !!}</textarea>
                @if($errors->has('content'))
                    <div class="invalid-feedback">
                        {{ $errors->first('content') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postComment.fields.content_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attachment">{{ trans('cruds.postComment.fields.attachment') }}</label>
                <div class="needsclick dropzone {{ $errors->has('attachment') ? 'is-invalid' : '' }}" id="attachment-dropzone">
                </div>
                @if($errors->has('attachment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attachment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postComment.fields.attachment_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="lesson_time_post_id">{{ trans('cruds.postComment.fields.lesson_time_post') }}</label>
                <select class="form-control select2 {{ $errors->has('lesson_time_post') ? 'is-invalid' : '' }}" name="lesson_time_post_id" id="lesson_time_post_id" required>
                    @foreach($lesson_time_posts as $id => $entry)
                        <option value="{{ $id }}" {{ old('lesson_time_post_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lesson_time_post'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lesson_time_post') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postComment.fields.lesson_time_post_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sender_efk">{{ trans('cruds.postComment.fields.sender_efk') }}</label>
                <input class="form-control {{ $errors->has('sender_efk') ? 'is-invalid' : '' }}" type="number" name="sender_efk" id="sender_efk" value="{{ old('sender_efk', '') }}" step="1">
                @if($errors->has('sender_efk'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sender_efk') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postComment.fields.sender_efk_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.post-comments.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $postComment->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    Dropzone.options.attachmentDropzone = {
    url: '{{ route('admin.post-comments.storeMedia') }}',
    maxFilesize: 1024, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1024
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
@if(isset($postComment) && $postComment->attachment)
      var file = {!! json_encode($postComment->attachment) !!}
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