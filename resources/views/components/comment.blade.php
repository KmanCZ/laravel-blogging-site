@props(["comment"])

@if(auth()->check() && $comment->user == auth()->user())
<div x-data="{ open: true }">
    <div x-show="open" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5 mx-10">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="font-bold text-lg"><img class="w-7 h-7 mr-1 rounded-full inline-block" src="{{Storage::url($comment->user->profile_picture)}}" alt="profile picture">{{$comment->user->name}}:</div>
            <div>{{$comment->content}}</div>
        </div>
        <div class="flex justify-end mr-5 my-2">
            <button x-on:click="open = !open" class="inline-block rounded-lg bg-blue-500 text-white hover:bg-blue-700 py-1 px-3">Edit</button>
            <form action="{{route("commnets.destroy", ["comment" => $comment])}}" method="POST" class="ml-2">
                @csrf
                @method("DELETE")
                <button type="submit" class="inline-block rounded-lg bg-red-500 text-white hover:bg-red-700 py-1 px-3">Delete</button>
            </form>
        </div>
    </div>

    <div x-show="!open" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5 mx-10">
        <form method="POST" action="{{route("commnets.update", ["comment" => $comment])}}" class="p-6 bg-white border-b border-gray-200">
            @csrf
            @method("PUT")
            <div class="font-bold text-lg">{{$comment->user->name}}:</div>
            <textarea name="commentEdit" id="commentEdit" class="resize-none w-full h-50 border border-solid rounded-lg" placeholder="Edit Coomment..." required>{{$comment->content}}</textarea>
            <div class="flex justify-end gap-2">
                <button type="submit" class="inline-block rounded-lg border-solid border-2 bg-blue-500 text-white hover:bg-blue-700 py-1 px-3">Edit</button>
                <button type="button" x-on:click="open = !open" class="inline-block rounded-lg bg-yellow-500 text-black hover:bg-yellow-700 py-1 px-3">Back</button>
            </div>
        </form>
    </div>
</div>
@else
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5 mx-10">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="font-bold text-lg">{{$comment->user->name}}:</div>
        <div>{{$comment->content}}</div>
    </div>
</div>
@endif
