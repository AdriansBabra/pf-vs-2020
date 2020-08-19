<template>
  <div>
    <quiz-select
        v-if="currentStep=== allSteps.STEP_QUIZ_SELECT"
        @start-clicked="onStartClicked()"/>
    <quiz-questions
        v-else-if="currentStep=== allSteps.STEP_QUIZ_QUESTIONS"
        @last-question-submitted="onLAstQuestionSubmitted()"/>
    <quiz-results
        v-else-if="currentStep=== allSteps.STEP_QUIZ_RESULTS"
        :user-name="userName"
        @quiz-finished="onQuizFinished()"/>
  </div>
</template>
<script>
import QuizSelect from "./components/QuizSelect";
import QuizQuestions from "./components/QuizQuestions";
import QuizResults from "./components/QuizResults";

const STEP_QUIZ_SELECT = 1;
const STEP_QUIZ_QUESTIONS = 2;
const STEP_QUIZ_RESULTS = 3;

const STEPS_ALL = {
  STEP_QUIZ_SELECT: STEP_QUIZ_SELECT,
  STEP_QUIZ_QUESTIONS: STEP_QUIZ_QUESTIONS,
  STEP_QUIZ_RESULTS: STEP_QUIZ_RESULTS,
};

export default {
  props: {
    userName: {
      type: String,
      required: true,
    }
  },
  components: {
    QuizSelect,
    QuizQuestions,
    QuizResults,
  },
  data: () => ({
    currentStep: STEP_QUIZ_SELECT,
  }),
  computed: {
    allSteps() {
      return STEPS_ALL;
    }
  },
  watch: {
    currentStep() {
      const stepExists = Object.values(STEPS_ALL).includes(this.currentStep) //Object.values atgriež visas objekta vērtības masīvā
      if (!stepExists) {
        this.currentStep = STEP_QUIZ_SELECT;
      }
    }
  },
  methods: {
    onStartClicked() {
      this.currentStep++;
    },
    onLAstQuestionSubmitted() {
      this.currentStep++;
    },
    onQuizFinished() {
      this.currentStep = STEP_QUIZ_SELECT;
    }
  },
}
</script>

//te glabās quizz un kurā skatā atrodas