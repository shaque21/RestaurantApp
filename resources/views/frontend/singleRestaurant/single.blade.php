@extends('layouts.frontend', ['title' => 'Restaurant'])

@section('content')
{{-- banner section --}}
<div class="container-fluid">
    <div class="row header-section"
        style="background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),
        url({{ asset('components/assets/images/n3.jpg') }})
        no-repeat center center / cover;"
        >
        <div class="col-md-12 header-col d-flex align-items-center justify-content-center flex-column">
            <h4>Welcome To</h4>
            <h2>{{ $restaurant->restaurant_name }}</h2>
        </div>
    </div>
</div>
{{-- banner section --}}

{{-- address section --}}
<div class="container my-4">
    <div class="row address-section text-center">
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-4 column">
                    <i class="bi bi-clock"></i>
                    Opened until 23:58
                </div>
                <div class="col-md-4 column">
                    <i class="bi bi-geo-alt"></i>
                    {{ $restaurant->restaurant_address }}
                </div>
                <div class="col-md-4">
                    <i class="bi bi-phone"></i>
                    (+880) {{ $restaurant->phone }}
                </div>
            </div>
        </div>
    </div>
</div>
{{-- address section --}}

{{-- category section --}}
<div class="container-fluid menu-section">
    <div class="container mb-4 ">
        <div class="row pt-5 item-default  d-flex justify-content-center align-items-center">
            <div class="col-md-8 offset-2 category-btn d-flex flex-wrap">
                <a href="" class="buttons active m-3" data-filter="all">All Category</a>
                @foreach ($categories as $item)
                    <a href="" class="buttons m-3" data-filter="{{ $item->category_name }}">
                        {{ $item->category_name }}
                    </a>
                @endforeach

                {{-- <a href="" class="buttons  m-3" data-filter="burger">Burger</a>
                <a href="" class="buttons m-3" data-filter="pizza">Pizza</a>
                <a href="" class="buttons m-3" data-filter="noodles">Noodles</a>
                <a href="" class="buttons m-3" data-filter="chicken">Chicken</a> --}}
            </div>
        </div>
        <div class="row pt-5 item-dropdown">
            <div class="col-md-4 d-flex justify-content-center align-items-center">
                <div class="dropdown">
                    <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                      Select Category
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <li><a class="drop-buttons dropdown-item active" data-filter="all" href="#">All Category</a></li>

                      @foreach ($categories as $item)
                        <li>
                            <a class="drop-buttons dropdown-item" data-filter="{{ $item->category_name }}" href="#">
                                {{ $item->category_name }}
                            </a>
                        </li>
                      @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @foreach ($categories as $item)
        <div class="row d-flex flex-wrap">


            <h2 class="my-5 category-div
                        {{ $item->category_name }}
                        ">

                        {{ $item->category_name }}
                        </h2>
            @foreach ($menus as $menu)

            @if($menu->category_id == $item->id)
            <div class="col-md-4 category-div {{ $menu->category_name }}">

                <div class="card mb-3">
                    <div class="photo"  onclick="viewItem('{{ $menu->food_slug }}')">
                        <img src="{{ asset('uploads/restaurant/menu/'.$menu->food_photo) }}" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                      <h5 class="card-title viewTitle" onclick="viewItem('{{ $menu->food_slug }}')">{{ $menu->food_name }}</h5>
                      <p class="card-text">
                        {{ substr($menu->food_description, 0, 80) }}...
                      </p>
                      <p class="card-text"><small class="text-muted">Price : $ {{ $menu->food_price }}</small></p>
                    </div>
                </div>

            </div>
            @endif


            @endforeach
        </div>
        @endforeach

    </div>
</div>

<!-- Item Details Modal -->
<div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Jamboo Burger</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="card mb-3">
                        <div class="item-img">
                            <img src="" id="view_photo" class="card-img-top" alt="...">
                        </div>
                    </div>
                </div>
                <div class="col-md-7 p-4">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">
                                <small class="text-muted">Price : $ <span id="view_price"></span>
                                </small>
                            </p>
                            <h5 class="card-title my-3">Description : </h5>
                            <p class="card-text my-1" id="view_description">

                            </p>
                            <div class="item-form my-3">
                                <form action="">
                                    <div class="mb-5 ms-4">
                                        <label for="quantity" class="form-label">Quantity </label>
                                        <input type="number" class="form-control item-form-control form-control-sm" id="quantity" name="quantity" >
                                    </div>
                                    <div class="my-4 text-center">
                                        <button type="submit" class="item-modal-btn">
                                            <i class="bi bi-cart-plus"></i>
                                            Add To Cart
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

{{-- view cart section --}}
<div class="addToCart-btn">
    <button class="btn btn-primary" type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasScrolling"
        aria-controls="offcanvasScrolling">
        <i class="bi bi-cart-check"></i>
        View Cart
        <span class="badge bg-danger">4</span>
    </button>
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Colored with scrolling</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <p>Try scrolling the rest of the page to see this option in action.</p>
        </div>
      </div>
</div>

{{-- category section --}}
<footer class="my-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                All ©Copy Right Are Riserved 2021
            </div>
        </div>
    </div>
</footer>
@endsection
@section('script')
<script>



    $(document).ready(function(){

        $('.buttons').click(function(e){

            e.preventDefault();

            $(this).addClass('active').siblings().removeClass('active');

            const filter = $(this).attr('data-filter')

            if(filter == 'all'){
                $('.category-div').show();
            }else{
                $('.category-div').not('.'+filter).hide();
                $('.category-div').filter('.'+filter).show();
            }

        });

    });
    $(document).ready(function(){

        $('.drop-buttons').click(function(e){

            e.preventDefault();

            $(this).addClass('.dropdown-item.active').siblings().removeClass('.dropdown-item.active');

            const filter = $(this).attr('data-filter')

            if(filter == 'all'){
                $('.category-div').show();
            }else{
                $('.category-div').not('.'+filter).hide();
                $('.category-div').filter('.'+filter).show();
            }

        });

    });
    var config = {
        routes: {
            view: "{!! route('food.view') !!}",
        }
    }


    var image_path = "{!! asset('uploads/restaurant/menu/') !!}";

    function viewItem(food_slug) {
        $.ajax({
            url: config.routes.view,
            method: "POST",
            data: {
                food_slug: food_slug,
                _token: "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(response) {
                if (response.success == true) {
                    $('.modal-title').text(response.data.food_name);
                    $('#view_description').text(response.data.food_description);
                    $('#view_price').text(response.data.food_price);
                    $('#view_photo').attr('src',image_path + '/' +response.data.food_photo);



                    $('#itemModal').modal('show');

                } //success end

            }
        }); //ajax end
    }


</script>
@endsection
