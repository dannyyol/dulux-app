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
    public $addon_subtotal = 0;
    public $variation_subtotal = 0;

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




    function variationSubtotal($cart, $litres, $currentVariationPrice){
        $sum = 0;
        $sum2=0;
        if($cart){
            $variations = json_decode($cart->variations, true);
            foreach($variations as $key=>$litre){
                $sum += $litre['price'] + $currentVariationPrice;
            }
        }

        
        if($litres){
            foreach($litres as $litre){
            $sum2 += $litre['price'];
            }
        }
        $this->variation_subtotal = floatval($sum+$sum2);
        return $this->variation_subtotal;
    }

    function addonsSubtotal($cart, $addons, $currentAddonPrice){
        $sum = 0;
        $sum2=0;
        
        if($addons){
            foreach($addons as $addon){
                // die('h');
                print_r($addon);
                $sum2 += floatval($addon['price'] + $currentAddonPrice);
            }
        }
                        
        $this->addon_subtotal = $sum2;
        return $this->addon_subtotal;
    }
    public function addToCart(Request $request, $id)
    {   
        // dd($request->all());
        $cart_key = Session::get('cart_key');
        $product = Product::where('id', $id)->first();
        $request->all();
        if($product->id == $request->litres['id']){
            $check_if_litres_in_cart = CartItem::where(['product_id'=> $id, 'cart_key'=>$cart_key['cart_key']])->first();
            // for litres
            $litre_array[0]['id'] = $id;
            $litre_array[0]['name'] = $request->litres['name'];
            $litre_array[0]['price'] = $request->litres['price'];
            $litre_array[0]['oldPrice'] = $request->litres['oldPrice'];
            $litre_array[0]['qty'] = $request->litres['qty'];
            $variation_total = $this->variationSubtotal($check_if_litres_in_cart,
            $litre_array,0);

            // dd($litre_array);
            // Remove null values
            $nameQtyPrice = $this->removeNullValues($request->productAddons, $check_if_litres_in_cart);
            $this->addonsSubtotal($check_if_litres_in_cart, $nameQtyPrice, 0);

            if($litre_array[0]['price'] != null ){
                if($check_if_litres_in_cart){
                    // Get Subtotal by adding total of addons and variations
                    $subtotal = $this->variationSubtotal($check_if_litres_in_cart, 
                                    $litre_array,0) + $this->addonsSubtotal($check_if_litres_in_cart, $nameQtyPrice, 0);
                    
                    // Convert DB litres to array
                    $decodeLitres = json_decode($check_if_litres_in_cart->variations, true);
                    $cart_key = Session::get('cart_key');
                    // foreach($decodeLitres as $key=>$litre){
                    // Check if user selected = name of litres in the DB 
                    if(array_search($request->litres['name'], array_column($decodeLitres, 'name')) !== false) {

                            // if litre already added do something... (increment qty here)

                            // Sum the prices of addons selected by the user
                            $a_total = $this->addonsSubtotal($check_if_litres_in_cart, $nameQtyPrice,0);

                            //  Get The subtotal of a cart
                            $subtotal = (float)$check_if_litres_in_cart->variation_total + $a_total;
                            
                            $addOnToJson = json_encode($nameQtyPrice); //convert to json
                            if(!empty($addOnToJson)){
                                $data = CartItem::where('product_id', $id)->update(['addons'=>$addOnToJson,
                                "addon_total"=>$a_total, 'sub_total'=> $subtotal]);
                            } 
                        } else {
                            $dbvariations = $decodeLitres;
                            // If litres not exist in DB then add new litre 
                            array_push($dbvariations, $litre_array[0]);

                            $data = CartItem::where('product_id',$id)->update(['variations'=>json_encode($dbvariations),
                            'variation_total'=>$variation_total, 'sub_total'=>$subtotal]);
                        }
    
                }else{
                        
                        $data = [];
                        $data['product_id'] = $id;
                        $data['product_name'] = $product->title;
                        $data['product_quantity'] = 1;
                        $data['product_price'] = $product->current_price;
                        $data['feature_image'] = $product->feature_image;
                        $data['sub_total'] = $this->variationSubtotal($check_if_litres_in_cart, $litre_array,0) + $this->addonsSubtotal($check_if_litres_in_cart, $nameQtyPrice,0);

                        $addOnToJson = json_encode($nameQtyPrice);
                        $data['addons'] = empty($addOnToJson) ? null : $addOnToJson;
                        $data['addon_total'] = $this->addonsSubtotal($check_if_litres_in_cart, $nameQtyPrice, 0);
                        $litresToJson = json_encode($litre_array); //convert to json
                        $data['variations'] = $litresToJson;
                        $data['variation_total'] = $this->variationSubtotal($check_if_litres_in_cart, $litre_array,0);
                        $data['cart_key'] = $cart_key['cart_key'];
                        $data['created_at'] = date("Y-m-d H:i:s");
                        $data['updated_at'] = date("Y-m-d H:i:s");
                        CartItem::insert($data);
                }
                return response()->json(['addon_subtotal' =>$this->addon_subtotal, 'variation_subtotal'=>$this->variation_subtotal]);

            } else {
                return response()->json(["status_code"=>"AD", "message"=>"Update the quantity"]);
            }
        }
        return response()->json(["status_code"=>"AC", "message"=>"Litres must not be empty"]);
    }


    function removeElementWithValueFromMultidimensionalArray($array, $key, $value){
        foreach($array as $subKey => $subArray){
            if($subArray[$key] == $value){
                unset($array[$subKey]);
            }
        }
        return json_encode(array_values($array));
    }

    function removeNullValues($request, $cart){
        $name = array_filter($request['name'], 'strlen');//remove null values from array
        $qty = array_filter($request['qty'], 'strlen');
        $price = array_filter($request['price'], 'strlen');
        $oldPrice = array_filter($request['oldPrice'], 'strlen');
        $id = array_filter($request['id'], 'strlen');
        $nameQtyPrice = array_map(function ($id, $name, $qty, $price, $oldPrice) { //Map array and rearrange according to value index
        return array_combine(['id', 'name', 'qty', 'price', 'oldPrice'], [$id, $name, $qty, $price, $oldPrice]);
        }, $id, $name, $qty, $price, $oldPrice);
        return $nameQtyPrice;
    }

    public function updateVariation(Request $request, $cartId){
        // dd($request->all());  
        $cart_key = Session::get('cart_key');
        $cart = CartItem::where(['id'=> $cartId, 'cart_key'=>$cart_key['cart_key']])->first();
        if($request->currentVariation['name']){
            // dd($request->currentVariation);
            $db_variationToArray = json_decode($cart->variations, true);
            foreach($db_variationToArray as &$value){
                print_r($value);
                if($value['name'] === $request->currentVariation['name']){
                    $v_total = (float)$cart->variation_total+($request->currentVariationPrice-$value['price']);
                    $subtotal['subtotal'] = (float)$cart->sub_total+($request->currentVariationPrice-$value['price']);
                    $value['qty'] = $request->currentVariationQty;
                    $value['price'] = $request->currentVariationPrice;
                    $value['subtotal'] = $subtotal['subtotal'];
                    break; // Stop the loop after getting the item
                }
                
            }
  
            $data = CartItem::where(['id'=> $cartId,
            'cart_key'=>$cart_key['cart_key']])->update(['variations'=>$db_variationToArray,
            'variation_total'=>$v_total, 'sub_total'=>$subtotal['subtotal']]);

            return response()->json(['status_code'=>'AB', 'message'=>'Item Updated successfully', 'data'=>$data]);
        }
    }


    public function updateAddon(Request $request, $cartId){
        // dd($request->all());  
        $cart_key = Session::get('cart_key');
        $cart = CartItem::where(['id'=> $cartId, 'cart_key'=>$cart_key['cart_key']])->first();
        if($request->currentAddon['name']){
            // dd($request->currentVariation);
            $db_addonToArray = json_decode($cart->addons, true);
            foreach($db_addonToArray as &$value){
                if($value['name'] === $request->currentAddon['name']){
                    $a_total = (float)$cart->addon_total+($request->currentAddonPrice-$value['price']);
                    $subtotal['subtotal'] = $cart->sub_total+($request->currentAddonPrice - $value['price']);
                    $value['qty'] = $request->currentAddonQty;
                    $value['price'] = $request->currentAddonPrice;
                    $value['subtotal'] = $subtotal['subtotal'];
                    // break; // Stop the loop after getting the item
                }
            }

            $data = CartItem::where(['id'=> $cartId,
            'cart_key'=>$cart_key['cart_key']])->update(['addons'=>$db_addonToArray, 'sub_total'=>$subtotal['subtotal'], 'addon_total' =>$a_total ]);

            return response()->json(['status_code'=>'AB', 'message'=>'Item Updated successfully', 'data'=>$data]);
        }
    }


    

    public function deleteVariation(Request $request, $cartId){
        $cart_key = Session::get('cart_key');
        $cart = CartItem::where(['id'=> $cartId, 'cart_key'=>$cart_key['cart_key']])->first();
        // dd($request->all());
        if($request->currentVariation){
            // dd($request->currentVariation);
            $db_variationToArray = json_decode($cart->variations, true);
            $afterDelete = $this->removeElementWithValueFromMultidimensionalArray($db_variationToArray, "name",
                        $request->currentVariation);
            
            if(count(json_decode($afterDelete)) == 0){
                $cart->delete();
            }
            
            $data = CartItem::where(['id'=> $cartId, 'cart_key'=>$cart_key['cart_key']])->update(['variations'=>$afterDelete, 
                                    'sub_total'=>$cart->sub_total-$request->currentPrice,
                                    'variation_total'=>$cart->variation_total-$request->currentPrice]);
            return response()->json(['status_code'=>'AB', 'message'=>'Item Deleted successfully', 'data'=>$data]);

        }

    }



    // Refactor later....delete addon
    public function deleteAddon(Request $request, $cartId){
        $cart_key = Session::get('cart_key');
        $cart = CartItem::where(['id'=> $cartId, 'cart_key'=>$cart_key['cart_key']])->first();
        // dd($request->currentVariation);
        if($request->currentAddon){
            // dd($request->currentVariation);
            $db_addonToArray = json_decode($cart->addons, true);
            $afterDelete = $this->removeElementWithValueFromMultidimensionalArray($db_addonToArray, "name",
                        $request->currentAddon);
            
            $data = CartItem::where(['id'=> $cartId, 'cart_key'=>$cart_key['cart_key']])->update(['addons'=>$afterDelete,
                            'sub_total'=>$cart->sub_total-$request->currentPrice,
                            'addon_total'=>$cart->addon_total-$request->currentPrice]);
            return response()->json(['status_code'=>'AB', 'message'=>'Item Deleted successfully', 'data'=>$data]);

        }

    }


    public function clearCarts(){
    $cart_key = Session::get('cart_key');
    $carts = CartItem::query()->where('cart_key', $cart_key['cart_key'])->delete();
    return response()->json("Carts cleared");
    }




}
