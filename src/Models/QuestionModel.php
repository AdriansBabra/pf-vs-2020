<?php


namespace Project\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $quiz_id
 * @property int $title
 *
 * @property QuizModel $quiz
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
}