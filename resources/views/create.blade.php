@extends('master')

@section('title','Post - Crear')

@section('content')
        <div class="container mx-auto mt-6">
            <div class="rounded overflow-hidden shadow lg bg-white mb-6">
                <div class="px-6 py-4">
                    <h1>Crear posts</h1>
                    @livewire('post-create')
                </div>
            </div>
            <a href="{{ route('posts.index') }}"
                class="bg-blue-400 text-white hover:bg-blue-600 font-bold py-2 px-4 rounded">Regresar</a>
        </div>

@endsection
