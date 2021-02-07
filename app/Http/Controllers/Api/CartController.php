<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Product;
use App\Models\CartItem;

use App\Models\BasicSetting as BS;
use App\Models\BasicExtended as BE;
use App\Models\ShippingCharge;
use App\Models\ProductReview;
use Auth;
use App\Models\Pcategory;
use App\Models\Language;
use App\Models\OfflineGateway;
use App\Models\PaymentGateway;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $cart_key = Session::get('cart_key');
        $data=  CartItem::where('cart_key', $cart_key['cart_key'])->get();
        foreach($data as $key=>$cart){
            $data[$key]['product_colour'] = $cart->product->productColour;
        }
        return response()->json($data);
    }


    public function show($id){
        $cart_key = Session::get('cart_key');
        $carts =CartItem::where('product_id', $id)->where('cart_key', $cart_key['cart_key'])->get();
        return response()->json(3);
    }


    public function cartDetail($id)
    {
        // dd('$id');
        $cart_key = Session::get('cart_key');
        $cart = CartItem::where('product_id', $id)->where('cart_key', $cart_key['cart_key'])->first();
        return response()->json($cart);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 

    // public function addProduct(Request $request, $id){
    //     $name = $request['name'];//remove null values from array
    //     $qty = $request['qty']; //remove null values from array
    //     $price = $request['price2'];//remove null values from array

    //     $cart_key = Session::get('cart_key');
    
    //     $product = Product::where('id', $id)->first();
    //     $check_if_product_in_cart = CartItem::where(['product_id'=> $id, 'cart_key'=>$cart_key['cart_key']])->first();
    //     if($check_if_product_in_cart){
    //         $cart_key = Session::get('cart_key');
    //         // $subtotal = $product_cart->product_quantity * $product_cart->product_price;
    //         $data = CartItem::where(['product_id'=> $id, 'cart_key'=>$cart_key['cart_key']])
    //                     ->update(['product_quantity'=>$qty,'sub_total'=>$price]);
    //         $product_cart = CartItem::where('product_id',$id)->first();
            
    //         // CartItem::where('product_id',$id)->update(['sub_total'=> $subtotal]);
    //     }else{
    //         $data = [];
    //         $data['product_id'] = $id;
    //         $data['product_name'] = $product->title;
    //         $data['product_quantity'] = $qty;
    //         $data['product_price'] = $product->current_price;
    //         $data['feature_image'] = $product->feature_image;
    //         $data['sub_total'] = $price;
    //         $data['cart_key'] = $cart_key['cart_key'];
    //         $data['created_at'] = date("Y-m-d H:i:s");
    //         $data['updated_at'] = date("Y-m-d H:i:s");
    //         CartItem::insert($data);
    //     }
    //     return response()->json($data);
    // }

    // Addon submit button
    public function addVariation(Request $request, $id){
        // dd($request->all());
        $name = array_filter($request['name'], 'strlen');//remove null values from array
        $qty = array_filter($request['qty'], 'strlen'); //remove null values from array
        $price = array_filter($request['price'], 'strlen');//remove null values from array

        $nameQtyPrice = array_map(function ($name, $qty, $price) { //Map array and rearrange according to their index
            return array_combine(['name', 'qty', 'price'], [$name, $qty, $price]);
        }, $name, $qty, $price);

        // dd($nameQtyPrice);

        if(!empty($nameQtyPrice)){
            $variationToJson = json_encode($nameQtyPrice); //convert to json
            $variationTotal = 0;
            foreach($nameQtyPrice as $nqp){
                $variationTotal += $nqp['price'] * $nqp['qty']; // Get total price of addon
            // Check if quantity is not zero
            if($nqp['qty'] < 1){ 
                return response()->json(["status_code" => "AB", "message"=>"Quantity must not be zero",]);
                }
            }
        } else {
            return response()->json(["status_code" => "AC", "message"=>"Cart must not be empty",]);
        }
        
        $cart_key = Session::get('cart_key');
        $product = Product::where('id', $id)->first();
        // dd($product);
        //Check if product cart exist
        $check_if_product_in_cart = CartItem::where(['product_id'=> $id, 'cart_key'=>$cart_key['cart_key']])->first();
        if($check_if_product_in_cart){
            $cart_key = Session::get('cart_key');
            if($check_if_product_in_cart->variations ==null || $check_if_product_in_cart->variations != null){ //Check if addon col is empty
                // dd($addOntotal);
                // update the addon here
                CartItem::where(['product_id'=> $id, 'cart_key'=>$cart_key['cart_key']])
                    ->update(['variations'=>$variationToJson,'sub_total'=>
                    $check_if_product_in_cart->sub_total+$variationTotal]);
            }
            
                    
        }else{
            // dd($product);

            $data = [];
            $cart = new CartItem();
            $cart->product_id= $id;
            $cart->product_name = $product->title;
            $cart->product_quantity= 1;
            $cart->product_price = $product->current_price;
            $cart->feature_image = $product->feature_image;
            $cart->sub_total = $nameQtyPrice[0]['price'];
            $cart->cart_key = $cart_key['cart_key'];
            $cart->created_at = date("Y-m-d H:i:s");
            $cart->updated_at = date("Y-m-d H:i:s");
            if($cart->save()){
                if($product->variations){
                    $cart->variations = $variationToJson;
                    $cart->update();
                }
            }
        }
        return response()->json("Cart Added Successfully");
    }

    // Addon submit button
    public function addAddOn(Request $request, $id){
        $name = array_filter($request->productAddons['name'], 'strlen');//remove null values from array
        $qty = array_filter($request->productAddons['qty'], 'strlen'); //remove null values from array
        $price = array_filter($request->productAddons['price'], 'strlen');//remove null values from array

        $nameQtyPrice = array_map(function ($name, $qty, $price) { //Map array and rearrange according to their index
            return array_combine(['name', 'qty', 'price'], [$name, $qty, $price]);
        }, $name, $qty, $price);

        if(!empty($nameQtyPrice)){
            $addOnToJson = json_encode($nameQtyPrice); //convert to json

            $addOntotal=0;
            foreach($nameQtyPrice as $nqp){
                $nqp['price'];
                $addOntotal += $nqp['price'] * $nqp['qty']; // Get total price of addon
                // Check if quantity is not zero
                if($nqp['qty'] < 1){
                    return response()->json(["status_code" => "AB", "message"=>"Quantity must not be zero",]);
                }
            }
        } else {
            return response()->json(["status_code" => "AC", "message"=>"Cart must not be empty",]);
        }

        
 
        // dd(array_merge_recursive($request->productAddons['name'],$request->productAddons['qty']));

        $cart_key = Session::get('cart_key');
        $product = Product::where('id', $id)->first();
        // dd($product);
        //Check if product cart exist
        $check_if_product_in_cart = CartItem::where(['product_id'=> $id, 'cart_key'=>$cart_key['cart_key']])->first();
        if($check_if_product_in_cart){
            $cart_key = Session::get('cart_key');
            if($check_if_product_in_cart->addons ==null || $check_if_product_in_cart->addons != null){ //Check if addon col is empty
                // dd($addOntotal);
                // update the addon here
                CartItem::where(['product_id'=> $id, 'cart_key'=>$cart_key['cart_key']])
                        ->update(['addons'=>$addOnToJson,'sub_total'=>
                        $check_if_product_in_cart->sub_total+$addOntotal]);
            }
                    
        }else{
            // dd($product);

            $data = [];
            $cart = new CartItem();
            $cart->product_id= $id;
            $cart->product_name = $product->title;
            $cart->product_quantity= 1;
            $cart->product_price = $product->current_price;
            $cart->feature_image = $product->feature_image;
            $cart->sub_total = $product->current_price + $addOntotal;
            $cart->cart_key = $cart_key['cart_key'];
            $cart->created_at = date("Y-m-d H:i:s");
            $cart->updated_at = date("Y-m-d H:i:s");
            if($cart->save()){
                if($product->addons){
                    $cart->addons = $addOnToJson;
                    $cart->update();
                }
            }
        }
        return response()->json("Cart Added Successfully");
    }

    public function addToCart(Request $request, $id)
    {   
        $cart_key = Session::get('cart_key');
        $product = Product::where('id', $id)->first();
        $request->all();
        if($product->id == $request->litres['id']){
            $check_if_litres_in_cart = CartItem::where(['product_id'=> $id, 'cart_key'=>$cart_key['cart_key']])->first();
            // for litres
            $litre_array[0]['id'] = $id;
            $litre_array[0]['name'] = $request->litres['name'];
            $litre_array[0]['price'] = $request->litres['price'];
            $litre_array[0]['qty'] = $request->litres['qty'];

            dd($litre_array);

            // for product addons
            $name = array_filter($request->productAddons['name'], 'strlen');//remove null values from array
            $qty = array_filter($request->productAddons['qty'], 'strlen'); //remove null values from array
            $price = array_filter($request->productAddons['price'], 'strlen');//remove null values from array
            $nameQtyPrice = array_map(function ($name, $qty, $price) { //Map array and rearrange according to their
            return array_combine(['name', 'qty', 'price'], [$name, $qty, $price]);
            }, $name, $qty, $price);
            
            $addOnToJson = json_encode($nameQtyPrice); //convert to json
            // dd($addOnToJson);
            if($check_if_litres_in_cart){
                // dd('exist');
                $decodeLitres = json_decode($check_if_litres_in_cart->variations, true);
                $cart_key = Session::get('cart_key');
                // foreach($decodeLitres as $key=>$litre){
                    if(array_search($request->litres['name'], array_column($decodeLitres, 'name')) !== false) {
                        // $litre['qty'] += $request->litres['qty'];
                        // $litre_array[0]['qty'] = $litre['qty'];
                        // $data = CartItem::where('product_id',$id)->update(['variations'=>json_encode($litre_array)]);
                    } else {
                        $dbvariations = $decodeLitres;
                        array_push($dbvariations, $request->litres);
                        $data = CartItem::where('product_id',$id)->update(['variations'=>json_encode($dbvariations)]);
                    }
                // }
                if(!empty($addOnToJson)){
                    $data = CartItem::where('product_id',$id)->update(['addons'=>$addOnToJson]);
                } 
            }else{
                    $litresToJson = json_encode($litre_array); //convert to json
                    $data = [];
                    $data['product_id'] = $id;
                    $data['product_name'] = $product->title;
                    $data['product_quantity'] = 1;
                    $data['product_price'] = $product->current_price;
                    $data['feature_image'] = $product->feature_image;
                    $data['sub_total'] = $product->current_price;
                    $data['addons'] = empty($addOnToJson) ? null : $addOnToJson;
                    $data['variations'] = $litresToJson;
                    $data['cart_key'] = $cart_key['cart_key'];
                    $data['created_at'] = date("Y-m-d H:i:s");
                    $data['updated_at'] = date("Y-m-d H:i:s");
                    CartItem::insert($data);
            }
            return response()->json($data);

        }
        return response()->json(["status_code"=>"AC", "message"=>"Litres must not be empty"]);

    }

    // public function 


    // public function index()
    // {
    // if (session()->has('lang')) {
    //     $currentLang = Language::where('code', session()->get('lang'))->first();
    // } else {
    //     $currentLang = Language::where('is_default', 1)->first();
    // }

    // if (Session::has('cart')) {
    // $cart = Session::get('cart');
    // } else {
    // $cart = null;
    // }

    // // dd($cart);
    // return response()->json($cart);
    // }



    // public function addToCart(Request $request, $id)
    // {
    //     $cart = Session::get('cart');
    //     $id = (int)$request->id;
    //     $qty = 1;
    //     // 
    //     $product = Product::where('id', $id)->first();
    //     $subtotal = $qty * $product->current_price;
    //     $product = Product::findOrFail($id);


    //     if (!$product) {
    //         abort(404);
    //     }
    //     $cart = Session::get('cart');
    //     $ckey = uniqid();

    //     // if cart is empty then this the first product
    //     if (!$cart) {

    //         $cart = [
    //             $ckey => [
    //                 "id" => $id,
    //                 "name" => $product->title,
    //                 "qty" => 1,
    //                 "product_price" => (float)$product->current_price,
    //                 "total" => $subtotal,
    //                 "photo" => $product->feature_image
    //             ]
    //         ];
    //         $store= Session::put('cart', $cart);
    //         return response()->json(['message' => 'Product added to cart successfully!']);
    //     }

    //     // if cart not empty then check if this product (with same variation) exist then increment quantity
    //     foreach ($cart as $key => $cartItem) {
    //         if ($cartItem["id"] == $id) {
    //             $cart[$key]['qty'] = (int)$cart[$key]['qty'] + $qty;
    //             $cart[$key]['total'] = (float)$cart[$key]['total'] + $subtotal;
    //             Session::put('cart', $cart);
    //             return response()->json(['message' => 'Product added to cart successfully!']);
    //         }
    //     }

    //     // if item not exist in cart then add to cart with quantity = 1
    //     $cart[$ckey] = [
    //         "id" => $id,
    //         "name" => $product->title,
    //         "qty" => 1,
    //         // "variations" => $variant,
    //         // "addons" => $addons,
    //         "product_price" => (float)$product->current_price,
    //         "total" => $subtotal,
    //         "photo" => $product->feature_image
    //     ];


    //     $cart = Session::put('cart', $cart);




    //     return response()->json(['message' => 'Product added to cart successfully!']);
    //     }

    public function increment(Request $request, $id){
        // increment product qty
        $cart_key = Session::get('cart_key');
        $quantity = CartItem::where('id',$id)->where('cart_key', $cart_key['cart_key'])->increment('product_quantity');
        // get requested product in the point of sale table
        $product = CartItem::where('id', $id)->where('cart_key', $cart_key['cart_key'])->first();
        // Multiply product qty with its price
        $subtotal = (int)$product->product_quantity * (int)$product->product_price;
        // update the total price of product
        $total = CartItem::where('id',$id)->where('cart_key', $cart_key['cart_key'])->update(['sub_total'=> $subtotal]);
        return response()->json($total);
    }

    public function decrement(Request $request, $id){
        $cart_key = Session::get('cart_key');
        $product = CartItem::where('id',$id)->orWhere('product_id', $request->id)->where('cart_key', $cart_key['cart_key'])->first();
        // dd($product);
        if($product->product_quantity >= 2){
            $quantity = CartItem::where('id',$id)->orWhere('product_id', $request->id)->decrement('product_quantity');
            $subtotal = $product->product_quantity * $product->product_price;
            $total = CartItem::where('id',$id)->orWhere('product_id', $request->id)->update(['sub_total'=> $subtotal]);
            return response()->json($total);
        }else{
            return response('Can not be added');
        }
    }


    

    public function removeCartItem($id){
        $cart_key = Session::get('cart_key');
        $product = CartItem::where('id', $id)->where('cart_key', $cart_key['cart_key'])->first();
        $product->delete();
        return response()->json("Product deleted");
    }

    // public function removeCartItem($id)
    // {
    //     if ($id) {
    //         $cart = Session::get('cart');
    //         Session::flush();

    //         // unset($cart);
    //         Session::put('cart', $cart);
    //         // dd($cart);

    //         return response()->json(['message' => 'Item removed successfully']);
    //     }
    // }

    public function clearCarts(){
        $cart_key = Session::get('cart_key');
        $carts = CartItem::query()->where('cart_key', $cart_key['cart_key'])->delete();
        return response()->json("Carts cleared");
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
