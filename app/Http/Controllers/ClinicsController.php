<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Clinic;
use App\Appointment;
class ClinicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinics = Clinic::get();
        return view('index')->with('clinics',$clinics);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if(Auth::check()){
            $clinic = Clinic::find($id);
        $data = array(
            'clinic'=>$clinic,
            'doctors'=>User::get()->where('clinic',$clinic->name)
        );
        return view('clinics/create')->with($data);
        }else{
            return view('auth.login');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $appointment = new Appointment;
            $appointment->patient_id =auth()->user()->id;
            $appointment->doctor_id =User::find($request->doctor)->id;
            $appointment->doctor_name =User::find($request->doctor)->name;
            $appointment->clinic_id =$request->clinic_id;
            $appointment->clinic_type = Clinic::find($request->clinic_id)->type;
            $appointment->price = Clinic::find($request->clinic_id)->price;
            $appointment->date = $request->date;
            $appointment->time = $request->time;
            $appointment->save();
            return redirect('/dashboard')->with('success','Appointment Booked!');
        }else{
            return view('auth.login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $clinic = Clinic::find($id);
        $data = array(
            'clinic' => Clinic::find($id),
            'doctors' => User::get()->where('clinic','==',$clinic->name)
        );
        return view('clinics/show')->with($data);
    }


    // public function book($request, $id){
    //     $appointment = new Appointment;
    //     $appointment-> auth()->user()->id;
    //     $appointment->
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = Appointment::find($id);
        // $clinic = Clinic::find($appointment->clinic_id);
        $data = array(
            'appointment'=>Appointment::find($id),
            // 'clinic'=>$clinic,
            'doctor'=>User::find($appointment->doctor_id)
        );
        return view('clinics/edit')->with($data);
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
        if(Auth::check()){
            $appointment = Appointment::find($id);
            $appointment->date = $request->date;
            $appointment->time = $request->time;
            $appointment->save();
            return redirect('/dashboard')->with('success','Appointment edited.');
        }else{
            return back()->with('error','Error: Unauthorized user.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::check()){
            $appointment = Appointment::find($id);
            if($appointment->patient_id==auth()->user()->id){
                $appointment->delete();
                return back()->with('success','Appointment cancelled.');
            }else{
                return back()->with('error','Unauthorized User');
            }
        }else{
            return back()->with('error','Unauthorized User');
        }
    }
}
