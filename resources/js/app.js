require("./bootstrap");

import Editor from "@toast-ui/editor";
require("codemirror/lib/codemirror.css");
require("@toast-ui/editor/dist/toastui-editor.css");

import Alpine from "alpinejs";
import axios from "axios";

window.Alpine = Alpine;

Alpine.start();

const editor = new Editor({
    el: document.querySelector("#editor"),
    height: "400px",
    initialEditType: "markdown",
    placeholder: "Write here your post!",
    hooks: {
        addImageBlobHook(imageBlob, callback) {
            const fd = new FormData();
            fd.append("image", imageBlob);

            console.log(fd);

            axios({
                method: "POST",
                url: `../api/posts/image?api_token=${apiToken}`,
                processData: false,
                headers: {
                    "Content-Type": "multipart/form-data",
                    "X-CSRF-TOKEN": laravelToken,
                },
                data: fd,
            })
                .then((res) => {
                    callback(
                        `http://127.0.0.1:8000/storage/${res.data}`,
                        document.querySelector("#toastuiAltTextInput").value
                    );
                })
                .catch((err) => console.log(err));
        },
    },
});

if (document.querySelector("#createPostForm")) {
    document
        .querySelector("#createPostForm")
        .addEventListener("submit", (e) => {
            e.preventDefault();
            document.querySelector("#content").value = editor.getMarkdown();
            e.target.submit();
        });
}

if (document.querySelector("#editPostForm")) {
    editor.setMarkdown(document.querySelector("#oldContent").value);

    document.querySelector("#editPostForm").addEventListener("submit", (e) => {
        e.preventDefault();
        document.querySelector("#content").value = editor.getMarkdown();
        e.target.submit();
    });
}
