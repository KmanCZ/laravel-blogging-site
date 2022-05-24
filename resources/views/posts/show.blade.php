<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$post->heading}}

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 markdown">
                    {!! \Illuminate\Support\Str::markdown($post->content) !!}
                </div>
                <div class="flex justify-end mr-5 my-2">
                    <a href="/posts/{{$post->id}}/edit" class="inline-block rounded-lg bg-blue-500 text-white hover:bg-blue-700 py-1 px-3">Edit</a>
                    <form action="/posts/{{$post->id}}" method="POST" class="ml-2">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="inline-block rounded-lg bg-red-500 text-white hover:bg-red-700 py-1 px-3">Delete</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
