<?php


namespace Project\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class UserAnswerModel
 * @property int $id
 * @property int $userId
 * @property int $question_id
 * @property int $answer_id
 */
class UserAnswerModel extends Model
{
    protected $table = 'user_answers';
    public $timestamps = false;
    protected $guarded = [];

    public function answer()
    {
        return $this->hasOne(AnswerModel::class, 'answer_id', 'id');
    }
}