    <template>
        <div>
            <div class="comments-section mt-5" v-if="comments.length < 0">
                <div v-if="isLoading">
                    <comment-skeleton />
                </div>

                <div class="d-flex flex-start mb-4" v-for="comment in comments" :key="comment.id">
                    <div class="mr-3">
                        <img class="rounded-circle shadow-1-strong me-3 h-20 w-20" :src="comment.user.avatar" :alt="comment.user.name">
                    </div>
                    <div class="card w-100">
                        <div class="card-body p-4">
                        <div class="">
                            <div class="comment-title">
                            <h5>{{ comment.user.name }}</h5>
                            <span>{{comment.created_at}}</span>
                            </div>
                            <p>{{ comment.message }}</p>
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
