<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <x-slot name="pName">
                Edit Post
            </x-slot>
            Edit Post
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Edit post
                    <div>
                        <form action="{{route('posts.update', ['post'=>$post->slug])}}" method="POST" id="editPostForm">
                            @csrf
                            @method("PUT")
                            <div class="flex flex-col">
                                <label for="heading">Heading</label>
                                <input disabled value="{{$post->heading}}" name="heading" id="heading" type="text" class="rounded-lg bg-gray-300">
                            </div>
                            <div class="flex flex-col mt-3">
                                <label for="editor">Post</label>
                                <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                                <input type="hidden" id="oldContent" value="{{ $post->content }}">
                                <input type="hidden" name="content" id="content">
                                <div>
                                    @error("content")
                                    <p class="text-red-600">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex flex-col mt-3">
                                <label for="images">Images</label>
                                <input name="image" id="images" type="file" accept=".png, .jpg, .jpeg" class="rounded-lg border border-solid border-black p-1">

                                <div id="linkDisplay" class="border border-solid border-black bg-zinc-100 rounded-lg p-2 mt-3 hidden">
                                </div>

                            </div>
                            <div class="flex flex-col mt-3">
                                <label for="tags">Tags</label>
                                <input value="{{$post->tags}}" name="tags" id="tags" type="text" class="rounded-lg" placeholder="Laravel, PHP, MySQL">
                                @error("tags")
                                <p class="text-red-600">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="flex flex-col mt-3">
                                <button class="mt-3 border-solid border-2 border-black rounded-full p-1 hover:bg-slate-400" type="submit">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const laravelToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const apiToken = "{{auth()->user()->api_token}}";

    const linkDisplay = document.querySelector("#linkDisplay");
    const fileInput = document.querySelector("#images")

    fileInput.onchange = uploadImage

    function uploadImage() {
        this.disabled = true

        let fd = new FormData();
        fd.append('image', this.files[0])

        axios.post(`../../api/posts/image?api_token=${apiToken}`, fd, {
                "headers": {
                    "Content-Type": "multipart/form-data"
                    , "X-CSRF-TOKEN": laravelToken
                }
            })
            .then(displayImageLink)
            .catch(errorHandler)
    }

    function displayImageLink(res) {
        linkDisplay.classList.remove("hidden")
        linkDisplay.textContent = `![Image description](http://127.0.0.1:8000/storage/${res.data})`

        fileInput.disabled = false
    }

    function errorHandler(err) {
        console.log(err)
        fileInput.disabled = false
        fileInput.value = ""

        linkDisplay.classList.remove("hidden")
        linkDisplay.textContent = `Something went wrong :(`
    }

</script>
