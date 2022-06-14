<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <x-slot name="pName">
                {{$user->name}}
            </x-slot>
            {{$user->name}}
        </h2>
        <p><i class="fa-solid fa-users"></i> {{$user->followers()->get()->count()}}</p>
        <x-follow-button :user="$user" :follower="auth()->user()" />
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm mb-2 sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-xl">{{$user->name}}'s posts:</h1>
                </div>
            </div>
            @foreach ($posts as $post)
            <x-profile-post-card :post="$post" />
            @endforeach
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{$posts->links()}}
        </div>
    </div>
</x-app-layout>
