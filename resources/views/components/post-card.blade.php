@props(["post"])

<a href="{{route('posts.show', ['post'=>$post->slug, "user" => $post->user])}}">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
        <div class="p-6 bg-white border-b border-gray-200">
            <h3 class="font-bold text-2xl px-6">{{$post->heading}}</h3>
            <p class="px-6">by <a class="hover:underline" href="{{route("users.show", ["user" => $post->user])}}">{{$post->user->name}}</a></p>
            <x-tags class="px-6" :tags="$post->tags" />
        </div>
    </div>
</a>
