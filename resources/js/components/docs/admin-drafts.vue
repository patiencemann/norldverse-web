<template>
    <div>
        <h2 class="text-2xl font-bold mb-4">Your docs from drafts</h2>
        <div v-if="isLoading">
            <loader />
        </div>
        <alert :hasResponse="hasResponse" :response="response" :responseType="responseType" />

        <div class="loop-wrap">
            <div v-if="isLoading">
                <public-card-skeleton />
            </div>

            <article class="item is-loop is-image" v-for="(doc, index) in docs" :key="doc['title']+ Math.random().toString(16).slice(2)">
                <div class="item-image global-image global-image-orientation global-radius is-landscape">
                    <a class="global-link" :aria-label="doc['title']"></a>
                    <img :src="doc['image']" loading="lazy" :alt="doc['title']"
                        :srcset="doc['image']+' 300w,'+ doc['image']+' 600w,'+ doc['image']+' 1200w'"
                        sizes="(max-width:480px) 300px, (max-width:768px) 600px, 1200px">
                </div>
                <div class="item-content">
                    <div class="item-tags global-tags">
                        <span>
                            <a href="">
                                <read-time :text="doc['contents']" />
                            </a>
                            <a :href="'/write-doc?draft='+index">Continue</a>
                            <a @click="deleteDoc(index)" class="cursor-pointer">remove</a>
                        </span>
                    </div>
                    <h2 class="item-title"><a>{{ doc['title'] }}</a></h2>
                    <p class="item-excerpt">{{ doc['caption'] }}</p>
                </div>
            </article>

        </div>
    </div>
</template>

<script>
    import Loader from '../common/loader.vue';

    export default {
        data() {
            return {
                isLoading: false,
                docs: [],
                response: '',
                hasResponse: false,
                responseType: 'success'
            }
        },
        components: {
            Loader
        },
        methods: {
            async getDocs() {
                this.isLoading = true;

                const user = document.querySelector("meta[name='user']").getAttribute("content");
                const authUser = JSON.parse(user);
                const key = "patienceman_&_"+authUser.email+"_drafts";
                const myDrafts = localStorage.getItem(key);

                if(myDrafts) {
                    this.docs = JSON.parse(myDrafts)
                }

                this.isLoading = false;
            },
            async deleteDoc(docId) {
                try{
                    this.isLoading = true;

                    const user = document.querySelector("meta[name='user']").getAttribute("content");
                    const authUser = JSON.parse(user);
                    const key = "patienceman_&_"+authUser.email+"_drafts";
                    const myDrafts = JSON.parse(localStorage.getItem(key));

                    delete myDrafts[docId];

                    localStorage.removeItem(key);
                    localStorage.setItem(key, JSON.stringify(myDrafts));

                    this.responseType = 'success';
                    this.response = "item deleted";

                    this.getDocs();
                }catch(error){
                    this.response = "something went wrong";
                    this.responseType = 'error';
                }

                this.isLoading = false;
                this.hasResponse = true;
            }
        },
        beforeMount() {
            this.getDocs()
        }
    }
</script>
