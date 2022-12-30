<template>
    <div class="doc-wrapper">
        <div v-if="isLoading">
            <public-card-skeleton />
        </div>
        <div role="list" class="grid-halves posts w-dyn-items">
            <div role="listitem" class="w-dyn-item" v-for="doc in docs" :key="doc.id">
                <a :href="'/docs/'+doc.id" class="post-item w-inline-block">
                    <img :src="doc.media.file_url" loading="lazy" :alt="doc.title" class="post-item-thumb margin-24" />
                    <div>
                        <div class="post-item-data margin-16">
                            <div class="post-item-date">
                                <div id="w-node-_50a8a0ce-14cc-e732-021c-a2cc147308a0-fdadf31b"
                                    class="text-size-xsmall text-color-primary-2 text-style-allcaps">
                                    {{ doc.created_at }}
                                </div>
                            </div>
                            <read-time :text="doc.contents" />
                        </div>
                        <h2 class="heading-xsmall margin-16">{{ doc.title }}</h2>
                        <p class="text-size-xlarge card-caption">{{ doc.caption }}</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</template>

<style>
    .card-caption {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<script>
    import Loader from '../common/loader.vue';

    export default {
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
