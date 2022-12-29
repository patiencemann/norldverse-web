<template>
    <div class="mb-6 mt-2">
        <input
            type="text"
            class="bg-gray-100 border border-none text-gray-900 text-md rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            @input="$emit('update', $event.target.value)"
            v-on="$listeners"
            :value="value"
        />
    </div>
</template>

<script>
export default {
    inheritAttrs: false,
    props: ["value"],
    model: {
        prop: "value",
        event: "update",
    },
};
</script>
