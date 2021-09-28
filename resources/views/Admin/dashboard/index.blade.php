@extends('layouts.admin')
@section('content')
<main class="mt-5 pt-3">
    <div class="container-fluid">


      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-secondary" role="alert">
            <h4>Admin Dashboard</h4>
          </div>
        </div>
      </div>

      <!-- content card icon section -->
      <div class="row">
        <div class="col-md-3 mb-3">
          <div class="card bg-light text-white h-100">
            <div class="card-body py-3">
              <div class="row">
                <div class="col-sm-4 card-icon d-flex justify-content-center align-items-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="col-sm-8 d-flex mt-2 align-items-center text-dark flex-column">
                  <div class="row"><div class="col-12 fs-5 card-icon-head"><p>Users</p></div></div>
                  <div class="row"><div class="col-12 card-icon-count">110</div></div>
                </div>
              </div>
            </div>
            <div class="card-footer d-flex text-dark">
              View Details
              <span class="ms-auto">
                <i class="bi bi-chevron-right"></i>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="card bg-light text-white h-100">
            <div class="card-body py-3">
              <div class="row">
                <div class="col-sm-4 card-icon d-flex justify-content-center align-items-center">
                  <i class="bi bi-columns-gap"></i>
                </div>
                <div class="col-sm-8 d-flex mt-2 align-items-center text-dark flex-column">
                  <div class="row"><div class="col-12 fs-5 card-icon-head"><p>Products</p></div></div>
                  <div class="row"><div class="col-12 card-icon-count">110</div></div>
                </div>
              </div>
            </div>
            <div class="card-footer d-flex text-dark">
              View Details
              <span class="ms-auto">
                <i class="bi bi-chevron-right"></i>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="card bg-light text-white h-100">
            <div class="card-body py-3">
              <div class="row">
                <div class="col-sm-4 card-icon d-flex justify-content-center align-items-center">
                  <i class="bi bi-graph-up"></i>
                </div>
                <div class="col-sm-8 d-flex mt-2 align-items-center text-dark flex-column">
                  <div class="row"><div class="col-12 fs-5 card-icon-head"><p>Sales</p></div></div>
                  <div class="row"><div class="col-12 card-icon-count">$ 11,110</div></div>
                </div>
              </div>
            </div>
            <div class="card-footer d-flex text-dark">
              View Details
              <span class="ms-auto">
                <i class="bi bi-chevron-right"></i>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="card bg-light text-white h-100">
            <div class="card-body py-3">
              <div class="row">
                <div class="col-sm-4 card-icon d-flex justify-content-center align-items-center">
                  <i class="bi bi-check-circle"></i>
                </div>
                <div class="col-sm-8 d-flex mt-2 align-items-center text-dark flex-column">
                  <div class="row"><div class="col-12 fs-5 card-icon-head"><p>Orders</p></div></div>
                  <div class="row"><div class="col-12 card-icon-count">1,105</div></div>
                </div>
              </div>
            </div>
            <div class="card-footer d-flex text-dark">
              View Details
              <span class="ms-auto">
                <i class="bi bi-chevron-right"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
      <!-- content card icon section -->


      <!-- chart area  -->

      <!-- chart area -->

    </div>
</main>
@endsection
@section('script')

@endsection
