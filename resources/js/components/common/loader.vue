<template>
    <div style="z-index: 999" class="bg-transparent w-full h-full flex flex-col items-center justify-center fixed !top-0 right-0 bottom-0 left-0 backdrop-blur-sm">
        <div class="loader"></div>
        <div class="font-bold mt-3">Processing Request...</div>
    </div>
</template>

<script>
export default {
    name: "Loader",
};
</script>

<style>
@import url("https://fonts.googleapis.com/css?family=Roboto+Mono&display=swap");

.loader {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: inline-block;
    position: relative;
    border: 3px solid;
    border-color: rgb(128 164 154) rgb(128 164 154) transparent transparent;
    box-sizing: border-box;
    animation: rotation 1s linear infinite;
}
.loader::after,
.loader::before {
    content: "";
    box-sizing: border-box;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    margin: auto;
    border: 3px solid;
    border-color: transparent transparent #ff3d00 #ff3d00;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    box-sizing: border-box;
    animation: rotationBack 0.5s linear infinite;
    transform-origin: center center;
}
.loader::before {
    width: 32px;
    height: 32px;
    border-color: rgb(128 164 154) rgb(128 164 154) transparent transparent;
    animation: rotation 1.5s linear infinite;
}

@keyframes rotation {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
@keyframes rotationBack {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(-360deg);
    }
}
</style>
