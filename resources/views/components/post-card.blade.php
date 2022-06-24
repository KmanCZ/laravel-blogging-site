@props(["post"])

<a href="{{route('posts.show', ['post'=>$post->slug, "user" => $post->user])}}">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
        <div class="p-6 bg-white border-b border-gray-200">
            <h3 class="font-bold text-2xl px-6">{{$post->heading}}</h3>
            <p class="px-6">by<a class="hover:underline" href="{{route("users.show", ["user" => $post->user])}}"><img class="w-7 h-auto mr-1 ml-2 rounded-full inline-block" src="{{asset("storage/". $post->user->profile_picture)}}" alt="profile picture">{{$post->user->name}}</a></p>
            <x-tags class="px-6" :tags="$post->tags" />
            <div class="flex items-center px-6 mt-1">
                <i class="fa-solid fa-heart text-red-600 text-xl"></i>
                <p class="text-xl mx-1 select-none">{{$post->likes()->get()->count()}}</p>
                <i class="fa-regular fa-comment text-xl ml-1"></i>
                <p class="text-xl mx-1 select-none">{{$post->comments()->get()->count()}}</p>
            </div>
        </div>
    </div>
</a>
