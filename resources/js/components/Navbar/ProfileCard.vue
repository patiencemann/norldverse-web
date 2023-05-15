<template>
    <div class="wrapper" v-if="isOpen">
        <div @click="closeProfile" class="top-icons cursor-pointer bg-red-500 w-10 h-10 flex items-center justify-center text-white mr-2 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>

        <div class="profile flex items-center justify-center">
            <div class="flex items-center justify-center">
                <img :src="authUser.avatar" class="thumbnail" :alt="authUser.name"/>
                <input type="text" v-model="data.fullname" :placeholder="authUser.name" autocomplete="false" class="border-none bg-[#1a202c] text-green-400 font-bold font-anek rounded-lg block w-full py-2.6 text-center px-4 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white" style="font-size: 24px">
                <input type="text" v-model="data.position" :placeholder="data.position" autocomplete="false" class="border-none bg-[#1a202c] text-yellow-300 font-semibold font-anek rounded-lg block w-full py-2.6 text-center px-4 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white" style="font-size: 20px">
                <textarea type="text" rows="5" v-model="data.bio" :placeholder="data.bio" autocomplete="false" class="border-none mb-3 bg-[#1a202c] text-blue-400 font-anek rounded-lg block w-full py-2.6 text-center px-4 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white" style="font-size: 18px"></textarea>
                <input type="text" v-model="data.twitterUrl" :placeholder="data.twitter_handler" id="twitter_url" class="bg-[#1a202c] border-none mt-4 text-white font-bold font-anek text-center rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full py-2.6 px-4 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required style="font-size: 15px">
            </div>
            <button @click="saveProfileChanges" type="button" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 align-middle focus:ring-gray-300 font-bold font-anek rounded-lg text-md px-5 py-2.5 mt-3 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Save Changes</button>
        </div>
        <alert :hasResponse="hasResponse" :response="response" :responseType="responseType" />
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
                isLoading: false,
                hasResponse: false,
                userMetaData: {},
                data: {
                    fullname: JSON.parse(this.user).name,
                    bio: '',
                    position: '',
                    twitterUrl: ''
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
            },
            async saveProfileChanges() {
                this.isLoading = true;

                try{
                    let formData = new FormData;
                        formData.append('fullname', this.data.fullname);
                        formData.append('position', this.data.position);
                        formData.append('bio', this.data.bio);
                        formData.append('twitter_handler', this.data.twitterUrl);

                    let response = await axios.post("/api/users/profile", formData);

                    this.responseType = "success";
                    this.response = response.data.message;
                } catch(error) {
                    this.responseType = "error";
                    this.response = "something went wrong";
                }

                this.isLoading = false;
                this.hasResponse = true;
            }
        },
        watch: {
            userMetaData: {
                handler(newUserMetaData) {
                    this.data.bio = newUserMetaData?.bio !== undefined ? newUserMetaData.bio : '';
                    this.data.position = newUserMetaData?.position !== undefined ? newUserMetaData.position : '';
                    this.data.twitterUrl = newUserMetaData?.twitter_handler !== undefined ? newUserMetaData.twitter_handler : '';
                },
                immediate: true
            }
        },
        async mounted() {
            let meta = JSON.parse(this.user);
            let response = await axios.get(`/api/users/${meta.id}`);
            this.userMetaData = response.data.data.metaData;

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
