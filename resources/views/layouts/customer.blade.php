<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Customer Dashboard</title>

    <link rel="stylesheet" href="{{ asset('components/assets') }}/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="{{ asset('components/assets') }}/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="{{ asset('components/assets') }}/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="{{ asset('components/assets') }}/css/style.css" />

  </head>
  <body>


    <!-- top navigation bar -->
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
            <div class="input-group">
              <input
                class="form-control"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i>
              </button>
            </div>
          </form>


          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle ms-2"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
              <i class="bi bi-person-fill"></i> <span class="badge rounded-pill bg-primary text-white"> Samsul Haque</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#"><i class="bi bi-person fw-bolder text-primary"></i> Profile</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
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
    <!-- top navigation bar -->



    <!-- offcanvas sidebar  -->
    <div class="offcanvas offcanvas-start sidebar-nav bg-dark" tabindex="-1" id="sidebar">
        <div class="offcanvas-body p-0">
          <nav class="navbar-dark">
            <ul class="navbar-nav">

              <li>
                <a href="#" class="nav-link px-3 active">
                  <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                  <span>Dashboard</span>
                </a>
              </li>

              <li class="ms-3 my-3">
                <div class="muted-text">
                    <span>Components</span>
                </div>
              </li>

              <li class="mb-4"><hr class="dropdown-divider bg-light" /></li>

              <li>
                <a
                  class="nav-link px-3 sidebar-link"
                  data-bs-toggle="collapse"
                  href="#layouts"
                >
                  <span class="me-2"><i class="bi bi-layout-split"></i></span>
                  <span>Pages</span>
                  <span class="ms-auto">
                    <span class="right-icon">
                      <i class="bi bi-chevron-down"></i>
                    </span>
                  </span>
                </a>
                <div class="collapse" id="layouts">
                  <ul class="navbar-nav">
                    <li>
                      <a href="#" class="nav-link px-3">
                        <span class="me-2">
                          <i class="bi bi-dot"></i>
                        </span>
                        <span>dropdown-link</span>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="nav-link px-3">
                        <span class="me-2">
                          <i class="bi bi-dot"></i>
                        </span>
                        <span>dropdown-link</span>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="nav-link px-3">
                        <span class="me-2">
                          <i class="bi bi-dot"></i>
                        </span>
                        <span>dropdown-link</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>


              <li>
                <a href="profile.html" class="nav-link px-3">
                  <span class="me-2"><i class="bi bi-person"></i></span>
                  <span>Profile</span>
                </a>
              </li>


            </ul>
          </nav>
        </div>
      </div>
    <!-- offcanvas  sidebar -->



    <!-- Main contents -->
    @yield('content')
    <!-- Main contents -->


    <script src="{{ asset('components/assets') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('components/assets') }}/js/jquery-3.5.1.js"></script>
    <script src="{{ asset('components/assets') }}/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('components/assets') }}/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('components/assets') }}/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('components/assets') }}/js/jszip.min.js"></script>
    <script src="{{ asset('components/assets') }}/js/pdfmake.min.js"></script>
    <script src="{{ asset('components/assets') }}/js/vfs_fonts.js"></script>
    <script src="{{ asset('components/assets') }}/js/buttons.html5.min.js"></script>
    <script src="{{ asset('components/assets') }}/js/buttons.print.min.js"></script>
    <script src="{{ asset('components/assets') }}/js/script.js"></script>
    @yield('script')
  </body>
</html>
