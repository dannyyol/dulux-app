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
use App\Models\Pcategory;

use App\Http\Resources\ProductResource;

use Session;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function filterProduct(Request $request, $pcatId, $catId, $id){
    //     $q = array_keys($request->all());
    //     if($q[0] == 'All'){
    //         $pcategory= Pcategory::find($id);
    //         $data = $pcategory->ColourCategory()->where('id', $catId)->get();
    //         return response()->json($data);
    //     }
    //     $data  = Product::whereHas('subcategory', function($query) use($q) { //whereHas joined event with subcategory model
    //     $query->where('name','LIKE','%'.$q[0].'%');
    //   })
    //   ->paginate('4')
    //   ->setpath('');
      
    //   $data->appends(array(
    //     'q'=>$q[0],
    //   ));
        $q = array_keys($request->all());
        // dd($q);
        if($q[0] == 'All'){
            $data = \DB::table('pcategories AS pcat')
            ->join('product_colours AS pc', 'pc.category_id', '=', 'pcat.id')
            ->join('products AS p', 'p.product_colour_id', '=', 'pc.id')
            ->where(['pc.category_id'=> $pcatId, 'p.product_colour_id'=>$id, 'p.status'=>1,])
            ->select('p.*')->get();
            return response()->json($data);
        } else {
            
            $data = \DB::table('pcategories AS pcat')
            ->join('subcategories AS sb', 'sb.category_id', '=', 'pcat.id')
            ->join('product_colour_subcategory AS pcs', 'pcs.subcategory_id', '=', 'sb.id')
            ->join('product_colours AS pc', 'pc.id', '=', 'pcs.product_colour_id')
            ->join('products AS p', 'p.product_colour_id', '=', 'pc.id')
            ->where(['pc.category_id'=> $pcatId, 'sb.id'=> $q[0]])
            ->select('p.*')->paginate(10);
        }
        

    // dd($data);
        return response()->json($data);

    // return response()->json(["statusCode" => "200", "data"=>$data]);

    }

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
