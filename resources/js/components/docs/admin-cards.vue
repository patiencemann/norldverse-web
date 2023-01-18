<template>
    <div>
        <h2 class="text-2xl font-bold mb-4">Your docs in one place</h2>

        <div v-if="isLoading">
            <loader />
        </div>

        <alert :hasResponse="hasResponse" :response="response" :responseType="responseType" />

        <div class="space-y-4">

            <div class="p-4 bg-gray-100 dark:bg-gray-800 border dark:border-gray-800 rounded-xl text-gray-800 space-y-2 flex justify-between items-center" v-for="doc in docs" :key="doc.id">
                <img data-tooltip-target="tooltip-jese" class="w-60 h-60 rounded" :src="doc.media.file_url" :alt="doc.title">
                <div class="ml-4 dark:text-white">
                    <div class="flex justify-between">
                        <div class="text-gray-400 text-xs">Number {{doc.id}}</div>
                        <div class="text-gray-400 text-xs">{{doc.created_at}}</div>
                    </div>
                    <a href="javascript:void(0)" class="font-bold hover:text-yellow-800 hover:underline dark:text-white">{{ doc.title }}</a>
                    <div class="text-sm text-gray-600 dark:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="text-gray-800 inline align-middle mr-1 dark:text-white" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                        </svg>
                        {{ doc.caption }}
                    </div>
                    <div class="inline-flex rounded-md shadow-sm mt-3">
                        <a :href="'/docs/'+doc.id" aria-current="page" class="py-2 px-4 text-sm text-center font-medium text-blue-700 bg-blue-200 rounded-l-lg border border-gray-200 hover:bg-gray-100 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                            View
                        </a>
                        <a :href="'/update-docs/'+doc.id" class="py-2 px-4 text-sm font-medium text-gray-900 bg-blue-500 border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                            update
                        </a>
                        <button @click="deleteDoc(doc.id)" class="py-2 px-4 text-sm font-medium text-gray-900 bg-red-500 rounded-r-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
                            Delete
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import Loader from '../common/loader.vue';

    export default {
        data() {
            return {
                isLoading: false,
                docs: [],
                response: '',
                hasResponse: false,
                responseType: 'success'
            }
        },
        components: {
            Loader
        },
        methods: {
            async getDocs() {
                this.isLoading = true;
                let response = await axios.get('/api/docs');

                this.isLoading = false;
                this.docs = response.data.data
            },
            async deleteDoc(docId) {
                try{
                    this.isLoading = true;
                    let response = await axios.delete(`/api/docs/${docId}`);

                    this.responseType = 'success';
                    this.response = response.data.message;

                    this.getDocs();
                }catch(error){
                    this.response = "something went wrong";
                    this.responseType = 'error';
                }

                this.isLoading = false;
                this.hasResponse = true;
            }
        },
        beforeMount() {
            this.getDocs()
        }
    }
</script>
