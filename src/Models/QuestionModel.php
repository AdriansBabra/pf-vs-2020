<?php


namespace Project\Models;


use http\Client\Curl\User;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $quiz_id
 * @property int $title
 *
 * @property QuizModel $quiz
 * @property AnswerModel[] $answers
 * @property UserQuizAttemptAnswerModel[] $userAnswers
 */
class QuestionModel extends Model
{
    protected $table = 'questions';
    public $timestamps = false;
    protected $guarded = [];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(QuizModel::class);
    }

    public function answers()
    {
        return $this->hasMany(AnswerModel::class, 'question_id', 'id');
    }

    public function userAnswers(): HasMany
    {
        return $this->hasMany(UserQuizAttemptAnswerModel::class, 'question_id', 'id');
    }
}