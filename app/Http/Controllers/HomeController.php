<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Clinic;
use App\Appointment;
use App\Message;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = array(
            'appointments' => Appointment::where('patient_id',auth()->user()->id)->get(),
            'patients' => User::get(),
            'doctorAppointments' => Appointment::where('doctor_id',auth()->user()->id)->get(),
            'messages'=> Message::where('receiver_id',auth()->user()->id)->orWhere('sender_id', auth()->user()->id)->orderBy('created_at','desc')->get(),
        );
        return view('home')->with($data);
    }
    public function createMessage(Request $request, $receiver_id){
        $message = new Message;
        $sender = User::find(auth()->user()->id);
        $receiver = User::find($receiver_id);
        $message->sender_id = $sender->id;
        $message->receiver_id = $receiver->id;
        $message->message_body = $request->message_body;
        $message->save();
        
        return back()->with('success','Message sent.');
    }
}
