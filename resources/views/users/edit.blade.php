<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <x-slot name="pName">
                Settings
            </x-slot>
            Settings
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-xl font-bold mb-3">User Informations</h3>
                    <form action="{{route("users.update.informations", ["user"=>auth()->user()])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="flex flex-col">
                            <label for="name">Display Name</label>
                            <input value="{{auth()->user()->name}}" name="name" id="name" type="text" class="rounded-lg">
                            @error("name")
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col mt-3">
                            <label for="email">Email</label>
                            <input value="{{auth()->user()->email}}" name="email" id="email" type="email" class="rounded-lg">
                            @error("email")
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col mt-3">
                            <label for="profile_picture">Profile picture</label>
                            <div class="flex w-full">
                                <span class="w-fit">
                                    <img id="pfp-preview" class="w-10 h-10 mr-2 rounded-full inline-block" src="{{asset("storage/". auth()->user()->profile_picture)}}" alt="profile picture">
                                </span>
                                <input name="profile_picture" id="profile_picture" type="file" accept=".png, .jpg, .jpeg" class="inline-block border border-solid border-black p-1 rounded-lg w-full">
                            </div>
                            @error("profile_picture")
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col mt-3">
                            <button class="mt-3 border-solid border-2 border-black rounded-full p-1 hover:bg-slate-400" type="submit">Update Informations</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="bg-white mt-5 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-xl font-bold mb-3">Change Password</h3>
                    <form action="{{route("users.update.password", ["user"=>auth()->user()])}}" method="POST">
                        @csrf
                        @method("PATCH")
                        <div class="flex flex-col">
                            <label for="oldPassword">Old Password</label>
                            <input name="oldPassword" id="oldPassword" type="password" class="rounded-lg">
                            @error("oldPassword")
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col mt-3">
                            <label for="newPassword">New Password</label>
                            <input name="newPassword" id="newPassword" type="password" class="rounded-lg">
                            @error("newPassword")
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col mt-3">
                            <label for="newPassword_confirmation">New Password Confirmation</label>
                            <input name="newPassword_confirmation" id="newPassword_confirmation" type="password" class="rounded-lg">
                            @error("newPassword_confirmation")
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col mt-3">
                            <button class="mt-3 border-solid border-2 border-black rounded-full p-1 hover:bg-slate-400" type="submit">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="bg-white mt-5 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-xl font-bold mb-3">Delete profile</h3>
                    <div class="text-center">
                        <span class="text-red-600 font-bold bg-red-200 border border-red-700 rounded-lg p-1 inline-block">WARNING: This will delete PERMANENTLY your account and all posts associated with it!</span>
                    </div>
                    <form action="{{route("users.destroy", ["user"=>auth()->user()])}}" method="POST" class="mt-3">
                        @csrf
                        @method("DELETE")
                        <div class="flex flex-col">
                            <label for="password">Password</label>
                            <input name="password" id="password" type="password" class="rounded-lg">
                            @error("password")
                            <p class="text-red-600">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col mt-3">
                            <button class="mt-3 border-solid border-2 text-red-800 border-red-700 bg-red-200 rounded-full p-1 hover:bg-red-300" type="submit">Permanently Delete Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>

<script>
    const pfpPreview = document.querySelector("#pfp-preview")
    const pfpInput = document.querySelector("#profile_picture")

    pfpInput.onchange = changePreview

    function changePreview() {
        const selectedFile = this.files[0]
        const reader = new FileReader()

        if (selectedFile.size >= 2000000) {
            alert("Picture is too big")
            pfpInput.value = ""
            return
        }

        reader.onload = e => {
            const image = new Image();
            const imageSrc = e.target.result
            image.src = imageSrc;

            let canChange = false

            image.onload = (e) => {
                const height = e.target.height;
                const width = e.target.width;
                if (height > 100 && width > 100 && height < 1000 && width < 1000) {
                    pfpPreview.src = imageSrc
                } else {
                    alert("Picture is has invalid dimensions")
                    pfpInput.value = ""
                }
            }
        }

        reader.readAsDataURL(selectedFile)
    }

</script>
