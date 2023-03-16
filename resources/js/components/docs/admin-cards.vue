<template>
    <div>
        <h2 class="text-2xl font-bold mb-4">Your docs in one place</h2>
        <div v-if="isLoading">
            <loader />
        </div>
        <alert :hasResponse="hasResponse" :response="response" :responseType="responseType" />

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
                </div>
                <div class="item-content">
                    <div class="item-tags global-tags">
                        <span>
                            <a href="/tag/people/">Number {{doc.id}}</a>
                            <a :href="'/docs/'+doc.id" class="bg-indigo-200">Visit </a>
                            <a href="">
                                <read-time :text="doc.contents" />
                            </a>
                            <a :href="'/update-docs/'+doc.id">Update</a>
                            <a @click="deleteDoc(doc.id)" class="cursor-pointer">Delete</a>
                        </span>
                    </div>
                    <h2 class="item-title"><a :href="'/docs/'+doc.id">{{ doc.title }}</a></h2>
                    <p class="item-excerpt">{{ doc.caption }}</p>
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
                let response = await axios.get('/api/docs');

                this.isLoading = false;
                this.docs = response.data.data
            },
            async deleteDoc(docId) {
                try{
                    this.isLoading = true;
                    let response = await axios.delete(`/api/docs/${docId}`);

                    this.responseType = 'success';
                    this.response = response.data.message;

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
