<?php

namespace Project\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 *
 * @property QuestionModel[] $questions
 * @property UserQuizAttemptModel[] $attempts
 */
class QuizModel extends Model
{
    protected $table = 'quizzes';
    public $timestamps = false;
    protected $guarded = [];

    public function questions()
    {
        return $this->hasMany(QuestionModel::class, 'quiz_id','id' );
    }

    public function attempts():HasMany
    {
        return $this->hasMany(UserQuizAttemptModel::class, 'quiz_id', 'id');
    }
}