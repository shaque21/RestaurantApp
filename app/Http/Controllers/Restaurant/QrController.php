<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;

class QrController extends Controller
{
    public function generateQrCode(){
    	$restaurant=Restaurant::where('rstown_id',Auth::user()->id)
    				->select('rstown_slug')->first();
    	return view('qr.generateQR',['restaurant'=>$restaurant]);
    }
}
