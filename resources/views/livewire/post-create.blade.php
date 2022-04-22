<div>
    <form wire:submit.prevent='save'>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
              Titulo
            </label>
            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="title" type="text" placeholder="Titulo..." name="title" wire:model="title">
        </div>

        <div wire:ignore
            x-data="{
                content: @entangle('content')
            }"
            x-init="
                ClassicEditor
                .create( $refs.editor,{
                    extraPlugins: [ MyCustomUploadAdapterPlugin ],
                } )
                .then(
                    editor => {
                        editor.model.document.on('change:data', () => {
                            content = editor.getData();
                        });
                    }
                )
                .catch( error => {
                        console.error( error );
                } );
            ">
            <div x-ref="editor"></div>
        </div>

        <input type="submit" value="Guardar"
            class="bg-green-500 text-white hover:bg-green-700 font-bold py-2 px-4 rounded">
    </form>
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

                @this.addImage(response.path)

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
</script>
