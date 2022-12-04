@extends('admin.layouts.app')
@section('content')
@include('admin.layouts.error')

<form method="POST" action="{{route('post.store')}}" enctype="multipart/form-data">
    @csrf
    <div style="font-size: 30px" class="col-3 mb-1"><a href="{{route('post.index')}}?type={{$type}}"><i
                class="bi bi-chevron-left"></i></a></div>
    <div class="row my-2">

        <h2 class="col col-6" style="text-transform: capitalize">{{$type}}</h2>
    </div>
    <div class="card border border-1">
        <div class="card-body row">
            <div class="mb-2 px-4">
                <label class="form-label" style="font-size:22px;">Title</label>
                <input type="text" class="form-control" name="title" value="{{old('title')}}" required>
            </div>
            <div class="col-md-6">
                <input type="file" name="file" onchange="preview()">
                <img id="frame" src="" style="max-height:300px; max-width: 100%;" />
            </div>
            <div class="col-md-6">
                <div class="mb-2">
                    <label class="form-label" style="font-size:22px;">SubTitle</label>
                    <input type="text" class="form-control" name="subtitle" value="{{old('subtitle')}}"
                        >
                </div>
                <div class="mb-2">
                    <label class="form-label" style="font-size:22px;">Link</label>
                    <input type="text" class="form-control" name="link" value="{{old('link')}}"
                          >
                </div>
                <input type="text"  value="{{$type}}" name="type" hidden>
                <div class="mb-2">
                    <label class="form-label" style="font-size:22px;"> Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{old('slug')}}">
                </div>
            </div>
        </div>
    </div>
    <label class="form-label" style="font-size:22px;">Content</label>
    <textarea id="editor" name="body">  {{old('body')}}</textarea>
    <div style="display:flex; align-items:center; justify-content:flex-end; margin-top: 4px">
        <button type="submit" class="btn btn-success py-3 px-5">Create</button>
    </div>
</form>

@endsection
@section('jscontent')
<script>
    class MyUploadAdapter {
        constructor( loader ) {
            this.loader = loader;
        }
        upload() {
            return this.loader.file
                .then( file => new Promise( ( resolve, reject ) => {
                    this._initRequest();
                    this._initListeners( resolve, reject, file );
                    this._sendRequest( file );
                } ) );
        }
        abort() {
            if ( this.xhr ) {
                this.xhr.abort();
            }
        }
        _initRequest() {
            const xhr = this.xhr = new XMLHttpRequest();
            xhr.open( 'POST', '{{route('image.upload')}}', true );
            xhr.setRequestHeader('x-csrf-token','{{csrf_token()}}');
            xhr.responseType = 'json';
        }

        _initListeners( resolve, reject, file ) {
            const xhr = this.xhr;
            const loader = this.loader;
            const genericErrorText = `Couldn't upload file: ${ file.name }.`;
            xhr.addEventListener( 'error', () => reject( genericErrorText ) );
            xhr.addEventListener( 'abort', () => reject() );
            xhr.addEventListener( 'load', () => {
                const response = xhr.response;
                if ( !response || response.error ) {
                    return reject( response && response.error ? response.error.message : genericErrorText );
                }
                resolve( {
                    default: response.url
                } );
            } );
            if ( xhr.upload ) {
                xhr.upload.addEventListener( 'progress', evt => {
                    if ( evt.lengthComputable ) {
                        loader.uploadTotal = evt.total;
                        loader.uploaded = evt.loaded;
                    }
                } );
            }
        }
        _sendRequest( file ) {
            const data = new FormData();
            data.append( 'file', file );
            this.xhr.send( data );
        }
    }
    function SimpleUploadAdapterPlugin( editor ) {
        editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
            return new MyUploadAdapter( loader );
        };
    }
    ClassicEditor
        .create(document.querySelector('#editor'), {
            extraPlugins: [ SimpleUploadAdapterPlugin],
        })
        .catch(error => {
            console.error(error);
        });
    function preview() {
        frame.src = URL.createObjectURL(event.target.files[0]);
    }

</script>
@endsection
