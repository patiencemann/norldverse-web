    <template>
        <div>
            <div class="comments-section relative bg-gray-100 dark:bg-deep-green-900 mt-5" v-if="comments.length > 0">
                <div v-if="isLoading">
                    <comment-skeleton />
                </div>

                <div class="d-flex flex-start mb-4" v-for="comment in comments" :key="comment.id">
                    <div class="mr-3">
                        <img :data-popover-target="'popover-user-profile-for-'+comment.user.id" class="ring-2 ring-gray-300 dark:ring-gray-500 rounded-circle shadow-1-strong me-3 h-20 w-20" :src="comment.user.avatar" :alt="comment.user.name">
                    </div>

                    <div data-popover :id="'popover-user-profile-for-'+comment.user.id" role="tooltip" class="absolute z-10 invisible inline-block w-80 text-sm text-gray-500 transition-opacity duration-300 border border-gray-200 bg-gray-50 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:bg-deep-green-800 dark:border-gray-600">
                        <div class="p-3">
                            <div class="flex items-center justify-between mb-2">
                                <a href="#"> <img class="h-20 w-20 rounded-full" :src="comment.user.avatar" :alt="comment.user.name"> </a>
                            </div>
                            <p class="text-base font-semibold leading-none text-gray-900 dark:text-white mt-4">
                                <a href="#" class="dark:text-[#E8E8ED] font-anek" style="font-size: 20px">{{comment.user.name}}</a>
                            </p>
                            <p class="mb-3 text-sm font-normal mt-2">
                                <a href="#" class="hover:underline dark:text-[#E8E8ED] font-anek" style="font-size: 16px">{{comment.user.email}}</a>
                            </p>
                        </div>
                        <div data-popper-arrow></div>
                    </div>

                    <div class="card bg-gray-50 w-100 dark:bg-deep-green-700 border-1 border-gray-300 dark:border-gray-200" style="border: 1px solid #dbe0e4">
                        <div class="card-body p-4">
                            <div class="">
                                <div class="comment-title">
                                    <h5 class="dark:text-[#E8E8ED]">{{ comment.user.name }}</h5>
                                    <span>{{comment.created_at}}</span>
                                </div>
                                <p class="dark:text-[#E8E8ED]">{{ comment.message }}</p>
                            </div>
                        </div>
                    </div>
                </div>
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
                    isLoading: false,
                }
            },
            methods: {
                async getDocComments() {
                    this.isLoading = true;
                    let response = await axios.get(`/api/comments/${this.doc}`);
                    this.isLoading = false;

                    this.comments = response.data.data;
                }
            },
            mounted() {
                this.$root.$on('docComments', () => {
                    this.getDocComments();
                });

                this.getDocComments();
            }
        }
    </script>
