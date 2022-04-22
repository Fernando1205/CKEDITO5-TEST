@extends('master')

@section('title','Post - Editar')

@section('content')
        <div class="container mx-auto mt-6">
            <div class="rounded overflow-hidden shadow lg bg-white mb-6">
                <div class="px-6 py-4">
                    <h1>Editar posts</h1>
                    <form action="{{ route('posts.update',$post) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                              Titulo
                            </label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="title" type="text" placeholder="Titulo..." name="title"
                                value="{{ $post->title }}">
                        </div>
                        <textarea name="content" id="editor" cols="30" rows="10">{{ $post->content }}</textarea><br>

                        <input type="submit" value="Actualizar"
                            class="bg-green-500 text-white hover:bg-green-700 font-bold py-2 px-4 rounded">
                    </form>
                </div>
            </div>
            <a href="{{ route('posts.index') }}"
                class="bg-blue-400 text-white hover:bg-blue-600 font-bold py-2 px-4 rounded">Regresar</a>
        </div>

        <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
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

                // Aborts the upload process.
                abort() {
                    if ( this.xhr ) {
                        this.xhr.abort();
                    }
                }

                _initRequest() {
                    const xhr = this.xhr = new XMLHttpRequest();
                    xhr.open( 'POST', "{{ route('image.upload') }}", true );
                    xhr.setRequestHeader( 'X-CSRF-TOKEN', "{{ csrf_token() }}");
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

                    data.append( 'upload', file );

                    this.xhr.send( data );
                }
            }

            function MyCustomUploadAdapterPlugin( editor ) {
                editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                    return new MyUploadAdapter( loader );
                };
            }

            ClassicEditor
                    .create( document.querySelector( '#editor' ),{
                        extraPlugins: [ MyCustomUploadAdapterPlugin ],
                    } )
                    .catch( error => {
                            console.error( error );
                    } );
        </script>
@endsection
