<template>
    <div class="title-tags ml-5">
        <span class="font-semibold">
            <a @click="findByTag('all')" class="dark:bg-[#1e293b] dark:text-gray-200 dark:ring-1 dark:ring-[#1e293b] hover:text-[#00bfff]">All</a>
            <a v-for="tag in tags" :key="tag" @click="findByTag(tag)" class="dark:bg-[#1e293b] dark:text-gray-200 dark:ring-1 dark:ring-[#1e293b] hover:text-[#00bfff]">
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
    },
    mounted() {
        this.getTags();
    },
};
</script>
