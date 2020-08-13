<?php


namespace Project\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @package Project/Models
 * @property UserQuizAttemptModel[] $quizAttempts
 */

class UserModel extends Model
{
    protected $table = 'users';
    public $timestamps = false;
    protected $guarded = [];

    public function quizAttempts(): HasMany
    {return $this->hasMany(UserQuizAttemptModel::class, 'user_id', 'id');
    }
}