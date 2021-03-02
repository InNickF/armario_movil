<?php

namespace App\Models;

use Eloquent as Model;

class Answer extends Model
{

    public $table = 'answers';



    public $fillable = [
        'body',
        'question_id',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'body' => 'string',
        'question_id' => 'integer',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'body' => 'required',
        'question_id' => 'required',
    ];


    public function question()
    {
        return $this->belongsTo(\App\Models\Question::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}