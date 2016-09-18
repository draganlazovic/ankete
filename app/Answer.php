<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['question_id', 'text'];

    public function question()
    {
        return $this->belongsTo('App\Question');
    }
}
