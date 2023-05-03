    <template>
        <div class="bg-gray-100 dark:bg-gray-700 rounded-3xl p-10 mb-5">
            <h1 class="text-3xl font-bold mb-10 dark:text-white" v-text="data.title"></h1>

            <form action="#" @submit.prevent="createDoc()" @keypress.enter.prevent="" enctype="multipart/form-data">
                <!-- Title -->
                <custom-input placeholder="Your Title" v-model="data.title"/>

                <!-- Caption -->
                <custom-input placeholder="What are you thinking!?., just caption...." v-model="data.caption"/>

                <!-- File preview -->
                <file-preview :preview="preview" />

                <!-- File input -->
                <file-input @change="onFileChange" />

                <!-- Topics -->
                <div class="mt-3 mb-3">
                    <span v-for="topic in data.selectedTopics" :key="topic" id="badge-dismiss-default" class="inline-flex items-center px-4 py-2 mr-2 font-bold text-1xl text-blue-800 bg-blue-100 rounded dark:bg-blue-900 dark:text-blue-300">
                        {{ topic }}
                        <button type="button" @click="removeTopic(topic)" class="inline-flex items-center p-0.5 ml-2 text-sm text-blue-400 bg-transparent rounded-sm hover:bg-blue-200 hover:text-blue-900 dark:hover:bg-blue-800 dark:hover:text-blue-300" data-dismiss-target="#badge-dismiss-default" aria-label="Remove">
                            <svg aria-hidden="true" class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Remove topic</span>
                        </button>
                    </span>
                </div>
                <custom-input placeholder="Topics..." v-model="data.topic" @keyup.space="onNewTopicEnter" @focus="cleanTopicPlaceholder" @keypress.enter="onNewTopicEnter"/>

                <!-- Rich text area -->
                <rich-textarea v-model="data.contents" placeholder="Write your full thoughts here..." />

                <div class="mt-5 flex justify-between items-center">
                    <button type="submit" id="submit-doc-btn" class="text-white text-center border border-none bg-green-800 hover:bg-green-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-bold rounded-full text-md px-4 py-3 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                        Publish the doc
                    </button>
                </div>
            </form>

            <div v-if="isLoading" class="bg-transparent w-full h-full z-50 flex items-center justify-center absolute top-0 right-0 bottom-0 left-0 backdrop-blur-sm">
                <loader />
            </div>

            <alert :hasResponse="hasResponse" :response="response" :responseType="responseType" />
        </div>
    </template>

    <script>
        import axios from "axios";

        export default {
            data() {
                return {
                    data: {
                        title: "Title - Untitled Doc",
                        caption: "Caption - Dont leave earth",
                        contents: "The world is better place than moon",
                        image: '',
                        selectedTopics: [],
                        topic: 'Ex: economics'
                    },
                    response: "",
                    hasResponse: false,
                    isLoading: false,
                    responseType: 'success',
                    preview: '',
                };
            },
            methods: {
                // Create and store doc
                async createDoc() {
                    this.isLoading = true;

                    try{
                        let formData = new FormData;
                        formData.append('title', this.data.title);
                        formData.append('image', this.data.image);
                        formData.append('caption', this.data.caption);
                        formData.append('contents', tinymce.get("tinymce").getContent());
                        formData.append('topics', JSON.stringify(this.data.selectedTopics));

                        let response = await axios.post("/api/docs", formData);

                        this.responseType = "success";
                        this.response = response.data.message;
                        window.location.href = '/dashboard';
                    }catch(error){
                        this.responseType = "error";
                        this.response = "something went wrong";
                    }

                    this.isLoading = false;
                    this.hasResponse = true;
                },
                onFileChange(e) {
                    this.data.image = e.target.files[0];
                    this.preview = URL.createObjectURL(e.target.files[0]);
                },
                onNewTopicEnter(e) {
                    if (!this.data.selectedTopics.includes(e.target.value)) {
                        this.data.topic = "";
                        this.data.selectedTopics.push(e.target.value);
                    }
                },
                removeTopic(topic) {
                    this.data.selectedTopics.splice(
                        this.data.selectedTopics.indexOf(topic), 1
                    );
                },
                cleanTopicPlaceholder() {
                    this.data.topic = "";
                }
            },
        };
    </script>
