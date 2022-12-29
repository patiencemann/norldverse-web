<template>
    <div id="w-node-_50a8a0ce-14cc-e732-021c-a2cc147308a1-fdadf31b" class="text-size-xsmall text-color-primary-2 text-style-allcaps">
        {{ timeToRead }} minute read
    </div>
</template>

<script>
  function readingTime(text) {
    const wpm = 225
    const words = text.trim().split(/\s+/).length
    return Math.ceil(words / wpm)
  }

  export default {
    data() {
      return {
        timeToRead: undefined,
      }
    },
    props: {
      text: {
        type: String,
        required: true,
      },
    },
    mounted() {
      this.timeToRead = readingTime(this.text)
    },
  }
</script>
