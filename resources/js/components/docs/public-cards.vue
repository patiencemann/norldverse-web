<template>
    <div>
        <div v-if="isLoading" class="mb-5">
            <public-card-skeleton />
        </div>
        <div class="loop-wrap">
            <article class="item is-loop is-image" v-for="doc in docs" :key="doc.id">
                <div class="item-image global-image global-image-orientation global-radius is-landscape">
                    <a :href="'/docs/'+doc.slug" class="global-link" :aria-label="doc.title"></a>
                    <img :src="doc.media.file_url" loading="lazy" :alt="doc.title"
                        :srcset="doc.media.file_url+' 300w,'+ doc.media.file_url+' 600w,'+ doc.media.file_url+' 1200w'"
                        sizes="(max-width:480px) 300px, (max-width:768px) 600px, 1200px">
                    <div class="item-authors global-authors">
                        <div>
                            <div class="item-author global-item-author is-image global-image" v-for="comment in doc.comments.slice(0, 4)" :key="comment.id">
                                <a href="/author/nichole/" class="global-link" :title="comment.user.name"></a>
                                <img :src="comment.user.avatar" loading="lazy" :alt="comment.user.name">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-content">
                    <div class="item-tags global-tags">
                        <span>
                            <a v-for="topic in doc.topics.topics" :key="topic">{{ topic }}</a>

                            <a href="">
                                <read-time :text="doc.contents" />
                            </a>
                        </span>
                    </div>
                    <h2 class="item-title"><a :href="'/docs/'+doc.slug">{{ doc.title }}</a></h2>
                    <p class="item-excerpt">{{ doc.caption }}</p>
                </div>
            </article>
        </div>
    </div>
</template>

<script>
    import Loader from '../common/loader.vue';

    export default {
        name: 'public-cards',
        data() {
            return {
                isLoading: false,
                docs: [],
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
            }
        },
        mounted() {
            this.getDocs('all');
            this.$root.$on('loadedDoc', (tag) =>  this.getDocs(tag));
        }
    }
</script>
