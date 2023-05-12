<template>
    <div class="wrapper" v-if="isOpen">
        <div @click="closeProfile" class="top-icons cursor-pointer bg-red-500 w-10 h-10 flex items-center justify-center text-white mr-2 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>

        <div class="profile">
            <img :src="authUser.avatar" class="thumbnail" :alt="authUser.name"/>
            <input type="text" v-model="data.fullname" :placeholder="authUser.name" autocomplete="false" class="border-none bg-[#1a202c] text-green-400 font-bold font-anek rounded-lg block w-full py-2.6 text-center px-4 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white" style="font-size: 24px">
            <input type="text" v-model="data.position" :placeholder="authUser?.userMetaData !== undefined ? authUser.userMetaData.position : 'Your Position'" autocomplete="false" class="border-none bg-[#1a202c] text-yellow-300 font-semibold font-anek rounded-lg block w-full py-2.6 text-center px-4 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white" style="font-size: 20px">
            <textarea type="text" v-model="data.bio" :placeholder="authUser?.userMetaData !== undefined ? authUser.userMetaData.bio : 'Update Bio'" autocomplete="false" class="border-none bg-[#1a202c] text-blue-400 font-anek rounded-lg block w-full py-2.6 text-center px-4 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white" style="font-size: 18px"></textarea>
            <input type="text" v-model="data.twitterUrl" :placeholder="authUser?.userMetaData !== undefined ? authUser.userMetaData.twitter_handler : 'https://twitter'" id="twitter_url" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full py-2.6 px-4 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required style="font-size: 15px">
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            user: { require: true }
        },
        data() {
            return {
                isOpen: false,
                data: {
                    fullname: "",
                    bio: "",
                    position: "",
                    twitterUrl: ""
                }
            }
        },
        computed: {
            authUser: {
                get() {
                    return JSON.parse(this.user);
                },
            },
        },
        methods: {
            closeProfile() {
                this.isOpen = false;
            }
        },
        mounted() {
            this.$root.$on('open', () => {
                this.isOpen = true;
            });
        }
    }
</script>
<style scoped>
.wrapper {
    width: 320px;
    background: #1a202c;
    transition: background 0.6s ease;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 8px 40px rgba(0, 0, 0, 0.2);
    position: absolute;
    top: 20px;
    right: 20px;
    z-index: 99;
}
.wrapper .profile {
    margin-top: 20px;
    position: relative;
}
.wrapper .profile .thumbnail {
    width: 124px;
    height: 124px;
    display: flex;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 1.5em;
    border-radius: 100%;
    box-shadow: 0 13px 26px rgba(0, 0, 0, 0.2), 0 3px 6px rgba(0, 0, 0, 0.2);
}
.wrapper .profile .name {
    font-size: 24px;
    font-weight: 600;
    text-align: center;
}
.wrapper .profile .title {
    font-size: 0.90em;
    font-weight: 600;
    text-align: center;
    padding-top: 0.5em;
    padding-bottom: 0.7em;
    letter-spacing: 1.5px;
}
.wrapper .profile .description {
    font-size: 14px;
    font-weight: 500;
    text-align: center;
    margin-bottom: 1.3em;
}
.wrapper .profile .btn {
    color: #fff;
    width: 130px;
    height: 42px;
    outline: none;
    border: none;
    display: block;
    cursor: pointer;
    font-weight: 300;
    margin-left: auto;
    margin-right: auto;
    border-radius: 70px;
}
</style>
