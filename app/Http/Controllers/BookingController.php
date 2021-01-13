<?php

namespace App\Http\Controllers;

use App\Booking;
use App\User;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function create($id, Request $request)
    {
        $book = new Booking();
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'condition' => 'required|string|max:190',
        ]);
        $date = $request->date." ".$request->time;
        
        if($date < date('Y-m-d H:i')){
            return redirect()->back()->withErrors("Failed cannot book appointment for a past time");
        }
        $book->user_id = Auth::user()->id;
        $book->doctor_id = $id;
        $book->date = $request->date;
        $book->time = $request->time;
        $book->condition = $request->condition;
        $book->save();

        $user = Auth::user();
        $notification = new Notification();
        $message = "Your appointment for $request->date at $request->time has been submited successfully. Please wait for confirmation";
        if (substr($user->phone, 0,1) == 0) {
            $phone = "+254".ltrim($user->phone, substr($user->phone, 0, 1));
        }else{
            $phone = $user->phone;
        }
        $notification->senMessage($phone,$message);
        return redirect('appointments')->with('success', 'Booking was successful');
    }

    public function accept($id)
    {
        $book = Booking::find($id);
        $book->status = "approved";
        $book->update();
        $user = $book->user;
        $notification = new Notification();
        $message = "Your appointment for $book->date at $book->time has been approved successfully.";
        if (substr($user->phone, 0,1) == 0) {
            $phone = "+254".ltrim($user->phone, substr($user->phone, 0, 1));
        }else{
            $phone = $user->phone;
        }
        $notification->senMessage($phone,$message);
        return redirect()->back()->with('success','approved successfully');

    }

    public function edit($id)
    {
        if (!empty($id)) {
            $booking = Booking::findOrFail($id);
            if (!empty($booking) && $booking->doctor_id == Auth::user()->id) {
                $patient = User::findOrFail($booking->user_id);
                return view('appointment-update',['booking'=>$booking,'patient'=>$patient]);
            }else{
                return redirect()->back()->with('error','Invalid request');
            }
        }else{
            return redirect()->back()->with('error','Invalid request');
        }

    }

    public function update(Request $request)
    {
        $date = $request->date." ".$request->time;
        if($date < date('Y-m-d H:i')){
            return redirect()->back()->withErrors("Failed cannot book appointment for a past time");
        }
        $booking = Booking::findOrFail($request->appointment_id);
        $booking->date = $request->date;
        $booking->time = $request->time;
        $booking->update();
        $user = User::findOrFail($booking->user_id);
        $notification = new Notification();
        $message = "Your appointment for $booking->date at $booking->time has been rescheduled for $request->date at $request->time. Sorry for the inconvenience";
        if (substr($user->phone, 0,1) == 0) {
            $phone = "+254".ltrim($user->phone, substr($user->phone, 0, 1));
        }else{
            $phone = $user->phone;
        }
        $notification->senMessage($phone,$message);
        return redirect()->back()->with('success','Updated successfully');
    }

    public function destroy($id)
    {
        if (!empty($id)) {
            $booking = Booking::findOrFail($id);
            $booking->deleted_at = date('Y-m-d H:i:s');
            $booking->update();

            $user = User::findOrFail($booking->user_id);
            $notification = new Notification();
            $message = "Your appointment for $booking->date has been canceled. Kindly book appointment with another specialist";
            if (substr($user->phone, 0,1) == 0) {
                $phone = "+254".ltrim($user->phone, substr($user->phone, 0, 1));
            }else{
                $phone = $user->phone;
            }
            $notification->senMessage($phone,$message);
        }
        return redirect()->back()->with('success','Deleted successfully');
    }


    public function cancelAppointment(Request $request)
    {
        $booking = Booking::find($request->appointment_id);
        $booking->status = "cancelled";
        $booking->update();
        $user = User::findOrFail($booking->user_id);
        $notification = new Notification();
        $message = "Your appointment for $booking->date has been canceled. Due to ".$request->remarks;
        if (substr($user->phone, 0,1) == 0) {
            $phone = "+254".ltrim($user->phone, substr($user->phone, 0, 1));
        }else{
            $phone = $user->phone;
        }
        $notification->senMessage($phone,$message);
        return redirect()->back()->with('success','Appointment cancelled successfully');
    }


    public function history()
    {
        if (Auth::user()->role->name === 'patient') {
            $bookings = Booking::where('user_id',Auth::user()->id)->get();
            return view('history',['bookings'=>$bookings]);
        }else{
            return redirect('home');
        }
    }
}
