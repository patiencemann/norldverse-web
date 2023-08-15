<template>
    <a @click="openProfile" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white font-calistoga">Profile</a>
</template>
<script>
    export default {
        methods: {
            openProfile() {
                this.$root.$emit('open');
            }
        }
    }
</script>
