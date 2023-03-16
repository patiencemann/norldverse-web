<template>
    <div class="mb-4">
        <button style="font-size: 15px" data-popover-target="popover-image-preview" type="button" class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-4 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Preview Image</button>
        <div data-popover id="popover-image-preview" role="tooltip" class="absolute z-10 invisible inline-block w-96 text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
            <img class="h-auto w-full max-w-lg transition-all duration-300 rounded-lg cursor-pointer filter grayscale hover:grayscale-0" :src="preview" alt="Chosen image">
            <div data-popper-arrow></div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['preview'],
    }
</script>
