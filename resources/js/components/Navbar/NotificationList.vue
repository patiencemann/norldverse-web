<template>
    <div class="notifications">
        <button @click="readNotifications" id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification" data-tooltip-target="tooltip-notification"
            type="button"
            class="hidden sm:inline-block ml-2 relative text-gray-500 dark:bg-gray-700 dark:text-gray-400 bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
            <svg class="w-10 h-10" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path></svg>
            <span v-if="count > 0" class="absolute inline-flex items-center justify-center w-8 h-8 text-md font-bol font-anek text-white bg-red-500 border-2 border-white rounded-full -top-1 -right-2 dark:border-gray-900">
                {{ count }}
            </span>
        </button>
        <div id="tooltip-notification" role="tooltip"
            class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip"
            data-popper-placement="top"
            style="font-size: 15px;position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(1262px, -62px);">
            Notifcations
            <div class="tooltip-arrow" data-popper-arrow="" style="position: absolute; left: 0px; transform: translate(69px, 0px);"></div>
        </div>

        <div id="dropdownNotification" class="notification-model z-20 hidden bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-deep-green-900 dark:divide-gray-700" aria-labelledby="dropdownNotificationButton">
            <div class="block px-4 py-2 font-semibold font-anek text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
                Notifications
            </div>
            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                <a v-for="notification in notifications" :key="notification.id" class="single-notification px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 dark:bg-deep-green-900 dark:text-gray-50">
                    <div class="flex-shrink-0">
                        <svg class="w-10 h-10 text-gray-300" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path></svg>
                        <div class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 bg-gray-600 border border-white rounded-full dark:border-gray-800">
                            <svg class="w-3 h-3 text-white" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"></path><path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path></svg>
                        </div>
                    </div>
                    <div class="pl-3">
                        <div class="notification-message text-gray-500 text-md font-anek mb-1.5 dark:text-gray-400"><strong>{{ notification.header }}</strong>: {{ notification.message }}</div>
                        <div class="text-sm font-anek text-gray-600 dark:text-blue-500">{{ notification.created_at }}</div>
                    </div>
                </a>
                <div v-if="isLoading" class="absolute top-0 right-0 left-0 bottom-0 w-full h-full bg-gray-50 flex items-center justify-center">
                    <svg aria-hidden="true" role="status" class="inline h-10 w-10 animate-spin text-indigo-400" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"></path>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#FFF"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from "axios";

    export default {
        data() {
            return {
                notifications: {},
                count: 0,
                response: "",
                hasResponse: false,
                isLoading: false,
                responseType: 'success',
            };
        },
        methods: {
            async getNotifications() {
                this.isLoading = true;

                try{
                    let response = await axios.get("/api/notifications");

                    this.notifications = response.data.data
                    this.count = response.data.count
                    this.responseType = "success";
                    this.response = response.data.message;
                } catch(error) {
                    this.responseType = "error";
                    this.response = "Something went wrong, please try again later";
                }

                this.isLoading = false;
                this.hasResponse = true;
            },
            readNotifications() {
                axios.post("/api/notifications/read/all").then((response) => this.count = 0);
            }
        },

        mounted(){
            this.getNotifications();
        }
    }
</script>
