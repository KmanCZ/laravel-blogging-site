@props(["post"])

<a href="/posts/{{$post->id}}">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
        <div class="p-6 bg-white border-b border-gray-200">
            <h3 class="font-bold text-2xl px-6">{{$post->heading}}</h3>
        </div>
    </div>
</a>
