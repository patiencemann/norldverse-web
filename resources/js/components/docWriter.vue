<template>
    <div class="bg-white rounded-3xl p-8 mb-5">
        <h1 class="text-3xl font-bold mb-10" v-text="data.title"></h1>

        <form action="#" @submit.prevent="createDoc()">
            <!-- {{ csrf_field() }} -->
            <div class="mb-6 mt-2">
                <input type="text" id="Title" name="title" placeholder="Your Title..." v-model="data.title"
                    class="bg-gray-100 border border-none text-gray-900 text-md rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mb-6 mt-3">
                <input type="text" id="caption" name="caption"
                    placeholder="What are you thinking!?., just caption...." v-model="data.caption"
                    class="block w-full p-4 text-gray-900 rounded-lg border-none border bg-gray-100 sm:text-md focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mb-6 mt-3">
                <textarea id="tinymce" rows="4"
                    class="block p-4 w-full text-md text-gray-900 bg-gray-100 rounded-lg border border-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Write your full thoughts here..." v-model="data.contents"></textarea>
            </div>
            <div class="mt-5 flex justify-between items-center">
                <button type="submit" class="text-white text-center border border-none bg-green-800 hover:bg-green-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-bold rounded-full text-md px-4 py-3 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Publish the doc</button>
                <x-loader />
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                data: {
                    title: 'Untitled Doc',
                    caption: 'Dont leave earth',
                    contents: 'The world is better place than moon'
                },
                docs: []
            };
        },
        methods: {
            // Create and store doc
            async createDoc() {
                let response = await axios.post('/api/docs', this.data);
                this.docs = response.data;
            }
        }
    };
</script>
