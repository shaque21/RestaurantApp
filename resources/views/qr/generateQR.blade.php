@extends('layouts.restaurant')
@section('content')
<main class="mt-5 pt-3">
    <div class="container">
        <form class="row g-3 cart">
          <div class="col-md-3"></div>
          <div class="col-md-4">
            <label for="restaurant" class="form-label" style="font-weight:bold;font-size:20px;">Restaurant Url</label>
            <input type="text" class="form-control qr-url" id="restaurant" readonly value="{{url('').'/'.$restaurant->rstown_slug}}" style="font-style: italic;">
          </div>
          <div class="col-md-2">
            <label for="size" class="form-label" style="font-weight:bold;font-size:20px;">Image Size</label>
            <input type="number" class="form-control qr-size" id="size" value="128">
          </div>
          <div class="col-md-3"></div>
          <div class="col-md-3"></div>
          <div class="col-md-6 d-grid gap-2">
          	<button class="btn btn-warning generate-qr-code" type="button" style="color: white;">GenerateQR</button>
          </div><div class="col-md-3"></div>
          <div class="col-md-6 offset-3" id="qrcode" style="cursor:pointer;">
          	
          </div>
         
        
        </form>
    </div>
    <script type="text/javascript">
    	$('.generate-qr-code').on('click', function(){
    		console.log("clicked");
    	// Clear Previous QR Code
    	$('#qrcode').empty();

    	// Set Size to Match User Input
    	$('#qrcode').css({
    	'width' : $('.qr-size').val(),
    	'height' : $('.qr-size').val()
    	})
    	// Generate and Output QR Code
    	$('#qrcode').qrcode({
    		width: $('.qr-size').val(),
    		height: $('.qr-size').val(),
    		text: $('.qr-url').val()
    	});
    	var canvas = document.querySelector("#qrcode canvas");
    	 var img = canvas.toDataURL("image/png");
    	 $(canvas).on('click', function() {
    	   var dl = document.createElement('a');
    	   dl.setAttribute('href', img);
    	   dl.setAttribute('download', 'qrcode.png');
    	   dl.click();
    	   var url="https://github.com/hussain-mahamud/stupid-staff";


    	});
    	});
    </script>
</main>

@endsection