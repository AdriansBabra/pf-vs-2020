<?php


namespace Project\Controllers;


use Project\Components\ActiveUser;
use Project\Components\Controller;
use Project\Components\Session;
use Project\Exceptions\Http\HttpForbiddenException;
use Project\Models\QuizModel;
use Project\Models\UserModel;
use Project\Repositories\AnswerRepository;
use Project\Repositories\QuizRepository;
use Project\Repositories\UserQuizAttemptAnswerRepository;
use Project\Repositories\UserQuizAttemptRepository;
use Project\Repositories\UserRepository;

class AdminController extends Controller
{
    private QuizRepository $quizRepository;
    private UserRepository $userRepository;
    private AnswerRepository $answerRepository;
    private UserQuizAttemptRepository $userQuizAttemptRepository;
    private UserQuizAttemptAnswerRepository $userQuizAttemptAnswerRepository;

    public function __construct(UserRepository  $userRepository = null, QuizRepository $quizRepository = null)
    {

        $this->userRepository = $userRepository ?? new UserRepository();
        $this->quizRepository = $quizRepository ?? new QuizRepository();
        $this->answerRepository = $answerRepository ?? new AnswerRepository();
        $this->userQuizAttemptRepository = $userQuizAttemptRepository ?? new UserQuizAttemptRepository();
        $this->userQuizAttemptAnswerRepository = $userQuizAttemptAnswerRepository ?? new UserQuizAttemptAnswerRepository();
    }

    /**
     * @return string|null
     * @throws HttpForbiddenException
     */
    public function index(): ?string
    {
        if (!ActiveUser::getUser()->is_admin) {
            throw new HttpForbiddenException();
        }
        $users = $this->userRepository->getAll();
        $quizzes = $this->quizRepository->getAll();
        return $this->view('admin/index', ['users' => $users, 'quizzes' => $quizzes]);
    }
    /**
     * @return string|null
     * @throws HttpForbiddenException
     */
    public function viewUser(): ?string
    {
        if (!ActiveUser::getUser()->is_admin) {
            throw new HttpForbiddenException();
        }
        $id = (int)($_GET['id'] ?? null);
        if (!$id) {
            Session::getInstance()->setErrorMessage("User ID missing");
            return $this->redirect('/admin');
        }
        // TODO: Pārcelt uz atbilstošu UserRepository metodi
        $user = UserModel::query()->where('id', '=', $id)->first();
        if (!$user) {
            Session::getInstance()->setErrorMessage("User with ID '{$id}' not found");
            return $this->redirect('/admin');
        }
        return $this->view('admin/view-user', ['user' => $user]);
    }

