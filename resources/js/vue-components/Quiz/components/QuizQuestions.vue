<template>
<div id="app">
    <template v-if="currentQuestion">
        <div class="questionfull text">
        <h2 class="text center">{{ currentQuestion.title }}</h2>
        </div>
        <div class="container center">
            <button v-for="answer in currentQuestion.answers" class="answer text"
                    :class="getButtonClass(answer.id)"
                @click="selectedAnswer(answer.id)"
            >
                {{ answer.title }}
            </button>
        </div>
    </template>
<div class="center">
    <button class="horizontal"
            :disabled="!selectedAnswerId"
            @click="onNextClicked()"><span class="text">
        Next Question
    </span></button>
</div>
</div>
</template>

<script>
import Axios from "axios";
import {QuestionStructure, QuizStructure} from "../quiz-structures";

export default {
    data: () => ({
        isLoading: false,
        /** @type {QuestionStructure}*/
        currentQuestion: null,
        isLastQuestion: false,
        selectedAnswerId: null,
    }),
    created() {
        this.getNextQuestion();
    },
  methods: {
          async getNextQuestion() {
          const formData = new FormData();
          formData.append('csrf', window.csrf);

          this.isLoading = true;
          Axios.post('/quiz-rpc/get-question', formData).then((response) => {
                if (!response.data.questionData) {
                    this.onLastQuestionSubmitted();

                    return;
                }

                this.currentQuestion = new QuestionStructure(response.data.questionData);
                this.isLastQuestion = response.data.isLastQuestion;
          }).finally(() => {
              this.isLoading = false;
          });
      },
      getButtonClass(answerId) {
              return {
                  'btn-choose' : answerId === this.selectedAnswerId,
              }
      },

      selectedAnswer(answerId) {
          this.selectedAnswerId = answerId;
      },

    async onNextClicked() {
        if (!this.selectedAnswerId) {
            return;
        }
            if (this.isButtonDisabled) {
                return;
            }

        const formData = new FormData();
        formData.append('csrf', window.csrf)
        formData.append('answerId', this.selectedAnswerId);
        await Axios.post('/quiz-rpc/save-answer', formData).then((response) =>{
            if (this.isLastQuestion) {
                this.onLastQuestionSubmitted();

                return;
            }

            this.getNextQuestion();
        }).finally(() => {
            this.isLoading = false;
        });

        this.getNextQuestion();
     // this.lastQuestionSubmitted();
    },
    onLastQuestionSubmitted() {
      this.$emit('last-question-submitted');
    }
  },
}
</script>

<style scoped>

</style>