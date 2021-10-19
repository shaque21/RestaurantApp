<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#sidebar"
        aria-controls="offcanvasExample"
      >
        <span class="navbar-toggler-icon d-flex justify-content-center align-items-center" data-bs-target="#sidebar">
          <i class="bi bi-justify text-white" data-bs-target="#sidebar"></i>
        </span>
      </button>
      <a
        class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold"
        href="#"
        >Samsul Haque</a
      >
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#topNavBar"
        aria-controls="topNavBar"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="three-dot navbar-toggler-icon d-flex justify-content-center align-items-center"><i class="bi bi-three-dots-vertical text-white"></i></span>
      </button>
      <div class="collapse navbar-collapse" id="topNavBar">


        <form class="d-flex ms-auto my-3 my-lg-0">
        </form>

        <div class="profile-pic ms-4">
            @if (Auth::user()->photo != '')
            <a href="{{ url('/admin/profile') }}">
                <img src="{{ asset('uploads/admin/'.Auth::user()->photo) }}" alt="">
            </a>
            {{-- <img  src="{{ asset('uploads/admin/'.$user->photo) }}" alt="Photo" width="150px"> --}}
            @else
            <a href="{{ url('/admin/profile') }}">
                <img src="{{ asset('components/assets/images/avarter.jpg') }}" alt="Photo">
            </a>
            @endif
        </div>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle ms-2 name-text"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
            >
            <span class="badge rounded-pill bg-primary text-white">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="{{ url('admin/profile') }}"><i class="bi bi-person fw-bolder text-primary me-2"></i> Profile</a></li>
              <li><a class="dropdown-item" href="{{ url('admin/profile/edit') }}"><i class="bi bi-pencil-square fw-bolder text-primary me-2"></i> Edit Profile</a></li>
              <li class="my-2"><hr class="dropdown-divider bg-dark" /></li>
              <li>
                  <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                      <i class="bi bi-power fw-bolder"></i>
                      Log out
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
              </li>
            </ul>
          </li>
        </ul>


      </div>
    </div>
  </nav>
