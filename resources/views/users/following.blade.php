<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <x-slot name="pName">
                {{$user->name}}'s followings
            </x-slot>
            {{$user->name}}'s followings
        </h2>
    </x-slot>

    <div class="py-12">
        @if ($followings->count() == 0)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm mb-2 sm:rounded-lg">
                <div class="flex justify-between p-6 bg-white border-b border-gray-200">
                    {{$user->name}} isn't following anyone yet.
                </div>
            </div>
        </div>
        @endif

        @foreach ($followings as $following)
        <x-profile-card :profile="$following" />
        @endforeach

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{$followings->links()}}
        </div>
    </div>
</x-app-layout>
