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
        transform: translate(-50%, -50%);

        margin-bottom: 4rem;
        margin-top: 2rem;
        position: absolute;
        top: 50%;
        left: 50%;

    }

</style>
<style>
    /* #confirm-appointment-modal{
        z-index: 9999 !important;
    } */
    /* .modal-dialog, .modal{
        z-index: 9999 !important;
    } */
    </style>
<div class="container">
    <div class="jumbotron bg-none">
        <div id="dark-bg">
            <h2 class="center">Book {{$clinic->type}} Appointment</h2>
            {{ Form::open(['action' => 'ClinicsController@store', 'method'=>'POST', 'enctype'=>'multipart/form-data']) }}
            <input type="text" name="clinic_id" value="{{$clinic->id}}" style="display:none !important;">
            <div class="form-group">
                {{Form::label('title','Select Doctor')}}
                <select class="form-control" name="doctor" id="doctor-select" onchange="timeSelect()">
                    @foreach ($doctors as $doctor)
                     <option meta-shift='{{$doctor->shift}}' value="{{$doctor->id}}">{{$doctor->name}}</option>   
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                {{Form::label('title','Select Date')}}
                <input type="date" class="form-control" name="date" id="date">
            </div>

            <div class="form-group">
                {{Form::label('title','Select Time')}}
                <select class="form-control" name="time" id="time" meta-time='{{$doctor->shift}}'>

                </select>
            </div>

            <div class="form-group">
                {{Form::label('title','Price: '.$clinic->price.'$')}}
            </div>

            <a href="#" class="btn btn-primary" id="contact-family" data-toggle="modal" data-target="#contact-us-modal">Book Treatment</a>


            
        </div>
        <div class="modal fade" id="contact-us-modal" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:9999 !important;">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Book Appointment</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <p>{{$clinic->type}} appointment costs <b>${{$clinic->price}}</b>. Confirm appointment?</p>
                        {{Form::submit('Confirm Appointment',['class'=>'btn btn-outline-primary'])}}

                </div>
         
              </div>
            </div>
          </div>

    {{-- {{Form::submit('Book Appointment',['class'=>'btn btn-outline-primary'])}} --}}
    {{ Form::close() }}
</div>
</div>
<script>
function timeSelect(){
var doctorSelect = $("#doctor-select").children("option:selected");
var doctorShift = doctorSelect.attr('meta-shift');
$timeSelect = $("#time");
$timeSelect.children().remove();
$timeShift = doctorShift;
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
