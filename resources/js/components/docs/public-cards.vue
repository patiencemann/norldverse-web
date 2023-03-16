<template>
    <div class="loop-wrap">
        <div v-if="isLoading">
            <public-card-skeleton />
        </div>

        <article class="item is-loop is-image" v-for="doc in docs" :key="doc.id">
            <div class="item-image global-image global-image-orientation global-radius is-landscape">
                <a :href="'/docs/'+doc.id" class="global-link" :aria-label="doc.title"></a>
                <img :src="doc.media.file_url" loading="lazy" :alt="doc.title"
                    :srcset="doc.media.file_url+' 300w,'+ doc.media.file_url+' 600w,'+ doc.media.file_url+' 1200w'"
                    sizes="(max-width:480px) 300px, (max-width:768px) 600px, 1200px">
                <div class="item-authors global-authors">
                    <div>=
                        <div class="item-author global-item-author is-image global-image" v-for="comment in doc.comments.slice(0, 4)" :key="comment.id">
                            <a href="/author/nichole/" class="global-link" :title="comment.user.name"></a>
                            <img :src="comment.user.avatar" loading="lazy" :alt="comment.user.name">
                        </div>
                    </div>
                </div>
            </div>
            <div class="item-content">
                <div class="item-tags global-tags">
                    <a href="/tag/lifestyle/">Lifestyle</a>
                    <span>
                        <a href="/tag/people/">People</a>
                        <a href="/tag/review/">Review</a>
                        <a href="">
                            <read-time :text="doc.contents" />
                        </a>
                    </span>
                </div>
                <h2 class="item-title"><a :href="'/docs/'+doc.id">{{ doc.title }}</a></h2>
                <p class="item-excerpt">{{ doc.caption }}</p>
            </div>
        </article>

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
            async getDocs() {
                this.isLoading = true;
                let response = await axios.get('/api/public/docs');

                this.isLoading = false;
                this.docs = response.data.data
            }
        },
        beforeMount() {
            this.getDocs()
        }
    }
</script>
