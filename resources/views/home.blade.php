@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1 class="center">Booked Appointments</h1>
        @if(auth()->user()->type=='patient')
            @if(count($appointments)>0)
            <table class="center table table-striped" style="color:black !important;">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Clinic</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Price</th>
                        <th scope="col">Doctor Name</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($appointments as $appointment)
                     <tr>
                            <th class="py-4" scope="row">{{$loop->iteration}}</th>
                            <td class="py-4">{{$appointment->clinic_type}}</td>
                            <td class="py-4">{{$appointment->date}}</td>
                            <td class="py-4">{{$appointment->time}}</td>
                            <td class="py-4">{{$appointment->price}}$</td>
                            <td class="py-4">{{$appointment->doctor_name}}</td>
                            <td>
                                    {!!Form::open(['action'=>['ClinicsController@destroy', $appointment->id], 'method'=>'POST', 'class'=>'', 'stype'=>'display:inline !important;'])!!}
                                    
                                    {{-- SPOOFING METHOD --}}
                                    {{Form::hidden('_method','DELETE')}}
                                    {{Form::submit('Cancel Appointment',['class'=>'btn btn-md btn-danger'])}}
                                    <a class="my-2 btn  btn-warning "  href="{{url('clinics/'.$appointment->id.'/edit')}}">Edit</a>
                            <a class="my-2 fa fa-comment btn btn-lg btn-outline-primary "  href="#"  data-toggle="modal" data-target="#contact-doctor-modal-{{$appointment->id}}"></a>
                                    
                                {!!Form::close()!!}


                                <div class="modal fade" id="contact-doctor-modal-{{$appointment->id}}" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Contact Doctor</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        {!!Form::open(['action'=>['HomeController@createMessage', $appointment->doctor_id], 'method'=>'POST', 'class'=>''])!!}
                                        <div class="container">
                                          <textarea class="form-control" name="message_body" id="" rows='7'></textarea>
                                        {{-- SPOOFING METHOD --}}
                                        {{Form::hidden('_method','DELETE')}}
                                        {{Form::submit('Send Message',['class'=>'pull-left btn btn-md btn-outline-primary my-2'])}}
                                        </div>

                                    
                                        {!!Form::close()!!}
                                      </div>
                               
                                    </div>
                                  </div>
                                </div>
                            </td>
                          </tr>    
                     @endforeach
                    </tbody>
                  </table>
                  @else
                  <p class="center primary-color">No appointments.</p>
            @endif
            @else
            {{-- DOCTOR TABLE --}}
            @if(count($doctorAppointments)>0 && auth()->user()->type=='doctor')
            <table class="center table table-striped" style="color:black !important;">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Clinic</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Price</th>
                        <th scope="col">Patient Name</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($doctorAppointments as $appointment)
                     <tr>
                            <th class="py-4" scope="row">{{$loop->iteration}}</th>
                            <td class="py-4">{{$appointment->clinic_type}}</td>
                            <td class="py-4">{{$appointment->date}}</td>
                            <td class="py-4">{{$appointment->time}}</td>
                            <td class="py-4">{{$appointment->price}}$</td>
                            <td class="py-4">
                           @foreach ($patients as $patient)
                            @if($patient->id==$appointment->patient_id)
                              {{$patient->name ?? ' '}}
                            @endif    
                           @endforeach
                            </td>
                            <td>
                              
                              <a class="my-2 fa fa-comment btn btn-lg btn-outline-primary "  href="#"  data-toggle="modal" data-target="#contact-patient-modal-{{$appointment->id}}"></a>

                          <div class="modal fade" id="contact-patient-modal-{{$appointment->id}}" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Contact Patient</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  {!!Form::open(['action'=>['HomeController@createMessage', $appointment->patient_id], 'method'=>'POST', 'class'=>''])!!}
                                  <div class="container">
                                    <textarea class="form-control" name="message_body" id="" rows='7'></textarea>
                                  {{-- SPOOFING METHOD --}}
                                  {{Form::hidden('_method','DELETE')}}
                                  {{Form::submit('Send Message',['class'=>'pull-left btn btn-md btn-outline-primary my-2'])}}
                                  </div>

                              
                                  {!!Form::close()!!}
                                </div>
                         
                              </div>
                            </div>
                          </div>
                      </td>
                          </tr>    
                     @endforeach
                    </tbody>
                  </table>
                  @else
                  <p class="center primary-color">No appointments.</p>
            @endif
            @endif

            <hr>

            <h1 class="center">Messages</h1>
            @if(count($messages)>0)
              <div class="accordion" id="accordion-example">
              @foreach ($messages as $message)
                <div class="card select-subject card-{{$message->id}}">  
                  <div class="card-header" id="">
                    <h2 class="mb-0">
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-{{$message->id}}" aria-expanded="false" aria-controls="collapseOne">
                        @if($message->sender_id==auth()->user()->id)
                        To: {{$patients->find($message->receiver_id)->name}}
                        @else
                        From: {{$patients->find($message->sender_id)->name}}
                        @endif
                      </button>
                    </h2>
                  </div>

                  <div id="collapse-{{$message->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body" style="background:#333 !important;">
                     <p>{{$message->message_body}}</p>
                     <small class="pull-right">
                       Sent on {{$message->created_at}}
                     </small>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>

            @else
            <p class="center">No new messages.</p>
            @endif
    </div>
</div>
@endsection
<style>
    #main-footer {
        position: fixed;
        bottom: 0;
        width: 100%;
    }
</style>