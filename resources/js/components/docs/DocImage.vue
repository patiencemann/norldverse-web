<template>
    <div class="w-full">
        <div v-if="loading" class="imageload-wrapper">
            <div class="loader-pos"><span class="image-loader"></span></div>
        </div>

        <img
            v-lazy="imageUrl"
            :src="imageUrl"
            loading="lazy"
            :alt="alt"
            :srcset="imageUrl + ' 300w,' + imageUrl + ' 600w,' + imageUrl + ' 1200w'"
            sizes="(max-width:480px) 300px, (max-width:768px) 600px, 1200px"
            @load="onImageLoad"
        />
    </div>
</template>

<script>
export default {
    props: ["imageUrl", "alt"],
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
.imageload-wrapper {
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 200px; /* Adjust height as needed */
    background-color: #000;
    opacity: 0.6;
}

.loader-pos {
    position: absolute;
    top: 50%;
    left: 40%;
    transform: translate(-50%, -50%);
}

.image-loader {
    width: 8px;
    height: 40px;
    display: inline-block;
    position: relative;
    border-radius: 4px;
    box-sizing: border-box;
    animation: animloader 1s linear infinite alternate;
}

@keyframes animloader {
    0% {
        box-shadow: 20px 0 rgba(255, 255, 255, 0), 40px 0 rgba(255, 255, 255, 0),
            60px 0 rgba(255, 255, 255, 0), 80px 0 rgba(255, 255, 255, 0),
            100px 0 rgba(255, 255, 255, 0);
    }
    20% {
        box-shadow: 20px 0 white, 40px 0 rgba(255, 255, 255, 0),
            60px 0 rgba(255, 255, 255, 0), 80px 0 rgba(255, 255, 255, 0),
            100px 0 rgba(255, 255, 255, 0);
    }
    40% {
        box-shadow: 20px 0 white, 40px 0 white, 60px 0 rgba(255, 255, 255, 0),
            80px 0 rgba(255, 255, 255, 0), 100px 0 rgba(255, 255, 255, 0);
    }
    60% {
        box-shadow: 20px 0 white, 40px 0 white, 60px 0 white,
            80px 0 rgba(255, 255, 255, 0), 100px 0 rgba(255, 255, 255, 0);
    }
    80% {
        box-shadow: 20px 0 white, 40px 0 white, 60px 0 white, 80px 0 white,
            100px 0 rgba(255, 255, 255, 0);
    }
    100% {
        box-shadow: 20px 0 white, 40px 0 white, 60px 0 white, 80px 0 white,
            100px 0 white;
    }
}
</style>
