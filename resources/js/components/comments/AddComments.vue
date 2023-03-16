    <template>
        <div class="d-flex">
            <div class="auth-user">
                <div id="tooltip-jese" role="tooltip" class="font-anek inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
                <div class="w-20 h-20 rounded-full"><img data-tooltip-target="tooltip-jese" class="w-full h-full rounded-full" :src="avatar" alt="PatienceMan"></div>
            </div>
            <form class="mb-6 w-full ml-3 ">
                <div class="bg-gray-50 py-2 px-4 mb-4 rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <label for="comment" class="sr-only font-anek">Your comment</label>
                    <textarea id="comment" v-model="comments" rows="6" style="font-size: 17px; line-height: 22px" class="bg-gray-50 px-0 w-full text-base font-anek text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800 pt-3" placeholder="Write a comment..." required></textarea>
                </div>
                <button type="button" style="font-size: 16px !important;" @click="createComment()" class="p-4 inline-flex font-anek items-center py-2.5 px-4 text-sm font-bold text-center text-white bg-green-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Post comment
                </button>
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
                    try{
                        this.isLoading = true;
                        let response = await axios.post(`/api/comments/${this.doc}`, { message: this.comments });
                        this.isLoading = false;

                        this.hasResponse = true;
                        this.response = response.data.message;
                        this.responseType = 'success';

                        this.comments = '';
                        this.$root.$emit("docComments");
                    }catch(error){
                        this.response = "something went wrong";
                        this.responseType = 'error';
                    }
                },
            }
        }
    </script>
