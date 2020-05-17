@extends('layouts.app')
@section('content')
<style>
    body {
        background: url("../../images/background.jpeg") no-repeat center;
        background-size: cover;
    }

    #main-footer {
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    label {
        color: var(--primary-color);
    }

    #dark-bg {
        background: rgba(0, 0, 0, 0.6);
        padding: 2rem;
        border: 1px solid var(--primary-color);
        border-radius: 12px;
        top: -50%;
        margin-bottom: 4rem;
        margin-top: 2rem;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);

    }

</style>
<div class="container">
    <div class="jumbotron bg-none">
        <div id="dark-bg">
            <h2 class="center">Edit Appointment</h2>
            {{ Form::open(['action' => ['ClinicsController@update', $appointment->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) }}
            
            
            <div class="form-group">
                {{Form::label('title','Edit Date')}}
                <input type="date" class="form-control" name="date" id="date" placeholder="{{$appointment->date}}">
            </div>

            <div class="form-group">
                {{Form::label('title','Edit Time')}}
                <select class="form-control" name="time" id="time" placeholder="{{$appointment->time}}" meta-time='{{$doctor->shift}}'>

                </select>
            </div>

            {{-- SPOOFING METHOD --}}
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Edit Appointment',['class'=>'btn btn-outline-primary'])}}
            {{ Form::close() }}
        </div>

</div>
</div>
<script>
function timeSelect(){
// var doctorSelect = $("#doctor-select").children("option:selected");
// var doctorShift = doctorSelect.attr('meta-shift');
$timeSelect = $("#time");
$timeSelect.children().remove();
$timeShift = $timeSelect.attr('meta-time');
$shiftStart = $timeShift.substr(0,5);
$tNow = $shiftStart;
let timeInt = parseInt($tNow.substr(0,2));

for(let i=0;i<=7;i++){
    if((timeInt+"").length==1){
        let tempInt = '0'+timeInt;
        $timeSelect.append("<option value="+tempInt+':00'+'>'+tempInt+':00'+'</option>');
    }else{
        $timeSelect.append("<option value="+timeInt+':00'+'>'+timeInt+':00'+'</option>');
    }

    timeInt++;  
     
}
}
timeSelect();
</script>
@endsection
