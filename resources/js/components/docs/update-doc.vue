    <template>
        <div class="bg-gray-100 dark:bg-gray-700 rounded-3xl p-8 mb-5">
            <h1 class="text-3xl font-bold mb-10 dark:text-white" v-text="data.title"></h1>

            <form action="#" @submit.prevent="updateDoc()" enctype="multipart/form-data">
                <!-- Title -->
                <custom-input placeholder="Your Title" v-model="data.title"/>

                <!-- Caption -->
                <custom-input placeholder="What are you thinking!?., just caption...." v-model="data.caption"/>

                <!-- File preview -->
                <file-preview :preview="data.image" />

                <!-- File input -->
                <file-input @change="onFileChange" v-model="data.image" />

                <!-- Rich text area -->
                <rich-textarea v-model="data.contents" placeholder="Write your full thoughts here..." />

                <div class="mt-5 flex justify-between items-center">
                    <button
                        type="submit"
                        id="submit-doc-btn"
                        class="text-white text-center border border-none bg-green-800 hover:bg-green-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-bold rounded-full text-md px-4 py-3 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
                    >
                        Save changes
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
            props: {
                doc_identity: Number
            },
            data() {
                return {
                    data: {
                        title: "",
                        caption: "",
                        contents: "",
                        image: ''
                    },
                    response: "",
                    hasResponse: false,
                    isLoading: false,
                    responseType: 'success',
                };
            },
            methods: {
                async getDoc() {
                    this.isLoading = true;
                    let response = await axios.get(`/api/docs/${this.doc_identity}`);
                    this.isLoading = false;

                    let data = response.data.data;
                    this.data.title = data.title;
                    this.data.caption = data.caption;
                    this.data.contents = data.contents;
                    this.data.image = data.media.file_url
                },

                // Create and store doc
                async updateDoc() {
                    this.isLoading = true;

                    try{
                        let formData = new FormData();
                            formData.append('title', this.data.title);
                            formData.append('image', this.data.image);
                            formData.append('caption', this.data.caption);
                            formData.append('contents', tinymce.get("tinymce").getContent());

                        let response = await axios.post(`/api/docs/${this.doc_identity}`, formData);
                        this.response = response.data.message;
                        this.responseType = "success";
                    }catch(error){
                        this.response = "Something went wrong, 😞 try again later, with image";
                        this.responseType = 'error';
                    }

                    this.isLoading = false;
                    this.hasResponse = true;
                },
                onFileChange(e) {
                    this.data.image = e.target.files[0];
                },
            },
            created() {
                this.getDoc()
            },
        };
    </script>
