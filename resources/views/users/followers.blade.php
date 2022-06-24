<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <x-slot name="pName">
                {{$user->name}}'s followers
            </x-slot>
            {{$user->name}}'s followers
        </h2>
    </x-slot>

    <div class="py-12">
        @if ($followers->count() == 0)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm mb-2 sm:rounded-lg">
                <div class="flex justify-between p-6 bg-white border-b border-gray-200">
                    No one is following {{$user->name}} yet.
                </div>
            </div>
        </div>
        @endif

        @foreach ($followers as $follower)
        <x-profile-card :profile="$follower" />
        @endforeach

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{$followers->links()}}
        </div>
    </div>
</x-app-layout>
