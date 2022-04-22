@extends('master')

@section('title','Post')

@section('content')
<div class="container mx-auto mt-6">
    <div class="rounded overflow-hidden shadow lg bg-white">
        <div class="px-6 py-4">
            <div class="grid grid-cols-6 gap-4">
                <a href="{{ route('posts.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear post</a>
            </div>
            <table class="table border-collapse border border-slate-400 w-full my-5">
                <thead>
                    <tr>
                        <td class="py-2 text-center border border-slate-300">ID</td>
                        <td class="py-2 text-center border border-slate-300">TITULO</td>
                        <td class="py-2 text-center border border-slate-300"></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td class="py-2 text-center border border-slate-300">{{ $post->id }}</td>
                            <td class="py-2 text-center border border-slate-300">
                                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                            </td>
                            <td class="py-2 text-center border border-slate-300">
                                <a href="{{ route('posts.edit', $post) }}"
                                    class="bg-teal-300 hover:bg-teal-500 text-white py-2 px-4 rounded"><i class="fa-solid fa-pen"></i></a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
