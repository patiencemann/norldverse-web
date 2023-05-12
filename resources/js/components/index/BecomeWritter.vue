<template>
    <div id="alert-5" style="border-bottom: 1px solid #ceced0" class="flex relative text-center items-center px-5 py-4 justify-between bg-[#fafafa] dark:bg-gray-800" role="alert">
        <div class="flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
            </svg>
            <span style="font-size: 16px !important" class="ml-3 text-center font-semibold font-anek text-gray-800 dark:text-gray-300">
                Get unlimited stories and share your experiences for free,
                <span @click="becomeMember" class="bg-gray-200 cursor-pointer text-gray-800 font-bold font-anek mr-2 px-3 py-1 rounded dark:bg-gray-700 dark:text-gray-300">Become a writter</span>
            </span>
        </div>
        <button type="button" class=" bg-gray-50 items-center justify-center text-gray-500 rounded-lg focus:ring-2 focus:ring-gray-400 hover:bg-gray-200 inline-flex h-10 w-10 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white" data-dismiss-target="#alert-5" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <div v-if="isLoading" class="absolute top-0 right-0 left-0 bottom-0 w-full h-full bg-gray-50 flex items-center justify-center">
            <svg aria-hidden="true" role="status" class="inline h-10 w-10 animate-spin text-indigo-400" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"></path>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#FFF"></path>
            </svg>
        </div>
        <alert :hasResponse="hasResponse" :response="response" :responseType="responseType" />
    </div>
</template>
<script>
    import axios from "axios";

    export default {
        data() {
            return {
                response: "",
                hasResponse: false,
                isLoading: false,
                responseType: 'success',
            };
        },
        methods: {
            async becomeMember() {
                this.isLoading = true;

                try{
                    let response = await axios.post("/api/become-writter");
                    this.responseType = "success";
                    this.response = response.data.message;
                } catch(error) {
                    this.responseType = "error";
                    this.response = "Something went wrong, please try again later";
                }

                this.isLoading = false;
                this.hasResponse = true;
            }
        }
    }
</script>
