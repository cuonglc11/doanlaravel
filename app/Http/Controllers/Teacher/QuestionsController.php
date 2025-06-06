<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Exams;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function index($id)
    {
        $listQuestion =  Question::where('exam_id', $id)->get();
        return view('teacher.question.home')->with([
            'listQuestion' => $listQuestion,
        ]);
    }
    public function store(Request $request)
    {
        $question  = new Question();
        $question->content = $request->content;
        $question->option = json_encode([
            'A' =>  $request->option['A'],
            'B' =>  $request->option['B'],
            'C' =>  $request->option['C'],
            'D' =>  $request->option['D'],
        ]);
        $question->correct = $request->correct;
        $question->exam_id = $request->exam_id;
        $exams = Exams::find($request->exam_id);
        if($exams) {
            $exams->total_question = $exams->total_question + 1;
            $exams->save();
        }

        $question->save();
        return response()->json(['success' => true, 'message' => 'add question success!']);
    }
}
