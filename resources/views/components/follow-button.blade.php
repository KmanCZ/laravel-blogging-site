@props(["user", "follower"])

@unless ($user->id == $follower->id)
@unless ($user->followers()->get()->contains($follower))
<form action="{{route("users.follow", ["user" => $user])}}" method="POST">
    @csrf
    @method("PUT")
    <button class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded-lg" type="submit">Follow</button>
</form>
@else
<form action="{{route("users.unfollow", ["user" => $user])}}" method="POST">
    @csrf
    @method("DELETE")
    <button class="bg-gray-500 hover:bg-red-600 text-white py-1 px-2 rounded-lg" type="submit">Unfollow</button>
</form>
@endunless
@endunless
