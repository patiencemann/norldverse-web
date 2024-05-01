    <template>
        <div>
            <div class="comments-section relative bg-gray-100 dark:bg-deep-green-900 mt-3" v-if="comments.length > 0">
                <div v-if="isLoading">
                    <comment-skeleton />
                </div>

                <ol class="relative border-l border-gray-300 dark:border-gray-700">
                    <li class="mb-10 ml-9" v-for="comment in comments" :key="comment.id">
                        <span class="absolute flex items-center justify-center w-20 h-20 bg-blue-100 rounded-circle -left-9 ring-4 ring-gray-200 dark:ring-gray-50 dark:bg-blue-900">
                            <img :alt="comment.user.name" :data-popover-target="'popover-user-profile-for-'+comment.user.id" class="rounded-circle" :src="comment.user.avatar"/>
                        </span>

                        <div data-popover :id="'popover-user-profile-for-'+comment.user.id" role="tooltip" class="absolute z-10 invisible inline-block w-96 text-sm text-gray-500 transition-opacity duration-300 border border-gray-200 bg-gray-50 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:bg-deep-green-800 dark:border-gray-600">
                            <div class="p-3">
                                <div class="flex items-center justify-between mb-2">
                                    <a href="#" class="timeline-item-icon"> <img class="h-20 w-20 rounded-full" :src="comment.user.avatar" :alt="comment.user.name"> </a>
                                </div>
                                <p class="text-base font-semibold leading-none text-gray-900 dark:text-white mt-4">
                                    <a href="#" class="dark:text-[#E8E8ED] font-anek" style="font-size: 20px">{{ comment.user.name }}</a>
                                </p>
                                <p class="mb-3 text-sm font-normal mt-2">
                                    <a href="#" class="hover:underline dark:text-[#E8E8ED] font-anek" style="font-size: 16px">{{ comment.user.email }}</a>
                                </p>
                                <p class="mb-3 text-sm font-bold mt-2">
                                    <a class="hover:underline dark:text-[#E8E8ED] font-anek" style="font-size: 16px">
                                        {{ comment.user.metaData?.position !== undefined ? comment.user.metaData.position : '' }}
                                    </a>
                                </p>
                            </div>
                            <div data-popper-arrow></div>
                        </div>

                        <div class="card bg-gray-50 w-100 dark:bg-deep-green-700 border-1 border-gray-300 dark:border-gray-200" style="border: 1px solid #dbe0e4">
                            <div class="card-body p-4">
                                <div class="comment-contents">
                                    <div class="comment-title !mb-1">
                                        <h5 class="dark:text-[#E8E8ED]">{{ comment.user.name }}</h5>
                                        <span>commented on {{comment.created_at}}</span>
                                    </div>
                                    <p class="dark:text-[#E8E8ED]" style="font-size: 15px !important; line-height: 23px !important">{{ comment.message }}</p>
                                </div>
                            </div>
                        </div>
                    </li>
                </ol>

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
