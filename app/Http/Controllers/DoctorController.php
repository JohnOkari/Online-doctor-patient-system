<?php

namespace App\Http\Controllers;

use App\Data;
use App\User;
use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Specialty;

date_default_timezone_set("Africa/Nairobi");

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        return view('home',['doctors'=>$doctors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (!empty($id)) {
            $booking = Booking::find($id);
            if (!empty($booking)) {
                if (!empty($booking->data)) {
                    $prescription = $booking->data;
                }

                if ($booking->doctor_id !== Auth::user()->id) {
                    return redirect()->back(); 
                }else{
                    $patient = User::findOrFail($booking->user_id);
                    return view('create_pres', ['patient' => $patient, 'condition'=>$booking,'prescription'=>$prescription]);
                }
            }else{
                return redirect()->back()->with('error','Invalid request');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $user = User::find($id);
        $request->validate([
            'symptoms' => 'required',
            'diag' => 'required',
            'drug' => 'required',
            'files' =>'max:2048|mimes:jpeg,png,jpg,gif,svg, pdf|max:1024',
        ]);
        $data = new Data();
        $data->doctor_id = Auth::user()->id;
        $data->booking_id = $id;
        $data->symptoms = $request->symptoms;
        $data->diagnosis = $request->diag;
        // $data->results = $request->results;
        $data->drugs = $request->drug;
        if (!is_null($request->next_meet)) {
            $data->follow_up = $request->next_meet;
        }
        if (!empty($request->img)) {
            $imageName = time() . '.' . $request->img->getClientOriginalExtension();
            $request->img->move(public_path('files'), $imageName);
            $data->image = $imageName;
        }
        $data->save();
        return redirect()->back()->with('success', 'Prescription was successful');
    }

    public function search(Request $request)
    {
        $doctors = [];
        $term = $request->specialty;
        $specialties = Specialty::where('name','like','%'.$term."%")->get();
        foreach ($specialties as $key => $value) {
            $doctor = $value->user;
            array_push($doctors,$doctor);
        }
        return view('welcome',['doctors'=>$doctors]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
