<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\BasicSetting as BS;
use App\Models\BasicExtended as BE;
use App\Models\Language;
use App\Models\ShippingCharge;
use App\Models\OfflineGateway;

use App\Models\CartItem;
use App\Http\Resources\ProductResource;

use Session;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $products =Product::all();
        return response()->json($products);

        // }
        // return ProductResource::collection($products);
    }

    public function show($id){
        $products =Product::find($id);
        return response()->json($products);
    }

    public function checkout(){
        if (session()->has('lang')) {
            $currentLang = Language::where('code', session()->get('lang'))->first();
        } else {
            $currentLang = Language::where('is_default', 1)->first();
        }

        $data['shippings'] = ShippingCharge::where('language_id', $currentLang->id)->get();
        $data['ogateways'] = OfflineGateway::where('status', 1)->orderBy('serial_number')->get();

        return response()->json($data);


        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
