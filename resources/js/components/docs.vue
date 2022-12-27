<template>
    <div>
        <h2 class="text-2xl font-bold mb-4">Your docs in one place</h2>

        <div v-if="isLoading">
            <loader />
        </div>

        <div class="space-y-4">

            <div class="p-4 bg-white border rounded-xl text-gray-800 space-y-2 flex justify-between items-center" v-for="doc in docs" :key="doc.id">
                <img data-tooltip-target="tooltip-jese" class="w-60 h-60 rounded" :src="doc.media.file_url" :alt="doc.title">
                <div class="ml-4">
                    <div class="flex justify-between">
                        <div class="text-gray-400 text-xs">Number {{doc.id}}</div>
                        <div class="text-gray-400 text-xs">{{doc.created_at}}</div>
                    </div>
                    <a href="javascript:void(0)" class="font-bold hover:text-yellow-800 hover:underline">{{ doc.title }}</a>
                    <div class="text-sm text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="text-gray-800 inline align-middle mr-1" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                        </svg>
                        {{ doc.caption }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import Loader from './loader.vue';

    export default {
        data() {
            return {
                isLoading: false,
                docs: []
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
            }
        },
        beforeMount() {
            this.getDocs()
        }
    }
</script>
