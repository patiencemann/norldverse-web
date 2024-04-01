    <template>
        <div class="bg-gray-50 dark:bg-[#10172a] rounded-3xl p-10 mb-5 border border-gray-200 dark:border-gray-400">
            <form @submit.prevent="createDoc()" @keypress.enter.prevent="" enctype="multipart/form-data">

                <!-- Title -->
                <div class="mb-6 mt-2">
                    <div class="inline-flex mb-3 shadow-sm items-center justify-between pl-3 py-2 pr-4 text-md text-gray-700 bg-gray-100 rounded-full dark:bg-gray-800 dark:text-white" aria-label="Component requires Tailwind v3.0">
                        <span class="text-xs bg-white dark:bg-gray-900 rounded-full text-gray-900 px-3 py-1.5 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                            </svg>
                        </span>
                        <span class="text-md font-bold">Title</span>
                    </div>
                    <input  style="font-size: 18px" type="text" class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-[0.7rem] focus:ring-blue-500 focus:border-blue-500 block w-full py-[1rem] px-[1.5rem] leading-[1.5rem] text-[1rem] dark:bg-[#10172a] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="data.title" placeholder="Add Title">
                    <p style="font-size: 14px !important" class="mt-3 font-semibold text-sm text-gray-400 dark:text-gray-400">Add your Blog/doc title</p>
                </div>

                <!-- Caption -->
                <div class="mb-6 mt-5">
                    <div class="inline-flex mb-3 shadow-sm items-center justify-between pl-3 py-2 pr-4 text-md text-gray-700 bg-gray-100 rounded-full dark:bg-gray-800 dark:text-white" aria-label="Component requires Tailwind v3.0">
                        <span class="text-xs bg-white dark:bg-gray-900 rounded-full text-gray-900 px-3 py-1.5 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                            </svg>
                        </span>
                        <span class="text-md font-bold">Description / Caption</span>
                    </div>
                    <input style="font-size: 18px" type="text" id="helper-text"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-[0.7rem] focus:ring-blue-500 focus:border-blue-500 block w-full py-[1rem] px-[1.5rem] leading-[1.5rem] text-[1rem] dark:bg-[#10172a] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" v-model="data.caption" placeholder="Descriptive Caption">
                    <p style="font-size: 14px !important" class="mt-4 text-sm text-gray-400 font-semibold dark:text-gray-400">Short description about the blog</p>
                </div>

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

                <!-- Topics -->
                <div class="mt-5 mb-6">
                    <div class="inline-flex mb-3 shadow-sm items-center justify-between pl-3 py-2 pr-4 text-md text-gray-700 bg-gray-100 rounded-full dark:bg-gray-800 dark:text-white" aria-label="Component requires Tailwind v3.0">
                        <span class="text-xs bg-white dark:bg-gray-900 rounded-full text-gray-900 px-3 py-1.5 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                            </svg>
                        </span>
                        <span class="text-md font-bold">Story Tags</span>
                    </div>
                    <span v-for="topic in data.selectedTopics" :key="topic" id="badge-dismiss-default" class="inline-flex items-center px-4 py-2 mr-2 font-bold text-1xl text-blue-800 bg-blue-100 rounded dark:bg-blue-900 dark:text-blue-300">
                        {{ topic }}
                        <button type="button" @click="removeTopic(topic)" class="inline-flex items-center p-0.5 ml-2 text-sm text-blue-400 bg-transparent rounded-sm hover:bg-blue-200 hover:text-blue-900 dark:hover:bg-blue-800 dark:hover:text-blue-300" data-dismiss-target="#badge-dismiss-default" aria-label="Remove">
                            <svg aria-hidden="true" class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Remove topic</span>
                        </button>
                    </span>
                    <input
                        type="text"
                        style="font-size: 17px"
                        class="bg-gray-50 border border-none text-gray-900 text-md rounded-[0.7rem] focus:ring-green-500 focus:border-green-500 block w-full py-[1rem] px-[1.5rem] leading-[1.5rem] text-[1rem] dark:bg-[#10172a] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Ex: economics"
                        v-model="data.topic"
                        @keyup.space="onNewTopicEnter"
                        @focus="cleanTopicPlaceholder"
                        @keypress.enter="onNewTopicEnter"
                    />
                    <p style="font-size: 14px !important" class="text-sm text-gray-400 font-semibold dark:text-gray-400">Ex: economic, applications, etc...</p>

                    <select
                        v-model="data.blog_category_id"
                        style="font-size: 17px"
                        class="bg-gray-50 mt-4 border border-none text-gray-900 text-md rounded-[0.7rem] focus:ring-green-500 focus:border-green-500 block w-full py-[1.3rem] px-[1.5rem] leading-[1.5rem] text-[1rem] dark:bg-[#10172a] dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Choose Category</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
                    </select>
                </div>

                <!-- Rich text area -->
                <div class="mb-6 mt-5">
                    <div class="inline-flex mb-3 shadow-sm items-center justify-between pl-3 py-2 pr-4 text-md text-gray-700 bg-gray-100 rounded-full dark:bg-gray-800 dark:text-white" aria-label="Component requires Tailwind v3.0">
                        <span class="text-xs bg-white dark:bg-gray-900 rounded-full text-gray-900 px-3 py-1.5 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                            </svg>
                        </span>
                        <span class="text-md font-bold">Write Your story</span>
                    </div>
                    <v-md-editor
                        height="600px"
                        v-model="data.contents"
                        placeholder="Support Markdown"
                        :include-level="[3, 4]"
                        left-toolbar=""
                        right-toolbar=""
                        :toolbar="null">
                    </v-md-editor>
                </div>

                <div class="mt-5 flex justify-between items-center">
                    <button type="submit" id="submit-doc-btn" class="text-white text-center border border-none bg-green-800 hover:bg-green-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-bold rounded-full text-md px-5 py-3 mr-2 mb-2 dark:bg-indigo-700 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                        Publish
                    </button>
                    <button type="button" @click="saveInDraft" class="text-white text-center border border-none bg-gray-400 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-bold rounded-full text-md px-4 py-3 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                        Save as draft
                    </button>
                </div>
            </form>

            <div v-if="isLoading">
                <loader />
            </div>

            <alert :hasResponse="hasResponse" :response="response" :responseType="responseType" />
        </div>
    </template>

    <style>
        .v-md-editor {
            box-shadow: none !important;
            border: 1px solid #dee2e6;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .v-md-editor__toolbar {
            padding: 6px 10px !important;
        }

        .v-md-editor__toolbar {
            display: none !important;
        }

        .v-md-editor__editor-wrapper {
            border: none !important;
            border-right: none !important;
        }
    </style>

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
            data() {
                return {
                    data: {
                        title: "",
                        caption: "",
                        contents: "## Start writing",
                        image: '',
                        selectedTopics: [],
                        topic: '',
                        blog_category_id: '',
                    },
                    response: "",
                    categories: [],
                    hasResponse: false,
                    isLoading: false,
                    responseType: 'success',
                    preview: '',
                    metaUser: document.querySelector("meta[name='user']").getAttribute("content"),
                    authUser: null
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
                /**
                 * Check if trying to edit drafts
                 * and async drafts
                 */
                asyncDraftDoc() {
                    const draftId = this.getParameterByName('draft');
                    const user = document.querySelector("meta[name='user']").getAttribute("content");
                    const authUser = JSON.parse(user);
                    const key = "patienceman_&_"+authUser.email+"_drafts";
                    const myDrafts = JSON.parse(localStorage.getItem(key));

                    if(myDrafts.hasOwnProperty(`${draftId}`)){
                        const doc = myDrafts[`${draftId}`];

                        this.data.title = doc.title;
                        this.data.caption = doc.caption;
                        this.data.contents = doc.contents;
                        this.data.image = doc.image;
                        this.data.selectedTopics = doc.selectedTopics;
                        this.data.topic = doc.topic;
                        this.data.blog_category_id = doc.blog_category_id;
                    }
                },

                /**
                 * Store and publish custom blog
                 * then redirect back to dashboard
                */
                async createDoc() {
                    this.isLoading = true;

                    try{
                        let formData = new FormData;
                            formData.append('title', this.data.title);
                            formData.append('image', this.data.image);
                            formData.append('caption', this.data.caption);
                            formData.append('contents', this.data.contents);
                            formData.append('blog_category_id', this.data.blog_category_id);
                            formData.append('topics', JSON.stringify(this.data.selectedTopics));

                        let response = await axios.post("/api/docs", formData);

                        this.responseType = "success";
                        this.response = response.data.message;

                        

                        window.location.href = '/dashboard';
                    } catch(error) {
                        this.responseType = "error";
                        this.response = error.response.data.message;
                    }

                    this.isLoading = false;
                    this.hasResponse = true;
                },

                /**
                 * Save blog in localstorange
                 * then show-off success message
                 */
                saveInDraft() {
                    const user = document.querySelector("meta[name='user']").getAttribute("content");
                    const authUser = JSON.parse(user);
                    const key = "patienceman_&_"+authUser.email+"_drafts";

                    const myDrafts = localStorage.getItem(key);
                    const newData = this.data;
                    const uniqueId = "id" + Math.random().toString(16).slice(2)

                    if(myDrafts){
                        const newDrafts = JSON.parse(myDrafts);
                            newDrafts[`${uniqueId}`] = newData;

                        localStorage.setItem(key, JSON.stringify(newDrafts));
                    } else {
                        const newDrafts = {};
                            newDrafts[`${uniqueId}`] = newData;
                        localStorage.setItem(key, JSON.stringify(newDrafts));
                    }

                    this.responseType = "success";
                    this.response = "Saved in your drafts";
                    this.hasResponse = true;
                },

                /**
                 * listern to inputfile change
                 * and keep image in data handler
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

                    this.preview = URL.createObjectURL(e.target.files[0]);
                },

                /**
                 * listen to any topic trigger and
                 * then store topic in selected topic model
                 *
                 * @param event
                */
                onNewTopicEnter(e) {
                    if (!this.data.selectedTopics.includes(e.target.value)) {
                        this.data.topic = "";
                        this.data.selectedTopics.push(e.target.value);
                    }
                },

                /**
                 * remove custom topic from data when
                 * function call
                 *
                 * @param topic
                */
                removeTopic(topic) {
                    this.data.selectedTopics.splice(
                        this.data.selectedTopics.indexOf(topic), 1
                    );
                },

                /**
                 * Clear temporary topic handler
                 * */
                cleanTopicPlaceholder() {
                    this.data.topic = "";
                },

                getParameterByName(name, url = window.location.href) {
                    name = name.replace(/[\[\]]/g, '\\$&');
                    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                        results = regex.exec(url);
                    if (!results) return null;
                    if (!results[2]) return '';
                    return decodeURIComponent(results[2].replace(/\+/g, ' '));
                },

                /**
                 * Fetch all categories
                 *
                 * */
                async getAllCategories() {
                    this.categories = [];
                    console.log("there")
                    let response = await axios.get(`/api/public/categories`);
                    this.categories = response.data.data
                }
            },

            async mounted() {
                await this.getAllCategories();
                this.asyncDraftDoc();
            }
        };
    </script>
