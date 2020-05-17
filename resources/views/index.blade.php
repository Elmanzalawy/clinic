@extends('layouts.app')

@section('content')
<div id="stage">
    <div class="container">
        <div class="stage-caption">
            <h1 class="mt-2 mb-2" style="color:white;"><span class="skyblue">O</span>nline<span
                    class="skyblue">C</span>linic</h1>
            <p class="lead " style="color:white;">A platform that allows patient to book appointments and communicate
                with doctors online.</p><br>
            <a href="#card-deck"
                class="btn btn-lg btn-outline-primary" >Book Appointment</a>
        </div>
    </div>
</div>
<div class="section-light" style="background:url('images/19377.jpg') center no-repeat; background-size:cover; ">
    <div class="container text-center">
        <h1 class='mb-4 center'>Available Clinics</h1>


        {{-- CARD DECK --}}
        <div id="card-deck" class="card-deck">
            @foreach($clinics as $clinic)
            <div class="clinic-card card mb-4" style="min-width: 20%;" onmouseover="clinicHover()">
                <a class="clinic-link" href="{{url('clinics/'.$clinic->id)}}">
                    <div class="card-body">
                        <h3 class="card-title">{{$clinic->name}}</h3>
                        <p><i>{{$clinic->type}}</i></p>
                    </div>
                </a>

            </div>
            @endforeach
        </div>


    </div>
</div>
<style>
    .card {
        border: 1px solid var(--primary-color);
        border-radius: 12px;
        background: linear-gradient(225deg, silver, #fff);
    }
.clinic-link{
    text-decoration: none !important;
    color: var(--primary-color) !important;
}
.clinic-card:hover{
    background:var(--secondary-color);
    color: var(--primary-color) !important;
    transition: background 0.3s ease-in-out;
}
</style>

@endsection
