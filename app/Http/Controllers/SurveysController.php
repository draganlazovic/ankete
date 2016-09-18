<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionType;
use App\Survey;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;

use App\Http\Requests;
use Maatwebsite\Excel\Facades\Excel;

class SurveysController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $surveys = $request->user()->surveys()->get();

        return view('surveys.index', [
            'surveys' => $surveys,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
        ]);

        $request->user()->surveys()->create([
            'title' => $request->title,
            'text' => $request->text,
            'user_id' => $request->user()->id,
            'slug' => Uuid::uuid(),
        ]);

        return redirect('/surveys');
    }

    public function show($id)
    {
        $survey = Survey::with('questions')->where('id', $id)->first();
        $question_types = QuestionType::all();

        return view('surveys.show', [
            'survey' => $survey,
            'question_types' => $question_types,
        ]);
    }

    public function answers($id)
    {
        $questions = Question::with('answers')->where('survey_id', $id)->get();
        $answerCount = 0;
        foreach ($questions as $question) {
            foreach ($question->answers as $answer) {
                $answerCount++;
            }
        }

        return view('surveys.answers', [
            'surveyId' => $id,
            'questions' => $questions,
            'answerCount' => $answerCount,
        ]);
    }

    public function csv($id)
    {
        $questions = Question::with('answers')->where('survey_id', $id)->get();

        $questionTitles = array();
        $questionAnswers = array();
        foreach ($questions as $question) {
            array_push($questionTitles, $question->text);
            $answers = array();
            foreach ($question->answers as $answer) {
                array_push($answers, $answer->text);
            }
            array_push($questionAnswers, $answers);
        }

        $questionAnswers = $this->traverse($questionAnswers);

        Excel::create('survey-' . $id, function ($excel) use ($questionAnswers, $questionTitles) {
            $excel->sheet('Sheet1', function ($sheet) use ($questionAnswers, $questionTitles) {
                // header row
                $sheet->row(1, $questionTitles);
                // data
                for ($i = 0; $i < count($questionAnswers); $i++) {
                    $sheet->row($i + 2, $questionAnswers[$i]);
                }

            });

        })->export('csv');

        return back();
    }

    private function traverse($questionAnswers)
    {
        $traversed = array();

        for ($i = 0; $i < count($questionAnswers); $i++) {
            for ($j = 0; $j < count($questionAnswers[$i]); $j++) {
                $traversed[$j][$i] = $questionAnswers[$i][$j];
            }
        }

        return $traversed;
    }
}
