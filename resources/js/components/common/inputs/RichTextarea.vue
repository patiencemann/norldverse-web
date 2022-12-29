<template>
    <div class="mb-6 mt-3">
        <textarea
            id="tinymce"
            rows="4"
            class="block p-4 w-full text-md text-gray-900 bg-gray-100 rounded-lg border border-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            @input="$emit('update', $event.target.value)"
            v-on="$listeners"
            :value="value"
        ></textarea>
    </div>
</template>

<script>
    export default {
        props: ["value"],
        inheritAttrs: false,
        model: {
            prop: "value",
            event: "update",
        },
        mounted() {
            tinymce.init({
                selector: 'textarea#tinymce',
                height: 700,
                menubar: true,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount', 'image'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        }
    };
</script>
