<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pcategory;
use App\Models\Language;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Subcategory;

class PcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        // $pcategory =Pcategory::where('status', 1)->get();

        // $lang = Language::where('code', $request->language)->first();
        // $lang_id = $lang->id;
        
        $pcategory= Pcategory::where('status', 1)->orderBy('id', 'ASC')->get();
        foreach($pcategory as $key=>$p){
            $p->subcategory;
        }
        return response()->json($pcategory);
    }


    public function listCategory(Request $request){        
        $pcategory= Pcategory::where('status', 1)->orderBy('id', 'ASC')->get();
        return response()->json($pcategory);
    }


    public function getSubcategory(Request $request, $id){
        $received_data = json_decode(file_get_contents("php://input"));
        // dd($received_data);
        $pcategory= Subcategory::where(['status'=> 1, 'category_id'=>$id])->orderBy('id', 'ASC')->get();
        // return response()->json($pcategory);
        echo json_encode($pcategory);
    }



    public function productCategory(Request $request, $id){
        $pcategory= Pcategory::find($id);
        $products = $pcategory->products;
        // foreach($pcategory as $p){
        //     $p->products;
        // }
        // dd($pcategory);

        return response()->json($products);
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
    public function show($id)
    {
        //
        
    }

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
