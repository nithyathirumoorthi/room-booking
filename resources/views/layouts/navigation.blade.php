<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{ route('rooms.index') }}">{{ config('app.name', 'Laravel') }}</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
            <a class="nav-link" href="{{ route('rooms.index') }}">Rooms</a>
        </li>

        {{-- Customer Logged In --}}
        @auth
            <li class="nav-item">
                <a class="nav-link" href="{{ route('bookings.index') }}">My Bookings</a>
            </li>

            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-link nav-link" style="border:0;">Logout</button>
                </form>
            </li>
        @endauth

        {{-- Guest --}}
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
             {{-- Admin login link --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Admin Login</a>
            </li>
        @endguest

       

      </ul>
    </div>
  </div>
</nav>
