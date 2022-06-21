@props(["post"])

<div class="flex justify-center items-center mx-2">
    @auth
    @unless($post->likes()->get()->contains(auth()->user()))
    <form action="{{route("posts.like", ['post'=>$post->slug, "user" => $post->user])}}" method="POST">
        @csrf
        @method("PUT")
        <button><i class="fa-regular fa-heart text-red-600 text-2xl"></i></button>
    </form>
    @else
    <form action="{{route("posts.unlike", ['post'=>$post->slug, "user" => $post->user])}}" method="POST">
        @csrf
        @method("DELETE")
        <button><i class="fa-solid fa-heart text-red-600 text-2xl"></i></button>
    </form>
    @endunless
    @else
    <i class="fa-regular fa-heart text-red-600 text-2xl"></i>
    @endauth
    <p class="text-2xl mx-1 select-none">{{$post->likes()->get()->count()}}</p>
</div>
