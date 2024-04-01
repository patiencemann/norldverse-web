<template>
    <div class="bg-gray-50 dark:bg-gray-700 rounded-3xl p-10 mb-5">

        <form action="#" @submit.prevent="updateDoc()" @keypress.enter.prevent="" enctype="multipart/form-data">
            <!-- Title -->
            <div class="mb-6 mt-2">
                <label for="helper-text" class="block mb-4 text-sm font-anek text-gray-900 dark:text-white font-bold" style="font-size: 20px">Your Title </label>
                <input  style="font-size: 22px" type="text" id="helper-text" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="data.title" placeholder="Title">
                <p style="font-size: 18px" id="helper-text-explanation" class="mt-4 text-sm text-gray-500 dark:text-gray-400">Blog title</p>
            </div>

            <!-- Caption -->
            <div class="mb-6 mt-5">
                <label for="helper-text" class="block mb-4 text-sm font-anek font-bold text-gray-900 dark:text-white" style="font-size: 19px">Your Caption</label>
                <input  style="font-size: 22px" type="text" id="helper-text" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="data.caption" placeholder="Descriptive Caption">
                <p style="font-size: 18px" id="helper-text-explanation" class="mt-4 text-sm text-gray-500 dark:text-gray-400">Short description about the blog</p>
            </div>

            <hr class="w-full h-1 mx-auto my-6 bg-gray-500 border-0 rounded md:my-10 dark:bg-gray-700">

            <div class="flex pr-2 divide-x-2">
                <!-- Image preview -->
                <div v-if="data.image" class="mr-5">
                    <img :src="imageUrl" alt="Selected Image" class="mt-4 mb-2 rounded-lg shadow-md" style="max-height: 300px;">
                </div>

                <!-- File input -->
                <div class="flex items-center justify-center w-1/3">
                    <label for="dropzone-file" class="flex flex-col ml-5 items-center justify-center w-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg
                                aria-hidden="true"
                                class="w-20 h-20 mb-3 text-gray-400"
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
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400" style="font-size: 17px; line-height: 24px">
                                <span class="font-semibold">Click to upload</span>
                                or drag and drop
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400" style="font-size: 17px">
                                SVG, PNG, JPG or GIF (MAX. 800x400px)
                            </p>
                        </div>
                        <input
                            type="file"
                            class="hidden"
                            id="dropzone-file"
                            @change="onFileChange"
                        />
                    </label>
                </div>
            </div>


            <hr class="w-full h-1 mx-auto my-6 bg-gray-500 border-0 rounded md:my-10 dark:bg-gray-700">

            <!-- Topics -->
            <label for="helper-text" class="block mb-4 text-sm font-anek font-bold text-gray-900 dark:text-white" style="font-size: 19px">Add Related topics</label>
            <div class="mt-3 mb-3">
                <span v-for="topic in data.selectedTopics" :key="topic" id="badge-dismiss-default" class="inline-flex items-center px-4 py-2 mr-2 font-bold text-1xl text-blue-800 bg-blue-100 rounded dark:bg-blue-900 dark:text-blue-300">
                    {{ topic }}
                    <button type="button" @click="removeTopic(topic)" class="inline-flex items-center p-0.5 ml-2 text-sm text-blue-400 bg-transparent rounded-sm hover:bg-blue-200 hover:text-blue-900 dark:hover:bg-blue-800 dark:hover:text-blue-300" data-dismiss-target="#badge-dismiss-default" aria-label="Remove">
                        <svg aria-hidden="true" class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Remove topic</span>
                    </button>
                </span>
            </div>
            <div class="mb-6 mt-2">
                <input
                    type="text"
                    style="font-size: 17px"
                    class="bg-gray-50 border border-none text-gray-900 text-md rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Ex: economics"
                    v-model="data.topic"
                    @keyup.space="onNewTopicEnter"
                    @focus="cleanTopicPlaceholder"
                    @keypress.enter="onNewTopicEnter"
                />
                <p style="font-size: 18px" id="helper-text-explanation" class="mt-4 text-sm text-gray-500 dark:text-gray-400">Ex: economic, applications, etc...</p>
            </div>

            <!-- Rich text area -->
            <v-md-editor
                height="600px"
                v-model="data.contents">
            </v-md-editor>

            <hr class="w-full h-1 mx-auto my-4 bg-gray-500 border-0 rounded md:my-10 dark:bg-gray-700" />

            <div class="mt-5 flex justify-between items-center">
                <button type="submit" id="submit-doc-btn" class="text-white text-center border border-none bg-green-800 hover:bg-green-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-bold rounded-full text-md px-4 py-3 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                    Save Changes
                </button>
            </div>
        </form>

        <div v-if="isLoading">
            <loader />
        </div>

        <alert :hasResponse="hasResponse" :response="response" :responseType="responseType" />
    </div>
</template>

