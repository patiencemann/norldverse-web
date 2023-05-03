<template>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-anek text-gray-900" style="font-size: 25px">Discussion ({{ Object.keys(comments).length }})</h2>
        <div class="flex -space-x-4">
            <img class="ring-2 ring-gray-300 dark:ring-gray-500 w-10 h-10 rounded-full border-2 border-white dark:border-gray-800" :src="user.user.avatar" alt="" v-for="user in uniqueUser.slice(0, limit)" :key="user.id">
            <a class="flex justify-center shadow items-center w-10 h-10 text-xs font-medium text-white bg-gray-700 rounded-full border-2 border-white hover:bg-gray-600 dark:border-gray-800 font-anek" href="#" v-if="Object.keys(uniqueUser).length > limit">+{{ Object.keys(uniqueUser).length - limit }}</a>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            doc: String
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
            }
        },
        mounted() {
            this.getDocComments();
        }
    }
</script>
