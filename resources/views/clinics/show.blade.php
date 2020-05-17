@extends('layouts.app')
@section('content')
<style>
    body {
        background: url("../images/background.jpeg") no-repeat center;
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
    <div class="jumbotron">
        <div id="dark-bg">
            <h1 class="center">
                {{$clinic->type}}
            </h1>

            @if(count($doctors)>0)
            <table class="center table table-striped" style="color:white !important;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Doctor Name</th>
                        <th scope="col">Shift</th>
                        <th scope="col">Email</th>
                        @if(auth()->user()->type == 'patient')
                        <th scope="col">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($doctors as $doctor)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$doctor->name}}</td>
                        <td>{{$doctor->shift}}</td>
                        <td>{{$doctor->email}}</td>

                        @if(auth()->user()->type == 'patient')
                        <td>
                            <a href="{{url('clinics/'.$clinic->id.'/create')}}" class="btn btn-outline-primary">Book
                                Appointment</a>
                        </td>
                        @endif

                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p class="center primary-color">No doctors available.</p>
            @endif


        </div>
    </div>
</div>


<style>
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
        width: auto;

    }

</style>
@endsection
