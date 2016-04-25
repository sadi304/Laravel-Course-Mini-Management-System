<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;

use App\Http\Requests;

use App\User;

use App\Dept;

use App\upload;

use App\course;

class UserController extends Controller
{
    
    public function getLogin() {
        
        // Redirect to Dashboard if Already Logged In
        if( Auth::check() ) {
            return redirect()->route('dashboard');
        }
        
        return view('pages.login');
        
    }
    
    public function getDashboard() {
        
        $user = Auth::User();
        
        $uploads = $user->uploads()
                        ->orderBy('created_at','DESC')
                        ->get();
        
        $courses = $user->courses
                        ->all();
        
        $mainCourses = [];
        foreach( $courses as $course ) {
            $mainCourses[$course->id] = $course->name;
        }
        
        return view('pages.dashboard')->withUploads($uploads)->withCourses($mainCourses);
        
    }
    
    public function getLogout() {
        
        Auth::logout();
        
        return redirect()->route('login');
        
    }
    
    public function getDelete($uploadid) {
        
        $user = Upload::find($uploadid)->user;
        
        if( Auth::User()->id == $user->id ) {
            $upload = Upload::find($uploadid)->delete();
        }
        
        return redirect()->back();
        
    }
    
    public function postSignUp(Request $request) {
        
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'name' => 'required|min:4',
            'dept_id' => 'required',
            'student_id' => 'required|digits:6',
            'role' => 'required',
            'password' => 'required|min:6'
        ]);
        
        $user = new User();
        
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->dept_id = $request['dept_id'];
        $user->role = $request['role'];
        $user->student_id = $request['student_id'];
        $user->password = bcrypt($request['password']);
        
        $user->save();
        
        return redirect()->route('dashboard');
        
    }
    
    public function postSignIn(Request $request) {
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ]);
        
        if( Auth::attempt([ 'email' => $request['email'] , 'password' => $request['password'] ]) ) {
            return redirect()->route('dashboard');
        }
        
        return redirect()->back();
    }
    
    public function postUpload(Request $request) {
        
        $this->validate($request,[
            'course' => 'required',
            'level' => 'required', 
            'file' => 'required'
        ]);
        
        $file = $request->file('file');
        
        $filename = $file->getClientOriginalName();
        
        $upload = new upload();
        
        $course = Course::find($request->course);
        
        $upload->course_id = $request->course;
        
        $upload->level = $request->level;
        
        $upload->name = $course->dept->name . '-' . $course->name . '-' . $filename;
        
        $upload->save();
        
        Storage::disk('local')->put($filename, File::get($file));
        
        return redirect()->back();
            
    }
    
    public function getStudentDash() {
        
        if( Auth::User()->role != 'student') {
            return redirect()->back();
        }
        
        $dept = Dept::Find(Auth::User()->dept_id);
        
        $courses = $dept->courses;
        
        $mainUploads = [];
        
        foreach ( $courses as $course ) {
            $uploads = upload::where('course_id', $course->id)->get();
          
            foreach ( $uploads as $upload ) {
                array_push($mainUploads,$upload);
            }
            
        }
        
        $collection = collect($mainUploads)->sortByDesc('created_at');
        
        return view('pages.sdashboard')->withUploads($collection);
    }
    
    public function getUpload($filename) {
        
        $file = Storage::disk('local')->get($filename);
        
        $headers = array(
            'Content-type'          => 'application/pdf',
            'Content-Disposition'   => 'attachment; filename="' . $filename . '"'
        );
        
        return new Response($file,200,$headers);
            
    }
    
}
