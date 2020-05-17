@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="type" id="type" onchange="changeForm()">
                                    <option value="patient">Patient</option>
                                    <option value="doctor">Doctor</option>
                                </select>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row patient-form">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Credit Card Number') }}</label>

                            <div class="col-md-6">
                                <input class="form-control" type="text" name="creditcard_number">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row patient-form">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Credit Card Expiration Date') }}</label>

                            <div class="col-md-6">
                                <input class="form-control" type="date" name="creditcard_expire">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row clinic">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Clinic') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="clinic" id="clinic">
                                    <option value=""></option>
                                        @foreach($clinics as $clinic)
                                        <option value="{{$clinic->name}}">{{$clinic->type}}</option>
                                    @endforeach
                                </select>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row clinic">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Shift') }}</label>
    
                                <div class="col-md-6">
                                    <select class="form-control" name="shift" id="shift">
                                        <option value=""></option>
                                            <option value="00:00 - 08:00">00:00 - 08:00</option>
                                            <option value="08:00 - 16:00">08:00 - 16:00</option>
                                            <option value="16:00 - 00:00">16:00 - 00:00</option>
                                    </select>
    
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
    


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #main-footer {
        position: absolute;
        bottom: 0;
        width: 100%;
    }

</style>
<script>
    var clinic = $('.clinic');
    clinic.hide();
    var patientForm = $('.patient-form');
    function changeForm() {
        var type = $('#type').val();

        if(type=='doctor'){
            clinic.show();
            patientForm.hide();
        }
        else if(type=='patient'){
            clinic.hide();
            patientForm.show();
        }

    }

</script>
@endsection
