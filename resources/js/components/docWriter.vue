<template>
    <div class="bg-white rounded-3xl p-8 mb-5">
        <h1 class="text-3xl font-bold mb-10" v-text="data.title"></h1>

        <form action="#" @submit.prevent="createDoc()" enctype="multipart/form-data">
                <div class="mb-6 mt-2">
                    <input
                        type="text"
                        id="Title"
                        name="title"
                        placeholder="Your Title..."
                        v-model="data.title"
                        class="bg-gray-100 border border-none text-gray-900 text-md rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    />
                </div>

                <div class="mb-6 mt-3">
                    <input
                        type="text"
                        id="caption"
                        name="caption"
                        placeholder="What are you thinking!?., just caption...."
                        v-model="data.caption"
                        class="block w-full p-4 text-gray-900 rounded-lg border-none border bg-gray-100 sm:text-md focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    />
                </div>

                <div class="flex items-center justify-center w-full">
                    <label
                        for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                    >
                        <div
                            class="flex flex-col items-center justify-center pt-5 pb-6"
                        >
                            <svg
                                aria-hidden="true"
                                class="w-10 h-10 mb-3 text-gray-400"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                                ></path>
                            </svg>
                            <p
                                class="mb-2 text-sm text-gray-500 dark:text-gray-400"
                            >
                                <span class="font-semibold">Click to upload</span>
                                or drag and drop
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                SVG, PNG, JPG or GIF (MAX. 800x400px)
                            </p>
                        </div>
                        <input id="dropzone-file" @change="onFileChange" type="file" class="hidden" />
                    </label>
                </div>

                <div class="mb-6 mt-3">
                    <textarea
                        id="tinymce"
                        rows="4"
                        class="block p-4 w-full text-md text-gray-900 bg-gray-100 rounded-lg border border-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write your full thoughts here..."
                        v-model="data.contents"
                    ></textarea>
                </div>
                <div class="mt-5 flex justify-between items-center">
                    <button
                        type="submit"
                        id="submit-doc-btn"
                        class="text-white text-center border border-none bg-green-800 hover:bg-green-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-bold rounded-full text-md px-4 py-3 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
                    >
                        Publish the doc
                    </button>
                </div>
            </form>
            <div
                v-if="isLoading"
                class="bg-transparent w-full h-full z-50 flex items-center justify-center absolute top-0 right-0 bottom-0 left-0 backdrop-blur-sm"
            >
                <loader />
            </div>
            <div class="-m-2 text-center">
                <div class="p-5" v-if="hasResponse">
                    <div
                        class="inline-flex items-center bg-white leading-none text-green-600 rounded-full p-2 shadow text-teal text-sm"
                    >
                        <span
                            class="inline-flex bg-green-600 text-white rounded-full py-2.5 px-3 justify-center items-center text-center"
                            >green</span
                        >
                        <span
                            class="inline-flex px-2 font-bold text-md"
                            v-text="response"
                        ></span>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <script>
    import axios from "axios";

    export default {
        data() {
            return {
                data: {
                    title: "Untitled Doc",
                    caption: "Dont leave earth",
                    contents: "The world is better place than moon",
                    image: ''
                },
                response: "",
                hasResponse: false,
                isLoading: false,
            };
        },
        methods: {
            // Create and store doc
            async createDoc() {
                this.isLoading = true;

                let formData = new FormData;
                    formData.append('title', this.data.title);
                    formData.append('image', this.data.image);
                    formData.append('caption', this.data.caption);
                    formData.append('contents', this.data.contents);

                let response = await axios.post("/api/docs", formData);

                this.isLoading = false;
                this.hasResponse = true;
                this.response = response.data.message;
            },
            onFileChange(e) {
                this.data.image = e.target.files[0];
            },
        },
    };
</script>
