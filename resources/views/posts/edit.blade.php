<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <x-slot name="pName">
                Edit Post
            </x-slot>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Edit post
                    <div>
                        <form action="/posts/{{$post->slug}}" method="POST" id="editPostForm">
                            @csrf
                            @method("PUT")
                            <div class="flex flex-col">
                                <label for="heading">Heading</label>
                                <input disabled value="{{$post->heading}}" name="heading" id="heading" type="text" class="rounded-lg bg-gray-300">
                            </div>
                            <div class="flex flex-col mt-3">
                                <label for="editor">Post</label>
                                <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                                <input type="hidden" id="oldContent" value="{{ $post->content }}">
                                <input type="hidden" name="content" id="content">
                                <div>
                                    @error("content")
                                    <p class="text-red-600">{{$message}}</p>
                                    @enderror
                                </div>
                                <button class="mt-3 border-solid border-2 border-black rounded-full p-1 hover:bg-slate-400" type="submit">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
