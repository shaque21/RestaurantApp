<div class="offcanvas offcanvas-start sidebar-nav " tabindex="-1" id="sidebar">
    <div class="offcanvas-body p-0">
      <nav class="navbar-dark">
        <ul class="navbar-nav">

          <li>
            <a href="{{ url('admin/dashboard') }}" class="nav-link px-3 {{Request::is('admin/dashboard')? 'active':''}}">
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
            <a href="{{ url('/admin/profile') }}" class="nav-link px-3 {{Request::is('admin/profile')? 'active':''}}">
              <span class="me-2"><i class="bi bi-person"></i></span>
              <span>Profile</span>
            </a>
          </li>

          <li>
              <a href="{{ url('/admin/users') }}" class="nav-link px-3 {{Request::is('admin/users')? 'active':''}}">
                <span class="me-2"><i class="bi bi-people"></i></span>
                <span>Manage Users</span>
              </a>
          </li>
          <li>
              <a href="{{ route('restaurent.all') }}" class="nav-link px-3 {{Request::is('admin/restaurents')? 'active':''}}">
                <span class="me-2"><i class="bi bi-building"></i></span>
                <span>Manage Restaurents</span>
              </a>
          </li>
          <li>
              <a href="{{ url('/admin/recycle') }}" class="nav-link px-3 {{Request::is('admin/recycle')? 'active':''}}">
                <span class="me-2"><i class="bi bi-arrow-repeat"></i></span>
                <span>Recycle Bin</span>
              </a>
          </li>


        </ul>
      </nav>
    </div>
  </div>
