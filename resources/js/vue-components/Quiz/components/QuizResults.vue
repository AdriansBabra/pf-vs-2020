<template>
  <div class="container title center">
    <h1>Thanks, {{ userName }}!</h1>
      <div v-if="isLoading">
          Fetching results..
      </div>
      <div class="container result center text" v-else>
      You answered correctly to {{ correctAnswerCount }} out of {{ totalQuestionCount }}
      </div>
  <div class="container center">
    <button class="horizontal" :disabled="isLoading" @click="onBackToSTartClicked()"><span class="text">Back to Start</span></button>
  </div>
  </div>
</template>

<script>
import Axios from "axios";
import {QuestionStructure} from "../quiz-structures";

export default {
  props: {
    userName: {
      type: String,
      required: true,
    },
  },
    data: () => ({
        isLoading: true,
        correctAnswerCount: null,
        totalQuestionCount: null,
    }),
    created() {
      this.getResults();
    },
  methods: {
      async getResults() {
          const formData = new FormData();
          formData.append('csrf', window.csrf);

          this.isLoading = true;
          await Axios.post('/quiz-rpc/get-results', formData).then((response) => {
                this.correctAnswerCount = response.data.correctAnswerCount;
                this.totalQuestionCount = response.data.totalQuestionCount;
          }).finally(() => {
              this.isLoading = false;
          });
      },
    onBackToSTartClicked() {
          if (this.isLoading) {
              return;
          }

      this.$emit('quiz-finished');
    },
  },
}
</script>

<style scoped>

</style>