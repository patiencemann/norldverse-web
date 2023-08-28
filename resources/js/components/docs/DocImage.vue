<template>
    <div class="w-full">
        <div v-if="loading" class="loader">
            <div class="spinner-block">
                <div style="--i: 1"></div>
                <div style="--i: 2"></div>
                <div style="--i: 3"></div>
                <div style="--i: 4"></div>
            </div>
        </div>
        <img v-lazy="imageUrl" :src="imageUrl" loading="lazy" :alt="alt"
            :srcset="imageUrl+' 300w,'+ imageUrl+' 600w,'+ imageUrl+' 1200w'"
            sizes="(max-width:480px) 300px, (max-width:768px) 600px, 1200px"
            @load="onImageLoad">
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
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 200px; /* Adjust height as needed */
        background-color: #000;
        opacity: 0.6;
    }

    .spinner-block {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        background: white;
        margin-top: 30px !important;
    }

    .spinner-block::before {
        content: "";
        background: rgba(255, 255, 255, 0);
        backdrop-filter: blur(8px);
        position: absolute;
        width: 140px;
        height: 55px;
        z-index: 20;
        border-radius: 0 0 10px 10px;
        border: 1px solid rgba(255, 255, 255, 0.274);
        border-top: none;
        box-shadow: 0 15px 20px rgba(0, 0, 0, 0.082);
        animation: anim2 2s infinite;
    }

    .spinner-block div {
        background: rgb(228, 228, 228);
        border-radius: 50%;
        width: 20px;
        height: 20px;
        z-index: -1;
        animation: anim 2s infinite linear;
        animation-delay: calc(-0.3s * var(--i));
        transform: translateY(5px);
        margin: 0.2em;
    }

    @keyframes anim {
        0%,
        100% {
        transform: translateY(5px);
        }
        50% {
        transform: translateY(-65px);
        }
    }

    @keyframes anim2 {
        0%,
        100% {
        transform: rotate(-10deg);
        }
        50% {
        transform: rotate(10deg);
        }
    }

</style>
