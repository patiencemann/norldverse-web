<template>
    <div id="slide-wrapper">
        <div class="featured-section">
            <div class="global-padding">
              <div class="featured-subtitle global-subtitle">
                <small class="global-subtitle-title">Explore more related <span>best stories</span></small>
              </div>
              <div class="featured-wrap flickity-enabled is-draggable" tabindex="0">
                <div class="flickity-viewport" style="height: 468.93px; touch-action: pan-y">
                  <div class="flickity-slider" style="left: 0px; transform: translateX(0%)">
                    <vue-horizontal-list :items="items" :options="options">
                        <template v-slot:nav-prev>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                            </svg>
                        </template>

                        <template v-slot:nav-next>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                            </svg>
                        </template>

                        <template v-slot:default="{ item }">
                            <div class="item" style="height: 400px">
                                <div class="item-card is-loop is-small is-image is-selected" style="position: absolute;left: 0px;transform: translateX(0%);">
                                    <div class="item-image global-image global-image-orientation global-radius is-landscape">
                                        <a :href="'/docs/'+item.slug" class="global-link" :aria-label="item.title"></a>

                                        <img :src="item.media.file_url" loading="lazy" :alt="item.title"
                                            :srcset="item.media.file_url+' 300w,'+ item.media.file_url+' 600w,'+ item.media.file_url+' 1200w'"
                                            sizes="(max-width:480px) 300px, (max-width:768px) 600px, 1200px">

                                        <div class="item-authors global-authors">
                                            <div>
                                                <div class="item-author global-item-author is-image global-image" v-for="comment in item.comments.slice(0, 4)" :key="comment.id">
                                                    <a class="global-link" :title="comment.user.name"></a>
                                                    <img :src="comment.user.avatar" loading="lazy" :alt="comment.user.name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        <div class="item-tags global-tags">
                                            <span><a v-for="topic in item.topics.topics.slice(0, 2)" :key="topic">{{ topic }}</a></span>
                                        </div>
                                        <h2 class="item-title">
                                            <a :href="'/docs/'+item.slug">
                                               {{ item.title }}
                                            </a>
                                        </h2>
                                        <p class="item-excerpt">{{ item.caption }}</p>
                                    </div>
                                </div>
                            </div>
                        </template>
                      </vue-horizontal-list>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
  </template>

  <script>
    import VueHorizontalList from 'vue-horizontal-list';

    export default {
        props: {
            story_id: String,
        },
        components: {
            VueHorizontalList
        },
        data() {
            return {
                options: {
                    responsive: [
                        {end: 576, size: 1},
                        {start: 576, end: 768, size: 2},
                        {start: 768, end: 992, size: 3},
                        {size: 4}
                    ],
                    list: {
                        windowed: 1200,
                        padding: 24
                    }
                },
                items: []
            }
        },
        methods: {
            async getRelatedDocs(docId) {
                this.isLoading = true;
                this.items = [];
                let response = await axios.get(`/api/public/related/docs/${docId}`);
                this.isLoading = false;
                this.items = response.data.data
            },
        },
        mounted() {
            this.getRelatedDocs(this.story_id);
        }
    };
  </script>

  <style>
    #slide-wrapper {
        max-width: 1400px;
        margin-left: auto;
        margin-right: auto;
        padding: 80px 24px;
    }

    @media (min-width: 1200px) {
      #slide-wrapper {
        padding-left: 80px;
        padding-right: 80px;
      }
    }
  </style>
