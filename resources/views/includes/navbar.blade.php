<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">

    <a class="navbar-brand" href="{{ url('/index') }}"><b>OnlineClinic</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav text-left">
      <li class="nav-item">
        <a class="nav-link" href="{{ url('/index') }}">Home <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           Clinics
        </a>

        
        
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          @foreach ($Clinics = DB::table('clinics')->orderBy('id')->get() as $Clinic)
          <a class="dropdown-item" href="{{url('clinics/'.$Clinic->id)}}">{{$Clinic->type}}</a>
          @endforeach
        </div>
      </li>



    </ul>
    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ml-auto">
      <!-- Authentication Links -->
      @guest
          <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
          @if (Route::has('register'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
          @endif
      @else
          <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
                  <a class="dropdown-item" href="{{ url('/dashboard') }}">Dashboard</a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </div>
          </li>
      @endguest
  </ul>
    </div>
    </nav>