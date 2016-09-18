<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Survey;
use Illuminate\Http\Request;

use App\Http\Requests;

class AnswersController extends Controller
{
    public function show($slug)
    {
        $survey = Survey::with('questions')->where('slug', $slug)->first();

        return view('answers.index', [
            'survey' => $survey,
        ]);
    }

    public function store(Request $request)
    {
        foreach ($request->input() as $id => $value) {
            if ($id != '_token') {
                $answer = new Answer;
                $answer->question_id = $id;
                $answer->text = $value;
                $answer->save();
            }
        }
        
        return view('answers.thanks');
    }
}
