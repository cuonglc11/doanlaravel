<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\categoryCourse;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $listCouser =  Course::where('instructor_id' , Auth::id())->get();
        $category =  categoryCourse::all();

        return view('teacher.views.home')->with([
            'listCouser' => $listCouser,
            'category' => $category
        ]);
    }
    public function store(Request $request)
    {
        try {
            $id = $request->id;
            if($id) {
                $course = Course::find($id);
            }else {
                $course = new Course();
            }
            $course->instructor_id = Auth::id();
            $course->title = $request->title;
            $course->description = $request->description;
            $course->category_id = $request->category_id;
            $course->price = $request->price;
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('img/teacher'); // thư mục public/courses
                $file->move($destinationPath, $filename);
                $course->img = 'img/teacher/' . $filename;
            }
            $course->save();
            return response()->json(['success' => true, 'message' => 'add course success!']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' =>$th->getMessage()]);
        }

    }
}