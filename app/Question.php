<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['survey_id', 'is_required', 'question_type_id', 'text', 'arguments'];

    public function survey()
    {
        return $this->belongsTo('App\Survey');
    }
    
    public function questionType()
    {
        return $this->belongsTo('App\QuestionType');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}
