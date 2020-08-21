<template>
    <div id="app" class="container center">
        <select v-model="selectedQuizId" class="form-control" :disabled="isLoading">
            <option :value="0" key="0" disabled>{{ isLoading ? 'Loading..' : 'Please select a quiz'}}</option>
            <option v-for="quiz in quizzes" :value="quiz.id" :key="quiz.id">
                {{ quiz.name }} ({{ quiz.questionCount}} questions)
            </option>
        </select>

        <br/>

        <button class=horizontal :disabled="isButtonDisabled" @click="onStartClicked()"><span class="text">Start</span></button>
    </div>
</template>

<script>
import Axios from 'axios';
import {QuizStructure} from "../quiz-structures";

export default {
    props: {},
    data: () => ({
        /** @type {Array.<QuizStructure>} */
        quizzes: [],
        isLoading: false,
        selectedQuizId: 0,
    }),
    computed: {
        isButtonDisabled() {
            return this.selectedQuizId < 1 || this.isLoading;
        }
    },
    created() {
        this.loadQuizzes();
    },
    methods: {
        loadQuizzes() {
            const formData = new FormData();
            formData.append('csrf', window.csrf);

            this.isLoading = true;
            Axios.post('/quiz-rpc/get-all', formData).then((response) => {
                this.quizzes = response.data.quizData.map(quizDatum => new QuizStructure(quizDatum));

            }).finally(() => {
                this.isLoading = false;
            });
        },
        onStartClicked() {
            if (this.isButtonDisabled) {
                return;
            }

            const formData = new FormData();
            formData.append('csrf', window.csrf);
            formData.append('quizId', this.selectedQuizId);


            this.isLoading = true;
            Axios.post('/quiz-rpc/start', formData).then((response) => {
                if (response.data.success) {
                    this.$emit('start-clicked');
                }
            }).finally(() => {
                this.isLoading = false;
            });
        },
    },
}
</script>

