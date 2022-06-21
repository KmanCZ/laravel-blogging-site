<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <x-slot name="pName">
                Followig posts
            </x-slot>
            Followig posts
        </h2>
    </x-slot>

    <div class="py-12">
        @if($posts->count() == 0)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm mb-2 sm:rounded-lg">
                <div class="flex justify-between p-6 bg-white border-b border-gray-200">
                    People you are following didn't posted anything yet.
                </div>
            </div>
        </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($posts as $post)
            <x-post-card :post="$post" />
            @endforeach
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{$posts->links()}}
        </div>
    </div>
</x-app-layout>
