    <template>
        <div class="d-flex mt-3">
            <div class="auth-user">
                <div id="tooltip-jese" role="tooltip" class="font-anek inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <div class="w-20 h-20 rounded-full"><img data-tooltip-target="tooltip-jese" class="ring-4 ring-gray-50 dark:ring-gray-500 w-full h-full rounded-full" :src="avatar" alt="Norldverse"></div>
            </div>
            <form class="mb-3 w-full ml-7">
                <div class="relative px-2 py-2 rounded-xl bg-gray-50 dark:bg-deep-green-900 border border-[#dbe0e4] dark:border-none">
                    <div class="bg-gray-50 py-2 px-4 mb-4 rounded-lg dark:bg-deep-green-900" style="with: 100%">
                        <label for="comment" class="sr-only font-anek">Your comment</label>
                        <textarea id="comment" v-model="comments" @keypress.enter.prevent="createComment()" rows="1" style="font-size: 17px; line-height: 22px; width: 100%" class="bg-gray-50 px-0 w-full text-base font-anek font-bold leading-9 text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-deep-green-900 pt-3" placeholder="Write your comment..." required></textarea>
                    </div>
                    <div class="absolute right-3 top-6">
                        <button type="button" style="font-size: 16px !important;" :disabled="isLoading" @click="createComment()" class="disabled:opacity-75 shadow-sm relative p-4 h-22 w-22 inline-flex font-anek items-center justify-center py-2.5 px-4 text-sm font-bold text-center text-white bg-deep-green-700 rounded-circle focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-deep-green-800 border border-[#dbe0e4] dark:border-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                            </svg>
                            <svg v-if="isLoading" aria-hidden="true" role="status" class="absolute top-3 right-0 left-24 bottom-0 mr-2 inline h-10 w-10 animate-spin text-indigo-400" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"></path>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#FFF"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <alert :hasResponse="hasResponse" :response="response" :responseType="responseType" />
            </form>
        </div>
    </template>
    <script>
        export default {
            props: {
                avatar: String,
                doc: String
            },
            data() {
                return {
                    comments: '',
                    response: '',
                    isLoading: false,
                    hasResponse: false,
                    responseType: 'success'
                }
            },
            methods: {
                async createComment() {
                    if(this.comments == ""){
                        this.hasResponse = true;
                        this.response = "Write your message";
                        this.responseType = 'error';
                    }else{
                        this.isLoading = true;

                        try{
                            let response = await axios.post(`/api/comments/${this.doc}`, { message: this.comments });

                            this.hasResponse = true;
                            this.response = response.data.message;
                            this.responseType = 'success';

                            this.comments = '';
                            this.$root.$emit("docComments");
                        }catch(error){
                            this.response = "something went wrong";
                            this.responseType = 'error';
                        }

                        this.isLoading = false;
                    }
                },
            }
        }
    </script>
