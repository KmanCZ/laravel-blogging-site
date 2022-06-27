<x-app-layout>
    {{auth()->user()->token}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <x-slot name="pName">
                Create Post
            </x-slot>
            Create Post
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Create post
                    <div>
                        <form action="{{route('posts.store')}}" method="POST" id="createPostForm">
                            @csrf
                            <div class="flex flex-col">
                                <label for="heading">Heading</label>
                                <input value="{{old("heading")}}" name="heading" id="heading" type="text" class="rounded-lg">
                                @error("heading")
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="flex flex-col mt-3">
                                <label for="editor">Post</label>
                                <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{old("content")}}</div>
                                <input type="hidden" name="content" id="content">
                                <div>
                                    @error("content")
                                    <p class="text-red-600">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-col mt-3">
                                <label for="images">Images</label>
                                <input onchange="getFile(this)" name="images" id="images" type="file" class="rounded-lg border border-solid border-black p-1">

                                <p class="text-red-600"></p>

                                <ul class="border border-solid border-black bg-zinc-100 rounded-lg p-2 mt-3">
                                    <li>
                                        ![Image description](https://static.remove.bg/remove-bg-web/19c2a5c2699621496a98aec1b8fd0618590c36e2/assets/start-1abfb4fe2980eabfbbaaa4365a0692539f7cd2725f324f904565a9a744f8e214.jpg)
                                    </li>
                                    <li>
                                        ![Image description](https://static.remove.bg/remove-bg-web/19c2a5c2699621496a98aec1b8fd0618590c36e2/assets/start-1abfb4fe2980eabfbbaaa4365a0692539f7cd2725f324f904565a9a744f8e214.jpg)
                                    </li>
                                </ul>

                            </div>
                            <div class="flex flex-col mt-3">
                                <label for="tags">Tags</label>
                                <input value="{{old("tags")}}" name="tags" id="tags" type="text" class="rounded-lg" placeholder="Laravel, PHP, MySQL">
                                @error("tags")
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="flex flex-col mt-3">
                                <button class="mt-3 border-solid border-2 border-black rounded-full p-1 hover:bg-slate-400" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    let laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let apiToken = "{{auth()->user()->api_token}}";

    /* function getFile(file) {
        console.log(file.files[0]);
    } */

    function getFile(file) {
        axios.post(`../api/posts/image?api_token=${apiToken}`, {
                "headers": {
                    "X-CSRF-TOKEN": laravelToken
                }
            })
            .then((res) => console.log(res))
            .catch(() => console.log("Error"))
    }

</script>
