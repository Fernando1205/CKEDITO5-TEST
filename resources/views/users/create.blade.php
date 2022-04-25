@extends('master')

@section('title','Post - Crear')

@section('content')
<div class="container mx-auto mt-6">
    <div class="rounded overflow-hidden shadow lg bg-white mb-6">
        <div class="px-6 py-4">
            <h1>Crear usuario</h1>
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Nombre
                    </label>
                    <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="name" type="text" placeholder="Nombre..." name="name"
                    >
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="email" type="email" placeholder="Email..." name="email"
                    >
                </div>

                <div class="mb-4 dropzone-cus" id="myDropzone">
                    <div class="icon dz-default dz-message">
                        <button class="dz-button" type="button">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                        </button>
                    </div>
                    <div class="text dz-default dz-message">
                        <button class="dz-button" type="button">
                            Hacer click o arrastrar imagen
                        </button>
                    </div>
                    <button class="dz-remove" data-dz-remove type="button" id="deleteImg">X</button>
                </div>



                <input type="submit" value="Guardar" id="submit"
                    class="bg-green-500 text-white hover:bg-green-700 font-bold py-2 px-4 rounded">
            </form>
        </div>
    </div>
    <a href="{{ route('posts.index') }}"
        class="bg-blue-400 text-white hover:bg-blue-600 font-bold py-2 px-4 rounded">Regresar</a>
</div>


@endsection
@push('script')
<script>
    const defaultText = document.querySelectorAll('.dz-default');
    let myDropzone = new Dropzone("div#myDropzone", {
        // The configuration we've talked about above
        url: "/",
        autoProcessQueue: false,
        uploadMultiple: false,
        addRemoveLinks: true,
        createImageThumbnails: true,
        maxFiles: 1,
        thumbnailMethod: "contain",
        thumbnailWidth:716,
        thumbnailHeight:256,


        // The setting up of the dropzone
        init: function() {
            var myDropzone = this;

            // First change the button to actually tell Dropzone to process the queue.
            document.getElementById("submit").addEventListener("click", function(e) {
                // Make sure that the form isn't actually being sent.
                e.preventDefault();
                e.stopPropagation();
                myDropzone.processQueue();
            });

            // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
            // of the sending event because uploadMultiple is set to true.
            this.on("sendingmultiple", function() {
            // Gets triggered when the form is actually being sent.
            // Hide the success button or the complete form.
            console.log('enviando');
            });
            this.on("successmultiple", function(files, response) {
            // Gets triggered when the files have successfully been sent.
            // Redirect user or notify of success.
            });
            this.on("errormultiple", function(files, response) {
            // Gets triggered when there was an error sending the files.
            // Maybe show form again, and notify user of error
            });

            this.on("addedfile", file => {
                // Si existe una imagen la remueve y la cambia por la nueva
                if(this.files.length > 1){
                    this.removeFile(this.files[0]);
                }

                document.querySelector('.dz-remove').style.display = 'block';

                defaultText.forEach(element => {
                    element.style.display = 'none';
                });
            })

            this.on('removedfile', file => {

                document.querySelector('.dz-remove').style.display = 'none';
                defaultText.forEach(element => {
                    element.style.display = 'block';
                });
            })
        }

        });

    document.querySelector('#deleteImg').addEventListener('click', () => {
        myDropzone.removeAllFiles(true);
    })
</script>
@endpush
@push('css')
    <style>
        .dropzone-cus {
            background-color: #eeeeee;

            position: relative;

            display: flex;
            flex-direction: column;

            justify-content: center;
            align-items: center;
            height: 260px;
            border: 2px dotted gray;
            border-radius: 20px;
        }
        .icon {
            display: block;
            font-size: 3rem;
            color:gray;
        }
        .text {
            color:gray;
            font-size: 1.5em;
        }
        .dz-success-mark,
        .dz-error-mark,
        .dz-details
        {
            display: none;
        }
        .dz-preview.dz-image-preview {
            width: 100%;
            height: 100%;
        }
        .dz-image {
            width: 100%;
            height: 100%;
        }
        .dz-image img {
            margin: auto;
            margin-bottom: 10px;
            width: 100%;
            height: 100%;
            border-radius: 20px;
        }
        .dz-remove {

            display: none;
            background-color: #afafaf78;
            border-radius: 10px;
            padding: 10px;
            width: 30px;

            text-align: center;
            color: white;

            position: absolute;
            top: 0;
            right: 0;
            margin-right: auto;

            transition: 0.5s all;
        }
        .dz-remove:hover {
            background-color: red;
            width: 35px;
        }
    </style>
@endpush
