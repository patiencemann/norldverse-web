<template>
    <div class="loop-subtitle">
        <small class="loop-subtitle-title global-title dark:text-gray-200 font-anek">
            See what has been<br>
            <span class="text-[#50217b] dark:text-[#7123bb] font-semibold">Written Lately</span>
        </small>
        <div class="global-authors" v-if="Object.keys(uniqueUser).length > 3">
            <div>
                <div class="global-item-author is-image global-image" v-for="user in uniqueUser.slice(0, limit)" :key="user.id">
                    <a href="/author/breana/" class="global-link" title="Breana Flatley"></a>
                    <img :src="user.avatar" loading="lazy" :alt="user.name">
                </div>
            </div>
            <small class="dark:text-gray-200">Meet our top Vistors</small>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'title-section',
        data() {
            return {
                uniqueUser: [],
                isLoading: false,
                limit: 4
            }
        },
        methods: {
            async getFrequentUsers() {
                this.isLoading = true;
                let commentResponse = await axios.get(`/api/vistors`);
                this.uniqueUser = commentResponse.data.data;
            }
        },
        mounted() {
            this.getFrequentUsers();
        }
    }
</script>
