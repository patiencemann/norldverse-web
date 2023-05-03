<template>
    <div class="title-tags">
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
    </div>
</template>
<script>
import axios from "axios";

export default {
    name: "global-tags",
    data() {
        return {
            tags: [],
            search: ''
        };
    },
    methods: {
        async getTags() {
            this.isLoading = true;
            let response = await axios.get("/api/public/doc-tags");
            this.isLoading = false;
            this.tags = response.data.tags;
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
