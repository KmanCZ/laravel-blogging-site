<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Post
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Create post
                    <div class="">
                        <form action="/posts" method="POST">
                            @csrf
                            <div class="flex flex-col">
                                <label for="heading">Heading</label>
                                <input value="{{old("heading")}}" name="heading" id="heading" type="text" class="rounded-lg">
                                @error("heading")
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="flex flex-col mt-3">
                                <label for="content">Post</label>
                                <textarea name="content" id="content" cols="100" rows="10" class="rounded-lg resize-none">{{old("content")}}</textarea>
                                @error("content")
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                            <button class="mt-3 border-solid border-2 border-black rounded-full p-1 hover:bg-slate-400" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
