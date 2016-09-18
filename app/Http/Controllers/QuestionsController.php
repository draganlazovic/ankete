<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

use App\Http\Requests;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'survey_id' => 'required',
            'question_type_id' => 'required',
            'text' => 'required',
        ]);

        $question = new Question;
        $question->survey_id = $request->survey_id;
        $question->is_required = $request->is_required == 'on';
        $question->question_type_id = $request->question_type_id;
        $question->text = $request->text;
        if (isset($request->arguments) && strlen($request->arguments) > 0) {
            $question->arguments = json_encode(explode(';', $request->arguments));
        }
        $question->save();

        return back();
    }
}
