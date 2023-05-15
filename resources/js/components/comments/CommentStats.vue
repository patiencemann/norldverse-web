<template>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-anek text-gray-900 dark:text-[#E8E8ED]" style="font-size: 25px">
            <span>Discussion ({{ Object.keys(comments).length }})</span>
            <button @click="likeDoc('id-'+doc)" :id="'id-'+doc" type="button" :class="(liked?'bg-blue-600 ml-3 text-white':'bg-white text-black')+' animate-pulse z-10 hover:bg-blue-200 shadow-sm ring-4 ring-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                </svg>
                <span class="sr-only">Like this</span>
            </button>
            <span class="text-gray-500">({{ likes }} likes)</span>
        </h2>
        <div class="flex -space-x-4">
            <img class="ring-2 ring-gray-300 dark:ring-gray-500 w-10 h-10 rounded-full border-2 border-white dark:border-gray-800" :src="user.user.avatar" :alt="user.user.name" v-for="user in uniqueUser.slice(0, limit)" :key="user.id">
            <a class="flex justify-center shadow items-center w-10 h-10 text-xs font-medium text-white bg-gray-700 rounded-full border-2 border-white hover:bg-gray-600 dark:border-gray-800 font-anek" href="#" v-if="Object.keys(uniqueUser).length > limit">+{{ Object.keys(uniqueUser).length - limit }}</a>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            doc: String,
            likes: String,
            liked: String
        },
        data() {
            return {
                comments: [],
                uniqueUser: [],
                isLoading: false,
                limit: 4
            }
        },
        methods: {
            async getDocComments() {
                this.isLoading = true;
                let commentResponse = await axios.get(`/api/comments/${this.doc}`);
                this.comments = commentResponse.data.data;

                let userResponse = await axios.get(`/api/unique/comments/${this.doc}`);
                this.uniqueUser = userResponse.data.data;
                this.isLoading = false;
            },
            async likeDoc(elementId) {
                await axios.post(`/api/docs/like/${this.doc}`);
                document.getElementById(elementId).classList.remove('bg-white');
                document.getElementById(elementId).classList.add('bg-blue-600');
                document.getElementById(elementId).classList.add('text-white');
            }
        },
        mounted() {
            this.getDocComments();
        }
    }
</script>
