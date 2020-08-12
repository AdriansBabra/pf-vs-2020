<?php

namespace Project\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 *
 * @property QuestionModel[] $questions
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
}