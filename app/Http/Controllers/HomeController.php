<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Booking;
use App\Specialty;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

date_default_timezone_set("Africa/Nairobi");


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::get();
        $doctors = [];
        if (!empty($users)) {
            foreach ($users as $key => $value) {
                if (!empty($value->role)  && $value->role->name == 'doctor') {
                    array_push($doctors,$value);
                }
            }
        }
        return view('welcome',['doctors'=>$doctors]);
    }

    public function edit()
    {
        return view('update');
    }

    public function update($id, Request $request)
    {
        if ($request->role === "patient") {
            Validator::make($request->all(), [
                'role' => ['required']
            ]);
            if (empty(Auth::user()->role)) {
                $role = new Role();
                $role->user_id = $id;
                $role->name = $request->role;
                $role->save();
            }
        } elseif ($request->role === "doctor") {
            Validator::make($request->all(), [
                'role' => ['required'],
                'spec' => ['required'],
                'hospital' => ['required'],
                'image' => ['required' | 'image' | 'mimes:jpeg,png,jpg,gif,svg' | 'max:1024'],
            ]);
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            if (empty(Auth::user()->role)) {
                $role = new Role();
                $role->user_id = $id;
                $role->name = $request->role;
                $role->save();
            } else {
            }

            if (!empty(Auth::user()->specialty)) {
            } else {
                $specialty = new Specialty();
                $specialty->user_id = $id;
                $specialty->name = $request->spec;
                $specialty->hospital = $request->hospital;
                $specialty->description = $request->description;
                $specialty->image = $imageName;
                $specialty->save();
            }
        }
        return redirect('/home')->with('success', 'Updated successfully');
    }

    public function show($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            $error = "Invalid id";
            return redirect()->back();
        } else {
            return view('create_book', ['user' => $user]);
        }
    }

    public function view($id)
    {
        $user = User::find($id);
        return view('patient_view', ['user' => $user]);
    }

    public function welcome()
    {
       $users = User::get();
        $doctors = [];
        if (!empty($users)) {
            foreach ($users as $key => $value) {
                if (!empty($value->role)  && $value->role->name == 'doctor') {
                    array_push($doctors,$value);
                }
            }
        }
        return view('welcome',['doctors'=>$doctors]);
    }

    public function profile()
    {
        $comments = [];
        foreach (Auth::user()->reviews as $key => $value) {
            $user = User::findOrFail($value->user_id);
            $comment = [
                'name' => $user->name,
                'comment' => $value->comments,
            ];
            array_push($comments, $comment);
        }
        return view('profile', ['comments'=>$comments]);
    }

    public function appointments()
    {
        $appointments = [];
        if(!empty(auth()->user()->role) && auth()->user()->role->name === "doctor") {
            $id = auth()->user()->id;
            $bookings = Booking::where('doctor_id',$id)->where('deleted_at',NULL)->get();
        }elseif(!empty(auth()->user()->role) && auth()->user()->role->name === "patient"){
            $id = auth()->user()->id;
            $bookings = Booking::where('user_id',$id)->where('deleted_at',NULL)->get();
        }else {
            $bookings = [];
        }
        foreach ($bookings as $key => $value) {
            $patient = User::where('id',$value->user_id)->first();
            $doctor = User::where('id',$value->doctor_id)->first();
            $ob = [
                'id' => $value->id,
                'patient' => $patient->name,
                'doctor' => $doctor->name,
                'email' => $patient->email,
                'phone' => $patient->phone,
                'date' => $value->date,
                'time' => $value->time,
                'condition' => $value->condition,
                'status' => $value->status
            ];
            array_push($appointments,$ob);
        }
        return view('appointments',['appointments'=>$appointments]);
    }

    public function patientProfile()
    {
        if (Auth::user()->role->name === 'patient') {
            $bookings = Booking::where('user_id',Auth::user()->id)->get();
            return view('patient-profile',['bookings'=>$bookings]);
        }else{
            return redirect('home');
        }

    }

    public function doc($id)
    {
        if (!empty($id)) {
            $doctor = User::findOrFail($id);
            if ($doctor->role->name == 'doctor') {
                $comments = [];
                foreach ($doctor->reviews as $key => $value) {
                    $user = User::findOrFail($value->user_id);
                    $comment = [
                        'name' => $user->name,
                        'comment' => $value->comments,
                    ];
                    array_push($comments, $comment);
                }
                return view('doctor-profile',['doctor'=>$doctor,'comments'=>$comments]);
            }else {
                return redirect()->back();
            }
        }else {
            return redirect()->back();
        }

    }

    public function comment($id, Request $request)
    {
        $request->validate([
            'comment' => 'string|max:255'
        ]);
        $rev = new Review();
        $rev->user_id = Auth::user()->id;
        $rev->doctor_id = $id;
        $rev->comments = $request->comment;
        $rev->save();
        return redirect()->back()->with('success','Review submitted successfully');
    }
}
