<template>
    <div class="-m-2 text-center">
        <div class="p-5" v-if="hasResponse">
            <div class="inline-flex items-center bg-white leading-none text-green-600 rounded-full p-2 shadow text-teal text-sm" >
                <span class="inline-flex bg-green-600 text-white rounded-full py-2.5 px-3 justify-center items-center text-center">green</span>
                <span class="inline-flex px-2 font-bold text-md" v-text="response">

                </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            hasResponse: Boolean,
            response: String,
            responseType: String
        },
    }
</script>
