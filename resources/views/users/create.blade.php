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

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                Avatar
                            </label>
                            <input type="file" name="avatar" id="avatar" accept="image/*">
                        </div>

                        <input type="submit" value="Guardar"
                            class="bg-green-500 text-white hover:bg-green-700 font-bold py-2 px-4 rounded">
                    </form>
                </div>
            </div>
            <a href="{{ route('posts.index') }}"
                class="bg-blue-400 text-white hover:bg-blue-600 font-bold py-2 px-4 rounded">Regresar</a>
        </div>

@endsection
