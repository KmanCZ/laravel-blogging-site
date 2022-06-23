<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <x-slot name="pName">
                {{$post->heading}}
            </x-slot>
            {{$post->heading}}
        </h2>
        <p>
            by <a class="hover:underline" href="{{route("users.show", ["user" => $post->user])}}">{{$post->user->name}}</a>
        </p>
        <x-tags :tags="$post->tags" />
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 markdown">
                    {!! \Illuminate\Support\Str::markdown($post->content) !!}
                </div>
                <div class="flex justify-end mr-5 my-2">
                    @auth
                    @if ($post->user->id == auth()->user()->id)
                    <a href="{{route('posts.edit', ['post'=>$post->slug, "user" => $post->user])}}" class="inline-block rounded-lg bg-blue-500 text-white hover:bg-blue-700 py-1 px-3">Edit</a>
                    <form action="{{route('posts.destroy', ['post'=>$post->slug])}}" method="POST" class="ml-2">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="inline-block rounded-lg bg-red-500 text-white hover:bg-red-700 py-1 px-3">Delete</button>
                    </form>
                    @endif
                    @endauth
                    <x-like-button :post="$post" />
                    <div class="flex justify-center items-center mx-2">
                        <i class="fa-regular fa-comment text-2xl"></i>
                        <p class="text-2xl mx-1 select-none">{{$post->comments()->get()->count()}}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5 mx-10">
                <form method="POST" action="{{route("comments.create", ["post" => $post, "user" => $post->user])}}" class="p-6 bg-white border-b border-gray-200">
                    @csrf
                    <textarea name="comment" id="content" class="resize-none w-full h-50 border border-solid rounded-lg" placeholder="Comment..."></textarea>
                    @error("comment")
                    <p class="text-red-600">{{$message}}</p>
                    @enderror
                    <div class="flex justify-end">
                        <button type="submit" class="inline-block rounded-lg border-solid border-2 border-black hover:bg-slate-400 py-1 px-3">Submit</button>
                    </div>
                </form>
            </div>
            @foreach ($post->comments()->latest()->get() as $comment)
            <x-comment :comment="$comment" />
            @endforeach
</x-app-layout>
