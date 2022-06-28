@props(["profile"])

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm mb-2 sm:rounded-lg">
        <div class="flex justify-between items-center p-6 bg-white border-b border-gray-200">
            <a class="py-1 text-lg" href="{{route("users.show", ["user" => $profile])}}"><img class="w-10 h-10 mr-2 rounded-full inline-block" src="{{asset("storage/". $profile->profile_picture)}}" alt="profile picture">{{$profile->name}}</a>
            <x-follow-button :user="$profile" :follower="auth()->user()" />
        </div>
    </div>
</div>
