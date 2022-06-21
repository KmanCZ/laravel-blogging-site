@props(["post"])


<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
    <div class="flex justify-between p-6 bg-white border-b border-gray-200">
        <div class="flex flex-col">
            <a href="{{route('posts.show', ['post'=>$post->slug, "user" => $post->user])}}">
                <h3 class="inline-block font-bold text-2xl px-6">{{$post->heading}}</h3>
            </a>
            <x-tags class="px-6 inline-block" :tags="$post->tags" />
            <div class="flex items-center px-6 mt-1">
                <i class="fa-solid fa-heart text-red-600 text-xl"></i>
                <p class="text-xl mx-1 select-none">{{$post->likes()->get()->count()}}</p>
            </div>
        </div>
        @auth
        @if ($post->user->id == auth()->user()->id)
        <div class="flex items-center">
            <div><a href="{{route('posts.edit', ['post'=>$post->slug, "user" => $post->user])}}" class="inline-block rounded-lg bg-blue-500 text-white hover:bg-blue-700 py-1 px-3">Edit</a></div>
            <form action="{{route('posts.destroy', ['post'=>$post->slug])}}" method="POST" class="ml-2">
                @csrf
                @method("DELETE")
                <button type="submit" class="inline-block rounded-lg bg-red-500 text-white hover:bg-red-700 py-1 px-3">Delete</button>
        </div>
        @endif
        @endauth
    </div>
</div>
