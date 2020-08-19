<template>
<div>
  <h1>Questions!</h1>
  <button class="btn btn-primary" @click="onNextClicked()">Next</button>
</div>
</template>

<script>
export default {
  methods: {
    onNextClicked() {
      //TODO: implement
      this.lastQuestionSubmitted();
    },
    lastQuestionSubmitted() {
      this.$emit('last-question-submitted');
    }
  },
}
</script>

<style scoped>

</style>