<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Exams;
use Illuminate\Http\Request;

class ExamsController extends Controller
{
    public function index($id)
    {
        $listExams =  Exams::where('course_id', $id)->get();

        return view('teacher.views.exams.exams')->with([
            'exams' => $listExams,
        ]);
    }
    public function store(Request $request)
    {
        $exams = new Exams();
        $exams->title = $request->title;
        $exams->course_id = $request->course_id;
        $exams->duration = $request->duration;
        $exams->save();
        return response()->json(['success' => true, 'message' => 'add course success!']);
    }
}
