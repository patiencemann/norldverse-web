    <template>
        <div class="bg-gray-100 dark:bg-gray-700 rounded-3xl p-8 mb-5">
            <h1 class="text-3xl font-bold mb-10 dark:text-white" v-text="data.title"></h1>

            <form action="#" @submit.prevent="createDoc()" enctype="multipart/form-data">
                <!-- Title -->
                <custom-input placeholder="Your Title" v-model="data.title"/>

                <!-- Caption -->
                <custom-input placeholder="What are you thinking!?., just caption...." v-model="data.caption"/>

                <!-- File input -->
                <file-input @change="onFileChange" />

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
                        title: "Untitled Doc",
                        caption: "Dont leave earth",
                        contents: "The world is better place than moon",
                        image: ''
                    },
                    response: "",
                    hasResponse: false,
                    isLoading: false,
                    responseType: 'success'
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
                },
                richTextChange(e) {
                    console.log(tinyMCE)
                },
            },
        };
    </script>
