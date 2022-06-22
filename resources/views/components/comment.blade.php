@props(["comment"])

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5 mx-10">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="font-bold text-lg">{{$comment->user->name}}:</div>
        <div>{{$comment->content}}</div>
    </div>
    <div class="flex justify-end mr-5 my-2">
        <a href="" class="inline-block rounded-lg bg-blue-500 text-white hover:bg-blue-700 py-1 px-3">Edit</a>
        <form action="" method="POST" class="ml-2">
            @csrf
            @method("DELETE")
            <button type="submit" class="inline-block rounded-lg bg-red-500 text-white hover:bg-red-700 py-1 px-3">Delete</button>
        </form>
    </div>
</div>
