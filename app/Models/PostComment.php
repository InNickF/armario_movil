<?php

namespace App\Models;

use App\Models\Post;
use App\User;
use Eloquent as Model;

/**
 * Class PostComment
 * @package App\Models
 * @version August 27, 2019, 1:02 pm -05
 *
 * @property integer post_id
 * @property integer user_id
 * @property string body
 */
class PostComment extends Model
{

    public $table = 'post_comments';
    
    public $with = [
        'user',
        'post'
    ];

    public $fillable = [
        'post_id',
        'user_id',
        'body'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'post_id' => 'integer',
        'user_id' => 'integer',
        'body' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'post_id' => 'required',
        'body' => 'required'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
