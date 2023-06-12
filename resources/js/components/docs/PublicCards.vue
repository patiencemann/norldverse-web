<template>
    <div>
        <div v-if="isLoading" class="mb-5">
            <public-card-skeleton />
        </div>
        <div class="loop-wrap">
            <article class="item is-loop is-image" v-for="doc in docs" :key="doc.id">
                <div class="item-image global-image global-image-orientation global-radius is-landscape bg-gray-300">
                    <a :href="'/docs/'+doc.slug" class="global-link" :aria-label="doc.title"></a>
                    <img v-lazy="doc.media.file_url" :src="doc.media.file_url" loading="lazy" :alt="doc.title"
                        :srcset="doc.media.file_url+' 300w,'+ doc.media.file_url+' 600w,'+ doc.media.file_url+' 1200w'"
                        sizes="(max-width:480px) 300px, (max-width:768px) 600px, 1200px">

                    <div class="flex items-center justify-center">
                        <div class="item-authors global-authors flex justify-between items-center">
                            <div>
                                <div class="item-author global-item-author is-image global-image" v-for="comment in doc.comments.slice(0, 4)" :key="comment.id">
                                    <a class="global-link" :title="comment.user.name"></a>
                                    <img :src="comment.user.avatar" loading="lazy" :alt="comment.user.name">
                                </div>
                            </div>
                        </div>
                        <div class="absolute flex justify-end right-5 bottom-5" v-if="auth">
                            <button @click="likeDoc(doc.id, 'id-'+doc.id)" :id="'id-'+doc.id" type="button" :class="(doc.iLiked?'bg-blue-600 text-white':'bg-white text-black')+' animate-pulse z-10 hover:bg-blue-200 shadow-sm ring-4 ring-gray-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800'">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                                </svg>
                                <span class="sr-only">Like this</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="item-content">
                    <div class="item-tags global-tags">
                        <span>
                            <a v-for="topic in doc.topics.topics.slice(0, 2)" :key="topic">{{ topic }}</a>

                            <a href="">
                                <read-time :text="doc.contents" />
                            </a>

                            <a data-tooltip-placement="top" data-tooltip-target="tooltip-likes" class="font-anek cursor-pointer font-bold text-gray-500">{{ doc.likes }} likes</a>
                            <div id="tooltip-likes" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                Login in and likes
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </span>
                    </div>
                    <h2 class="item-title" style="margin-top: 1.3rem"><a :href="'/docs/'+doc.slug" class="dark:text-gray-200">{{ doc.title }}</a></h2>
                    <div class="flex items-center space-x-4 mt-4 rounded-[10px] border border-gray-200 py-3 px-4">
                        <img class="w-12 h-12 rounded ring-2 ring-gray-300 dark:ring-gray-500" :src="doc.user.avatar" :alt="doc.user.name+' blog'">
                        <div class="font-medium dark:text-white ml-3">
                            <div class="font-bold leading-5" style="font-size: 15px !important">{{ doc.user.name }}</div>
                            <div class="text-gray-500 font-semibold dark:text-gray-400" style="font-size: 14px !important">{{ doc.created_at }}</div>
                        </div>
                    </div>
                    <p class="item-excerpt text-gray-600 dark:text-gray-200">{{ doc.caption }}</p>
                </div>
            </article>
        </div>
    </div>
</template>

<script>
    import Loader from '../common/loader.vue';

    export default {
        name: 'public-cards',
        props: {
            auth: String
        },
        data() {
            return {
                isLoading: false,
                docs: [],
                docLiked: false,
                timeToRead: 0
            }
        },
        components: {
            Loader
        },
        methods: {
            async getDocs(tag) {
                this.isLoading = true;
                this.docs = [];
                let response = await axios.get(`/api/public/docs?tag=${tag}`);
                this.isLoading = false;
                this.docs = response.data.data
            },
            async searchDoc(query) {
                this.isLoading = true;
                this.docs = [];
                let response = await axios.get(`/api/public/docs?query=${query}`);
                this.isLoading = false;
                this.docs = response.data.data
            },
            async likeDoc(docId, elementId) {
                await axios.post(`/api/docs/like/${docId}`);
                document.getElementById(elementId).classList.remove('bg-white');
                document.getElementById(elementId).classList.add('bg-blue-600');
                document.getElementById(elementId).classList.add('text-white');
            }
        },
        mounted() {
            this.getDocs('all');
            this.$root.$on('loadedDoc', (tag) =>  this.getDocs(tag));
            this.$root.$on('searchDoc', (query) =>  this.searchDoc(query));
        }
    }
</script>
