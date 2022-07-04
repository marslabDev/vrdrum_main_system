@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.postContentSubmit.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.post-content-submits.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.postContentSubmit.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postContentSubmit.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="desc">{{ trans('cruds.postContentSubmit.fields.desc') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('desc') ? 'is-invalid' : '' }}" name="desc" id="desc">{!! old('desc') !!}</textarea>
                @if($errors->has('desc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('desc') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postContentSubmit.fields.desc_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attachment">{{ trans('cruds.postContentSubmit.fields.attachment') }}</label>
                <div class="needsclick dropzone {{ $errors->has('attachment') ? 'is-invalid' : '' }}" id="attachment-dropzone">
                </div>
                @if($errors->has('attachment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attachment') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postContentSubmit.fields.attachment_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mark">{{ trans('cruds.postContentSubmit.fields.mark') }}</label>
                <input class="form-control {{ $errors->has('mark') ? 'is-invalid' : '' }}" type="number" name="mark" id="mark" value="{{ old('mark', '') }}" step="0.01">
                @if($errors->has('mark'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mark') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postContentSubmit.fields.mark_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="objective_answers">{{ trans('cruds.postContentSubmit.fields.objective_answers') }}</label>
                <input class="form-control {{ $errors->has('objective_answers') ? 'is-invalid' : '' }}" type="text" name="objective_answers" id="objective_answers" value="{{ old('objective_answers', '') }}">
                @if($errors->has('objective_answers'))
                    <div class="invalid-feedback">
                        {{ $errors->first('objective_answers') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postContentSubmit.fields.objective_answers_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="post_content_id">{{ trans('cruds.postContentSubmit.fields.post_content') }}</label>
                <select class="form-control select2 {{ $errors->has('post_content') ? 'is-invalid' : '' }}" name="post_content_id" id="post_content_id" required>
                    @foreach($post_contents as $id => $entry)
                        <option value="{{ $id }}" {{ old('post_content_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('post_content'))
                    <div class="invalid-feedback">
                        {{ $errors->first('post_content') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.postContentSubmit.fields.post_content_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.post-content-submits.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $postContentSubmit->id ?? 0 }}');
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
    var uploadedAttachmentMap = {}
Dropzone.options.attachmentDropzone = {
    url: '{{ route('admin.post-content-submits.storeMedia') }}',
    maxFilesize: 1024, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1024
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="attachment[]" value="' + response.name + '">')
      uploadedAttachmentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAttachmentMap[file.name]
      }
      $('form').find('input[name="attachment[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($postContentSubmit) && $postContentSubmit->attachment)
          var files =
            {!! json_encode($postContentSubmit->attachment) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="attachment[]" value="' + file.file_name + '">')
            }
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