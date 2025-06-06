<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    private $course;
    public function index($id)
    {
        $this->course = $id;
        $listLesson =  Lesson::where('course_id', $id)->get();

        return  view('teacher.views.lesson.home')->with([
            'lessons' => $listLesson,
        ]);
    }
    public function store(Request $request)
    {
        try {
            $id = $request->id;
            if ($id) {
                $lesson = Lesson::find($id);
            } else {
                $lesson = new Lesson();
            }
            $lesson->title = $request->title;
            $lesson->course_id = $request->course_id;
            $lesson->content = $request->content;
            $lesson->content_url = $request->content_url;
            $lesson->save();
            return response()->json(['success' => true, 'message' => 'add course success!']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }
}
