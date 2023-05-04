<template>
    <div class="title-tags ml-5">
        <span>
            <a @click="findByTag('all')" class="dark:bg-deep-green-800 dark:text-gray-200 dark:hover:text-gray-900">All</a>
            <div class="search-box">
                <input type="text" class="dark:bg-deep-green-800 dark:text-gray-200" placeholder="  Search Everything..." v-model="search" @keyup="searchDoc" />
                <button type="reset"></button>
            </div>
            <a v-for="tag in tags" :key="tag" @click="findByTag(tag)" class="dark:bg-deep-green-800 dark:text-gray-200 dark:hover:text-gray-900">
                {{ tag }}
            </a>
        </span>
        <span v-if="isLoading" class="bg-gray-50 rounded-lg shadow-sm flex items-center justify-center mr-3" style="border: 1px solid #dbe0e4">
            <process-loader size="w-10 h-10"></process-loader>
        </span>
    </div>
</template>
<script>
import axios from "axios";

export default {
    name: "global-tags",
    data() {
        return {
            tags: [],
            search: '',
            isLoading: false
        };
    },
    methods: {
        async getTags() {
            this.isLoading = true;
            let response = await axios.get("/api/public/doc-tags");
            this.tags = response.data.tags;
            this.isLoading = false;
        },
        findByTag(tag) {
            this.$root.$emit("loadedDoc", tag);
        },
        searchDoc() {
            this.$root.$emit("searchDoc", this.search);
        }
    },
    mounted() {
        this.getTags();
    },
};
</script>
