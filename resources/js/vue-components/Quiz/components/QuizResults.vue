<template>
  <div>
    <h1>Thanks, {{ userName }}!</h1>
    <button class="btn btn-primary" @click="onBackToSTartClicked()">Back to Start</button>
  </div>
</template>

<script>
export default {
  props: {
    userName: {
      type: String,
      required: true,
    },
  },
  methods: {
    onBackToSTartClicked() {
      this.$emit('quiz-finished');
    },
  },
}
</script>

<style scoped>

</style>