<template>
  <div>
    <select class="form-control">
        <option v-for="quiz in quizzes" :value="quiz.id">
            {{quiz.name}}
        </option>
    </select>
    <br/>
    <button class="btn btn-danger" @click="onStartClicked()">Start</button>
  </div>
</template>

<script>
import Axios from 'axios';
import {QuizStructure} from "../quiz-structures";

export default {
  props:{},
    data: () => ({
        /** @type {Array.<QuizStructure>} */
       quizzes: [],
    }),
    created() {
      this.loadQuizzes();
    },
  methods: {
      loadQuizzes() {
          const formData = new FormData();
          formData.append('csrf', window.csrf);

          Axios.post('/quiz-rpc/get-all', formData).then((response) => {
              this.quizzes = response.data.quizData.map(quizDatum => new QuizStructure(quizDatum));

          }).finally(() => {
          });
      },
    onStartClicked() {
      this.$emit('start-clicked');
    },
  },
}
</script>

