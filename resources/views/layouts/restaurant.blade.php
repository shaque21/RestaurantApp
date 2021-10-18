<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Restaurent Owner Dashboard</title>

    @include('layouts.admin.css')

  </head>
  <body>

    @php
        $user_id = Auth::user()->id;
        $restaurant = App\Models\Restaurant::where('rstown_id', $user_id)->firstOrFail();
        // dd($restaurant);
    @endphp
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
            class="navbar-brand restaurant-brand me-auto ms-lg-0 ms-5 text-uppercase fw-bold"
            href="#"
            >{{ $restaurant->restaurant_name }}</a
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
            <div class="view_restaurant ms-4">
                <a href="{{ url('restaurant/'.$restaurant->rstown_slug) }}">
                    <i class="bi bi-building"></i>
                    Restaurant
                </a>
            </div>

            <div class="profile-pic ms-4">
                @if (Auth::user()->photo != '')
                <a href="{{ url('/restaurant/profile') }}">
                    <img src="{{ asset('uploads/admin/'.Auth::user()->photo) }}" alt="">
                </a>
                {{-- <img  src="{{ asset('uploads/admin/'.$user->photo) }}" alt="Photo" width="150px"> --}}
                @else
                <a href="{{ url('/restaurant/profile') }}">
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

    <!-- top navigation bar -->



    <!-- offcanvas sidebar  -->
    <div class="offcanvas offcanvas-start sidebar-nav bg-dark" tabindex="-1" id="sidebar">
        <div class="offcanvas-body p-0">
          <nav class="navbar-dark">
            <ul class="navbar-nav">

                @php
                $user_id = Auth::user()->id;
                $status = App\Models\Restaurant::where('rstown_id',$user_id)->firstOrFail();
              @endphp
              @if($status->rst_status == 1)
              <li>
                <a href="{{ url('/restaurant/dashboard') }}" class="nav-link px-3 {{Request::is('restaurant/dashboard')? 'active':''}}">
                  <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                  <span>Dashboard</span>
                </a>
              </li>
              @endif

              <li class="ms-3 my-3">
                <div class="muted-text">
                    <span>Components</span>
                </div>
              </li>
              <li class="mb-4"><hr class="dropdown-divider bg-light" /></li>

              <li>
                <a href="{{ url('restaurant/profile') }}" class="nav-link px-3 {{Request::is('restaurant/profile')? 'active':''}}">
                  <span class="me-2"><i class="bi bi-person"></i></span>
                  <span>Profile</span>
                </a>
              </li>



              @if($status->rst_status == 1)


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
                <a href="{{ route('food.category.all') }}" class="nav-link px-3 {{ (request()->segment(2) == 'food') ? 'active' : '' }}">
                  <span class="me-2"><i class="bi bi-basket"></i></span>
                  <span>Manage Category</span>
                </a>
              </li>
              <li>
                <a href="{{ route('menu.all') }}" class="nav-link px-3 {{ (request()->segment(2) == 'menu') ? 'active' : '' }}">
                  <span class="me-2"><i class="bi bi-menu-down"></i></span>
                  <span>Manage Menu</span>
                </a>
              </li>
              <li>
                <a href="{{ route('orders.all') }}" class="nav-link px-3 {{ (request()->segment(2) == 'orders') ? 'active' : '' }}">
                  <span class="me-2"><i class="bi bi-bag-check text-bold"></i></span>
                  <span>Manage Orders</span>
                </a>
              </li>



              @endif



            </ul>
          </nav>
        </div>
      </div>
    <!-- offcanvas  sidebar -->



    <!-- Main contents -->
    @yield('content')
    <!-- Main contents -->

    @include('layouts.admin.jsFileLink')

    @yield('script')
  </body>
</html>
