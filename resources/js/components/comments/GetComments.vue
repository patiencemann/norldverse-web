    <template>
        <div class="comment-wrapper mt-3">
            <div v-if="isLoading">
                <comment-skeleton />
            </div>
            <div class="p-6 mb-6 text-base border-t shadow-md border-gray-200 dark:border-gray-700 dark:bg-gray-700 rounded" v-for="comment in comments" :key="comment.id">
                <div class="flex justify-between items-center mb-2 dark:bg-gray-700">
                    <div class="flex items-center">
                        <div class="flex items-center">
                            <p class="inline-flex items-center mr-3 text-md font-anek font-bold text-gray-900  dark:text-white">
                                <img class="mr-2 w-6 h-6 rounded-full" :src="comment.user.avatar" :alt="comment.user.name">
                                {{ comment.user.name }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 font-anek">
                                <time pubdate :datetime="comment.created_at" :title="comment.created_at">{{ comment.created_at }}</time>
                            </p>
                        </div>
                    </div>

                    <button id="dropdownComment3Button" data-dropdown-toggle="dropdownComment3" class="inline-flex font-anek items-center p-2 text-sm font-medium text-center text-gray-400 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-gray-900 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                        </svg>
                        <span class="sr-only">Comment settings</span>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="dropdownComment3" class="hidden z-10 w-36 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200 font-anek" aria-labelledby="dropdownMenuIconHorizontalButton">
                            <li>
                                <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Report</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <p class="text-gray-500 dark:text-gray-400 dark:bg-gray-700 font-anek">{{ comment.message }}</p>
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
