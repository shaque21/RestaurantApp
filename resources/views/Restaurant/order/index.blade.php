@extends('layouts.restaurant');

@section('content')

    <main class="mt-3 p-3">
        <div class="container-fluid">
            <div class="row my-1">
                <div class="col-sm-9 col-md-8">
                    <div class="card card-stats card-round">
                        <div class="card-header bg-dark">
                            <div class="row">
                                <h4 class="text-uppercase text-white font-weight-bold">
                                    Order Foods
                                </h4>
                                @if (Session::has('success'))
                                    <script>
                                        swal({title: "Well Done !",text: "{{ Session::get('success') }}",
                                            icon: "success",timer: 3000
                                            });
                                    </script>
                                @endif
                                @if (Session::has('error'))
                                    <script>
                                        swal({title: "Opps !",text: "{{ Session::get('error') }}",
                                            icon: "error",timer: 3000
                                            });
                                    </script>
                                @endif
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table  class="table table-sm table-bordered table-striped table-hover order-table" id="ord_table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="width: 5%">#</th>
                                            <th style="width: 30%">Food Name<span class="text-danger">*</span></th>
                                            <th style="width: 15%">Qty<span class="text-danger">*</span></th>
                                            <th style="width: 15%">Price<span class="text-danger">*</span></th>
                                            <th style="width: 15%">Disc (%)</th>
                                            <th style="width: 15%">Total<span class="text-danger">*</span></th>
                                            <th style="width: 5%" class="text-center">
                                                <div class="add-btn d-flex justify-content-center align-items-center">
                                                    <a href="#" class="add_more">
                                                        <i class="bi bi-plus"></i>
                                                    </a>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="add_new_product">
                                        <tr>
                                            <td>01</td>
                                            <td>
                                                <select name="menu_id[]" class="select-option form-select form-select-sm product_id" id="mnu_id" 
                                                 aria-label=".form-select-sm example">
                                                    <option value="">Select Items</option>
                                                    @foreach ($menus as $menu)
                                                        <option data-price="{{ $menu->food_price }}"  value="{{ $menu->id }}">
                                                            {{ $menu->food_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('menu_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="number" name="quantity[]" id="quantity"
                                                class="form-control form-control-sm quantity" >
                                                @error('quantity')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="number" name="price[]" id="price"
                                                class="form-control form-control-sm price" readonly>
                                                @error('price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="number" name="discount[]" id="discount"
                                                class="form-control form-control-sm discount" >
                                            </td>
                                            <td>
                                                <input type="number" name="total_amount[]" id="total_amount"
                                                class="form-control form-control-sm total_amount" readonly>
                                                @error('total_amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td class="text-center">
                                                <div class="add-btn d-flex justify-content-center align-items-center bg-danger">
                                                    <a href="#" class="">
                                                        <i class="bi bi-dash"></i>
                                                    </a>
                                                </div>
                                                {{-- <a href="#" class="btn btn-danger btn-xs">
                                                    <i class="fas fa-times-circle fa-lg text-white"></i>
                                                </a> --}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-4 pay-section">
                    <div class="card card-stats card-round">
                        <div class="card-header d-flex justify-content-center align-items-center bg-dark ">
                            <h5 class="text-white text-uppercase" style="font-weight: 600;">
                                Total Amount : <b class="total">0</b><span style="font-size: 12px;">( BDT )</span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="btn-group btn-sm">
                                <a href="" class="btn btn-secondary btn-sm text-uppercase font-weight-bold">
                                    <i class="bi bi-file-earmark"></i>&nbsp; PDF
                                </a>
                                <button type="button" class="btn btn-dark btn-sm text-uppercase font-weight-bold" data-toggle="modal" data-target="#historyModal"
                                id="order_history"  >
                                    <i class="bi bi-clock-history"></i>&nbsp; HISTORY
                                </button>
                                <button type="button" class="btn btn-danger btn-sm text-uppercase font-weight-bold" data-toggle="modal" data-target="#dailyReportModal"
                                id="daily_report">
                                <i class="bi bi-bar-chart"></i>&nbsp; REPORT
                                </button>
                            </div>
                            <div class="col">
                                <table class="table table-striped customer-table">
                                    <tr>
                                        <td>
                                            <label class="font-weight-bold" for="customer_name">Customer Name</label>
                                            <input type="text" name="customer_name" id="customer_name"
                                            class="form-control form-control-sm">
                                        </td>
                                        <td>
                                            <label class="font-weight-bold" for="customer_mobile">Phone</label>
                                            <input type="text" name="customer_mobile" id="customer_mobile"
                                            class="form-control form-control-sm">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col">
                                <table class="table table-sm">
                                    <tr>
                                        <td>
                                            <p class="font-weight-bold">
                                                Payment Method
                                                <span class="text-danger">*</span>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" name="payment_method" id="payment_method"
                                                class="true" value="1" checked="checked" > &nbsp; &nbsp;
                                                <label for="payment_method" class="payment-method">
                                                    <i class="bi bi-cash text-success"></i>&nbsp; Cash
                                                </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" name="payment_method" id="payment_method"
                                                class="true" value="2"> &nbsp; &nbsp;
                                                <label for="payment_method" class="payment-method">
                                                   <i class="bi bi-building text-danger"></i>&nbsp; Bank Transfer
                                                </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" name="payment_method" id="payment_method"
                                                class="true" value="3" > &nbsp; &nbsp;
                                                <label for="payment_method" class="payment-method">
                                                    <i class="bi bi-credit-card text-info"></i>&nbsp; Credit Card
                                                </label>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col">
                                <label class="font-weight-bold" for="paid_amount">Pay Amount</label>
                                <span class="text-danger">*</span>
                                <input type="number" name="paid_amount" id="paid_amount"
                                class="form-control form-control-sm">
                                @error('paid_amount')
                                    <span class="alert alert-danger">{{ $message }}</span>
                                @enderror
                                <label class="font-weight-bold" for="change_balance">Returning Change</label>
                                <input type="number" readonly name="change_balance" id="change_balance"
                                class="form-control form-control-sm readonly">
                            </div>
                        </div>
                        <div class="card-footer">
                            @php
                                use Carbon\Carbon;
                            @endphp
                            <div class="form-group">
                                <label class="font-weight-bold" for="order_date">Date :</label>
                                <input type="date" name="order_date" readonly class="form-control form-control-sm readonly" value="{{ Carbon::now()->toDateString() }}">
                            </div>
                            

                            <div class="d-grid gap-2 my-2">
                                <button class="btn save-btn btn-sm"  onclick="storeOrder()">Save</button>
                            </div>
                        </div>
                    </div>
               
                </div>
            </div>

        </div>
    </main>

@endsection
@section('script')
    <script>
        $(document).ready(function(){

            $('#basic-datatables').DataTable({
			});
            // add new row
            $('.add_more').on('click',function(){
                var product = $('.product_id').html();
                // var food_name = $('.product_id').data('food_name');
                // console.log(food_name);
                var number_of_row = ($('.add_new_product tr').length - 0) + 1;
                if(number_of_row < 10){
                    number_of_row = '0' + number_of_row;
                }
                else{
                    number_of_row = number_of_row;
                }
                var tr ='<tr><td class="no">' + number_of_row + '</td>' +
                        '<td><select name="menu_id[]" class="select-option form-select form-select-sm product_id" id="mnu_id">' +
                        product +
                        '</select></td>' +
                        '<td><input type="number" name="quantity[]" id="quantity" class="form-control form-control-sm quantity" ></td>' +
                        '<td><input type="number" name="price[]" id="price" class="form-control form-control-sm price" readonly ></td>' +
                        '<td><input type="number" name="discount[]" id="discount" class="form-control form-control-sm discount" ></td>' +
                        '<td><input type="number" name="total_amount[]" id="total_amount" class="form-control form-control-sm total_amount" readonly ></td>' +
                        '<td class="text-center"><div class="add-btn d-flex justify-content-center align-items-center bg-danger delete"<a href="#" class=""></a><i class="bi bi-dash"></i></a></div></td></tr>';
                // $('.product_id').addClass('fstdropdown-select');
                $('.add_new_product').append(tr);

            });
            // Remove row from table
            $('.add_new_product').delegate('.delete','click',function(){
                $(this).parent().parent().remove();
            });
            //Total Amount that display In the right head section
            function TotalAmount(){
                var total = 0;
                $('.total_amount').each(function(i,e){
                    var amount = $(this).val() - 0;
                    total += amount;
                });
                total=parseFloat(total).toFixed(2);
                $('.total').html(total);
            }
            // when select a product then show the product price in the price field
            $('.add_new_product').delegate('.product_id','change',function(){
                var tr = $(this).parent().parent();
                var price = tr.find('.product_id option:selected').attr('data-price');
                tr.find('.price').val(price);
                var qty = tr.find('.quantity').val() - 0;
                var disc = tr.find('.discount').val() - 0;
                var price = tr.find('.price').val() - 0;
                var total_amount = parseFloat(qty * price) - ((qty * price * disc) / 100);
                tr.find('.total_amount').val(total_amount);
                TotalAmount();
            });
            // When keyup means put the quantity and discount(if any) then show the total
            // amount in total field and also display in the right head section
            $('.add_new_product').delegate('.quantity , .discount','keyup',function(){
                var tr = $(this).parent().parent();
                var qty = tr.find('.quantity').val() - 0;
                var disc = tr.find('.discount').val() - 0;
                var price = tr.find('.price').val() - 0;
                var total_amount = (qty * price) - ((qty * price * disc) / 100);
                tr.find('.total_amount').val(total_amount);
                TotalAmount();
            });
            // When put the given amount then show change balance in the returning change field
            $('#paid_amount').keyup(function(){
                var total = $('.total').html();
                var paid_amount = $(this).val();
                var change_balance = paid_amount - total;
                $('#change_balance').val(change_balance);
            });
            $(document).on('click','#order_history',function(){
                var last_order_id = $(this).data('id');
                $.ajax({
                    url:'{{ url("/admin/orders/get-last-order-history") }}',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data:{last_order_id:last_order_id},
                    success:function(data){
                        $('.modal-body').html(data)
                    }
                });
            });
        });
    function storeOrder(){
    var orders = [];
        $('#ord_table tbody tr').each(function (a,b) {
            var name=$('#mnu_id option:selected',b).val()
            var qty = $('#quantity',b).val();
            var disc = $('#discount',b).val();
            orders.push({ mnu_id: name, qty: qty,disc:disc });
           
        });
        var cus_name=$('#customer_name').val();
        var cus_mob=$('#customer_mobile').val();
        var cus_mob=$('#customer_mobile').val();
        var pay_method=$('input[name="payment_method"]:checked').val();
        alert(JSON.stringify("Hi"));

}
    </script>
@endsection
