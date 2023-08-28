<template>
    <div class="w-full">
        <div v-if="loading" class="loader">
            <div>
                <span class="inline-flex items-center gap-px">
                    <span class="animate-blink mx-px h-5 w-5 rounded-full bg-indigo-600"></span>
                    <span class="animate-blink animation-delay-200 mx-px h-5 w-5 rounded-full bg-indigo-600"></span>
                    <span class="animate-blink animation-delay-[400ms] mx-px h-5 w-5 rounded-full bg-indigo-600"></span>
                </span>
            </div>
        </div>
        <img v-lazy="imageUrl" :src="imageUrl" loading="lazy" :alt="alt"
            :srcset="imageUrl+' 300w,'+ imageUrl+' 600w,'+ imageUrl+' 1200w'"
            sizes="(max-width:480px) 300px, (max-width:768px) 600px, 1200px"
            @load="onImageLoad" v-show="!loading">
    </div>
</template>

<script>
    export default {
        props: ['imageUrl', 'alt'],
        data() {
            return {
                loading: true,
            };
        },
        methods: {
            onImageLoad() {
                this.loading = false;
            },
        },
    };
</script>

<style scoped>
    .loader {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 200px; /* Adjust height as needed */
        background-color: #f0f0f0;
    }
</style>