<script>
    import axios from "axios";
    import Vue from 'vue';
    import VMdEditor from '@kangc/v-md-editor/lib/codemirror-editor';
    import enUS from '@kangc/v-md-editor/lib/lang/en-US';

    import '@kangc/v-md-editor/lib/style/codemirror-editor.css';
    import githubTheme from '@kangc/v-md-editor/lib/theme/github.js';

    // Support Code copier
    import '@kangc/v-md-editor/lib/theme/style/github.css';
    import createCopyCodePlugin from '@kangc/v-md-editor/lib/plugins/copy-code/index';

    // Suport line number
    import '@kangc/v-md-editor/lib/plugins/copy-code/copy-code.css';
    import createLineNumbertPlugin from '@kangc/v-md-editor/lib/plugins/line-number/index';

    // Support Emoji
    import createEmojiPlugin from '@kangc/v-md-editor/lib/plugins/emoji/index';
    import '@kangc/v-md-editor/lib/plugins/emoji/emoji.css';

    // highlightjs
    import hljs from 'highlight.js';

    // Resources for the codemirror editor
    import Codemirror from 'codemirror';

    // mode
    import 'codemirror/mode/markdown/markdown';
    import 'codemirror/mode/javascript/javascript';
    import 'codemirror/mode/css/css';
    import 'codemirror/mode/htmlmixed/htmlmixed';
    import 'codemirror/mode/vue/vue';

    // edit
    import 'codemirror/addon/edit/closebrackets';
    import 'codemirror/addon/edit/closetag';
    import 'codemirror/addon/edit/matchbrackets';

    // placeholder
    import 'codemirror/addon/display/placeholder';

    // active-line
    import 'codemirror/addon/selection/active-line';

    // scrollbar
    import 'codemirror/addon/scroll/simplescrollbars';
    import 'codemirror/addon/scroll/simplescrollbars.css';

    // style
    import 'codemirror/lib/codemirror.css';

    VMdEditor.lang.use('en-US', enUS);
    VMdEditor.Codemirror = Codemirror;
    VMdEditor.use(githubTheme, { Hljs: hljs, });
    VMdEditor.use(createCopyCodePlugin());
    VMdEditor.use(createLineNumbertPlugin());
    VMdEditor.use(createEmojiPlugin());

    Vue.use(VMdEditor);

    export default {
        props: {
            doc_identity: Number
        },
        data() {
            return {
                data: {
                    title: "",
                    caption: "",
                    contents: "",
                    image: '',
                    selectedTopics: [],
                    topic: ''
                },
                response: "",
                hasResponse: false,
                isLoading: false,
                responseType: 'success',
            };
        },
        computed: {
            imageUrl() {
                if (this.data.image instanceof File) {
                    return URL.createObjectURL(this.data.image);
                } else {
                    return this.data.image;
                }
            }
        },
        methods: {
            async getDoc() {
                this.isLoading = true;
                let response = await axios.get(`/api/docs/${this.doc_identity}`);

                let data = response.data.data;
                this.data.title = data.title;
                this.data.caption = data.caption;
                this.data.contents = data.contents;
                this.data.image = data.media.file_url
                this.data.selectedTopics = data.topics.topics
                this.isLoading = false;
            },

            /**
             * Convert image URL to Blob
             *
             * @param imageUrl
             * @returns {Promise<File|null>}
             */
             async convertImageUrlToBlob(imageUrl) {
                try {
                    const response = await fetch(imageUrl);
                    const imageData = await response.blob();

                    const file = new File([imageData], 'image.jpg', { type: 'image/jpeg' });
                    return file;
                } catch (error) {
                    this.responseType = "error";
                    this.response = "Error parsing image URL to Blob";
                    return null; // Return null in case of an error
                }
            },

            /**
             * Update the document
             *
             * @param e
             * @returns {Promise<void>}
             */
            async updateDoc() {
                this.isLoading = true;

                try{
                    let formData = new FormData();
                        formData.append('title', this.data.title);
                        formData.append('caption', this.data.caption);
                        formData.append('contents', this.data.contents);
                        formData.append('blog_category_id', this.doc_identity);
                        formData.append('topics', JSON.stringify(this.data.selectedTopics));

                    if (this.data.image instanceof File) {
                        formData.append('image', this.data.image);
                    } else {
                        const imageFile = await this.convertImageUrlToBlob(this.data.image);

                        if (imageFile) {
                            // Successfully converted image URL to File object
                            formData.append('image', imageFile);
                        } else {
                            // Error occurred while converting image URL
                            this.response = 'Error converting image URL to File object 😟';
                            this.responseType = 'error';
                        }
                    }

                    let response = await axios.post(`/api/docs/${this.doc_identity}`, formData);
                    this.response = response.data.message;
                    this.responseType = "success";

                    window.location.href = '/dashboard';
                }catch(error){
                    this.response = "Something went wrong, 😞 try again later, with image";
                    this.responseType = 'error';
                }

                this.isLoading = false;
                this.hasResponse = true;
            },

            /**
             * Handle file change
             *
             * @param e
             */
            onFileChange(e) {
                this.data.image = e.target.files[0];

                // Check file type
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                if (!allowedTypes.includes(this.data.image.type)) {
                    this.data.image = '';
                    this.responseType = "error";
                    this.response = "The selected file is not a valid image. Please select a file of type: jpeg, png, jpg, gif.";
                    return;
                }
            },

            /**
             * Add new topic
             *
             * @param e
             */
            onNewTopicEnter(e) {
                if (!this.data.selectedTopics.includes(e.target.value)) {
                    this.data.topic = "";
                    this.data.selectedTopics.push(e.target.value);
                }
            },

            /**
             * Remove topic
             *
             * @param topic
             */
            removeTopic(topic) {
                this.data.selectedTopics.splice(
                    this.data.selectedTopics.indexOf(topic), 1
                );
            },

            /**
             * Clean topic placeholder
             */
            cleanTopicPlaceholder() {
                this.data.topic = "";
            }
        },
        created() {
            this.getDoc()
        },
    };
</script>
