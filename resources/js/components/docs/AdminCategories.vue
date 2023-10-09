<template>
    <div class="">
        <form>
            <label for="default-search" class="mb-2 text-md font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <input type="text" v-model="category" class="block font-calistoga font-medium w-full p-4 pl-10 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 text-[18px]" placeholder="Custom Category" required>
                <button @click="submitCategory" type="button" class="text-white absolute font-calistoga right-2.5 bottom-3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">create</button>
            </div>
        </form>

        <div class="relative overflow-x-auto shadow-sm rounded-lg sm:rounded-lg mt-5">
            <table class="w-full text-md font-calistoga rounded-lg text-left text-gray-500 dark:text-gray-400">
                <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Category name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Created At
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in categories" :key="category.id" class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ category.name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ category.created_at }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">remove</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <alert :hasResponse="hasResponse" :response="response" :responseType="responseType" />
    </div>
</template>
<script>
export default {
    data() {
        return {
            category: '',
            categories: [],
            response: "",
            hasResponse: false,
            isLoading: false,
            responseType: 'success',
            preview: '',
            metaUser: document.querySelector("meta[name='user']").getAttribute("content"),
            authUser: null
        };
    },
    methods: {
        async submitCategory() {
            this.isLoading = true;

            try{
                let formData = new FormData;
                    formData.append('name', this.category);

                let response = await axios.post("/api/docs/categories", formData);

                this.responseType = "success";
                this.response = response.data.message;
                this.getAllCategories();
            } catch(error) {
                this.responseType = "error";
                this.response = error.response.data.message;
            }

            this.isLoading = false;
            this.hasResponse = true;
        },

        async getAllCategories() {
            this.isLoading = true;
            this.categories = [];
            let response = await axios.get(`/api/public/categories`);
            this.isLoading = false;
            this.categories = response.data.data
        }
    },
    mounted() {
        this.getAllCategories();
    }
}
</script>
