<template>
    <div class="relative w-[400px] flex flex-row items-center bg-white border pl-10 p-2.5 border-gray-200 rounded-[9999px] dark:bg-gray-700 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 ">
        <div class="flex absolute left-1 items-center pl-3 pointer-events-none text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </div>
        <div class="w-full ml-12">
            <input v-model="search" @keyup="searchDoc" type="search" class="search-doc-input w-full text-gray-900 border-none placeholder-gray-400 dark:placeholder-gray-900 font-bold dark:text-white focus:border-none outline-none focus:outline-none" placeholder="Search blogs" autocomplete="off">
        </div>
    </div>
</template>
<script>
export default {
    name: "search-bar",
    data() {
        return {
            search: '',
            isLoading: false
        };
    },
    methods: {
        searchDoc() {
            this.$root.$emit("searchDoc", this.search);
        }
    },
};
</script>