    public function viewQuiz(): ?string
    {
        if (!ActiveUser::getUser()->is_admin) {
            throw new HttpForbiddenException();
        }
        $id = (int)($_GET['id'] ?? null);
        if (!$id) {
            Session::getInstance()->setErrorMessage("Quiz ID missing");
            return $this->redirect('/admin');
        }
        $quiz = $this->quizRepository->getById($id);
        $answers = $this->answerRepository->getAll();
        if(!$quiz){
            Session::getInstance()->setErrorMessage("Quiz with such ID '{$id}' not found");
            return $this->redirect('/admin');
        }
        return $this->view('admin/view-quiz', ['quiz' => $quiz, 'answers' => $answers]);
    }
    public function viewAttempt(): ?string
    {
        if (!ActiveUser::getUser()->is_admin) {
            throw new HttpForbiddenException();
        }
        $id = (int)($_GET['id'] ?? null);
        if (!$id) {
            Session::getInstance()->setErrorMessage("User ID missing");
            return $this->redirect('/admin');
        }
        $attempt = $this->userQuizAttemptRepository->getById($id);
        $attemptAnswers = $this->userQuizAttemptAnswerRepository->getAll();
        $quiz = $this->quizRepository->getById($attempt->quiz_id);
        $answers = [];
        foreach ($quiz->questions as $question) {
            $answers = [...$answers, ...$question->answers];
        }
        if(!$attempt){
            Session::getInstance()->setErrorMessage("Attempt with such ID '{$id}' not found");
            return $this->redirect('/admin');
        }
        return $this->view('admin/attempt-view', ['answers'=>$answers, 'attempt' => $attempt, 'attemptAnswers' => $attemptAnswers, 'quiz'=>$quiz]);
    }
    /**
     * @return string|null
     * @throws HttpForbiddenException
     */
    public function toggleUserAdmin(): ?string
    {
        if (!ActiveUser::getUser()->is_admin) {
            throw new HttpForbiddenException();
        }
        $id = (int)($_POST['id'] ?? null);
        // TODO: Pārcelt visu no [start] līdz [end] uz servisu.
        // TODO: Visam starp start un end vajadzētu būt try catch blokā
        // TODO: Repozitoriju loģiku (kur ir vaicājums lietotāja atrašanai vai izmaiņas lietotāja modelim) pārcelt uz UserRepository::getUserById, UserRepository::saveModel un izsaukt caur servisu
        // TODO: Ja ir kāds errors (piem. userId === id), metam AdminException ar ziņu iekšā
        // TODO: Tad kļūdas ziņojumu iestatam sesijā caur kontrolieri
        // TODO: Citādāk (ja viss ok), izvadam success message arī caur sesiju un taisam redirect atpakaļ
        // TODO: [start]
        if (ActiveUser::getUserId() === $id) {
            Session::getInstance()->setErrorMessage("You can't toggle your own admin status!");
            return $this->redirect($_SERVER['HTTP_REFERER']);
        }
        /** @var UserModel $user */
        $user = UserModel::query()->where('id', '=', $id)->first();
        if (!$user) {
            Session::getInstance()->setErrorMessage("User not found");
        } else {
            $user->is_admin = !$user->is_admin;
            $user->save();
            Session::getInstance()->setSuccessMessage("Admin status successfully toggled");
        }
        // TODO: [end]
        return $this->redirect($_SERVER['HTTP_REFERER']);
    }
    /**
     * @return string|null
     * @throws HttpForbiddenException
     */
    public function deleteUser(): ?string
    {
        if (!ActiveUser::getUser()->is_admin) {
            throw new HttpForbiddenException();
        }
        $id = (int)($_POST['id'] ?? null);
        // TODO: Pārcelt visu no [start] līdz [end] uz servisu.
        // TODO: Visam starp start un end vajadzētu būt try catch blokā
        // TODO: Repozitoriju loģiku (kur ir vaicājums lietotāja atrašanai vai izmaiņas lietotāja modelim) pārcelt uz UserRepository::getUserById, UserRepository::saveModel un izsaukt caur servisu
        // TODO: Ja ir kāds errors (piem. userId === id), metam AdminException ar ziņu iekšā
        // TODO: Tad kļūdas ziņojumu iestatam sesijā caur kontrolieri
        // TODO: Citādāk (ja viss ok), izvadam success message arī caur sesiju un taisam redirect atpakaļ
        // TODO: [start]
        if (ActiveUser::getUserId() === $id) {
            Session::getInstance()->setErrorMessage("You can't delete yourself!");
            return $this->redirect($_SERVER['HTTP_REFERER']);
        }
        /** @var UserModel $user */
        $user = UserModel::query()->where('id', '=', $id)->first();
        if (!$user) {
            Session::getInstance()->setErrorMessage("User not found");
        } else {
            $user->email = null;
            $user->password = null;
            $user->name = 'Former user';
            $user->save();
            Session::getInstance()->setSuccessMessage("User successfully deleted");
        }
        // TODO: [end]
        return $this->redirect($_SERVER['HTTP_REFERER']);
    }

    public function deleteQuiz(): ?string
    {
        if (!ActiveUser::getUser()->is_admin) {
            throw new HttpForbiddenException();
        }
        $id = (int)($_POST['id'] ?? null);
        // TODO: Pārcelt visu no [start] līdz [end] uz servisu.
        // TODO: Visam starp start un end vajadzētu būt try catch blokā
        // TODO: Repozitoriju loģiku (kur ir vaicājums lietotāja atrašanai vai izmaiņas lietotāja modelim) pārcelt uz UserRepository::getUserById, UserRepository::saveModel un izsaukt caur servisu
        // TODO: Ja ir kāds errors (piem. userId === id), metam AdminException ar ziņu iekšā
        // TODO: Tad kļūdas ziņojumu iestatam sesijā caur kontrolieri
        // TODO: Citādāk (ja viss ok), izvadam success message arī caur sesiju un taisam redirect atpakaļ
        // TODO: [start]
        /** @var QuizModel $quiz */
        $quiz = QuizModel::query()->where('id', '=', $id)->first();
        if (!$quiz) {
            Session::getInstance()->setErrorMessage("Quiz not found");
        } else {
            $quiz = $this->quizRepository->getById($id);
            $answers = $this->answerRepository->getAll();
            $quiz->name = 'Former quiz';
            $quiz->save();
            Session::getInstance()->setSuccessMessage("Quiz successfully deleted");
        }
        // TODO: [end]
        return $this->redirect($_SERVER['HTTP_REFERER']);
    }
}