<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\ProductColour;
use App\Models\ColourPalette;
use App\Models\Pcategory;
use App\Models\Subcategory;
use App\Models\ColourCategory;

class ProductcolourController extends Controller
{
    //

    public function index($id){
        $pcolours = ProductColour::where('colour_category_id', $id)->get();
        return response()->json($pcolours);
    }


    public function colourStage1($paletteId){
        // $cpalette= ColourPalette::find($paletteId);
        // // dd($cpalette);
        // $data = $cpalette->colourCategories()->where(['status'=>1])->get();
        // foreach($data as $key => $ccat){
        //     $pcolours['ccategories'][0]['product_colours']  = $ccat->productColours()->where(['status'=>1,
        //     'colour_stages'=> 0])->get();
        // }
    
        // $pcolours['ccategories'][0]['product_colours'] =
        // ProductColour::with('colourCategory.cpalettes')->where(['colour_stages'=>
        // 0, 'status'=>1])->get();
        // // dd($pcolours);
        // return response()->json($pcolours);

        $palette = ColourPalette::find($paletteId);
        // dd($paletteId);
       $pcolours['ccategories'][0]['product_colours'] =
       ProductColour::where(['colour_stages'=>0, 'status'=>1])->with(array('colourCategory.cpalettes'=>function($query) use ($palette){
        $query->where(['id'=> $palette->id, 'status'=>1]);
        }))->get();
        return response()->json($pcolours);

    }

    public function colourStage2($paletteId){
        $palette = ColourPalette::with('colourCategories')->where(['id'=>$paletteId])->get();
        // dd($palette);
        foreach($palette as $k=>$p){
            $data['ccategories']= $p->colourCategories()->get();
            foreach($data['ccategories'] as $key=>$ccat){
                $data['ccategories'][$key]['product_colours'] = $ccat->productColours()->where(['status'=>1, 'colour_stages'=> 1,'status'=>1,
                'is_popular'=> 1])->get();
            }
        }        
        return response()->json($data);
    }


    public function OLDcountPopular(Request $request, $id){
    $q = $request->all();
    // dd($q['subId']);
    $pcolourCount = DB::table('colour_palettes AS cp')
    ->join('pcategory_colour_palette AS pcp', 'pcp.colour_palette_id', '=', 'cp.id')
    ->join('pcategories AS pct', 'pct.id', '=', 'pcp.pcategory_id')
    ->join('product_colours AS pc', 'pc.category_id', '=', 'pct.id')

    // ->join('product_colour_subcategory as pcs', 'pcs.product_colour_id', '=', 'pc.id')
    // ->join('subcategories as sb', 'sb.id', '=', 'pcs.subcategory_id')

    // ->where(['cp.id'=> $id, 'pc.is_popular'=>1, 'pc.status'=>1])
    ->where(['cp.id'=> $id, 'pc.is_popular'=>1, 'pc.status'=>1])
    ->select('pc.*')->count();
    // dd($pcolourCount);

    return response()->json($pcolourCount);
    }

    public function countPopular(Request $request, $id){

        $q = $request->all();
        // dd($q);
      
        $pcolourCount = DB::table('colour_palettes AS cp')
            ->join('colour_categories AS cc', 'cc.colour_palette_id', '=', 'cp.id')
            ->join('product_colours AS pc', 'pc.colour_category_id', '=', 'cc.id')
            ->where(['cp.id'=> $id, 'pc.is_popular'=>1, 'pc.status'=>1,])
            ->select('pc.*', 'cc.*')->count();
        
        return response()->json($pcolourCount);
    }

    public function allColourCount($id){
        $pcolours = DB::table('colour_palettes AS cp')
        ->join('colour_categories AS cc', 'cc.colour_palette_id', '=', 'cp.id')
        ->join('product_colours AS pc', 'pc.colour_category_id', '=', 'cc.id')
        ->where(['cp.id'=> $id,  'pc.status'=>1,])
        ->select('pc.*', 'cc.*')->count();
        return response()->json($pcolours);
    }
    
    public function seeAllColour($id){
        $cpalette = ColourPalette::find($id);
        if($cpalette->status ==  1){
            $data['ccategories'] = $cpalette->colourCategories()->where('status', 1)->get();
            foreach($data['ccategories'] as $key=>$ccolour){
                $data['ccategories'][$key]['product_colours'] = $ccolour->productColours()->where(['status'=>1])->get();
            }
        }else{
            return response()->json("Colour palette is not active");
        }

        // dd($data);
        return response()->json($data);
    }

    public function show($id){
        $products = ProductColour::find($id)->products()->paginate(10);
        foreach($products as $product)
        {
            $product->productColour;
        }
        return response()->json($products);

    }

    public function filterProductColour(Request $request, $paletteId, $id){
        // dd($id);

        $q = array_keys($request->all());
        // $pcategory = PCategory::wherePivot()
        $cpalette= ColourPalette::find($paletteId);
        // dd($cpalette);
        $data = $cpalette->colourCategories()->where(['status'=>1])->get();
        if($cpalette->status == 1){
            foreach($data as $key => $ccat){
            if($q[0] == "All"){
                $data[$key]['product_colours'] = $ccat->productColours()->where(['category_id'=>$id, 'is_popular'=> 1,'status'=>1])->get();
            }
            else{
                
                // $pcat = Pcategory::find($id);
                // if($pcat->status == 1){
                //     $data = $pcat->subcategory()->get();
                //     foreach($data as $key=>$sub){
                //         $data[$key]['product_colours'] = $sub->productColour($q[0])->where(['is_popular'=> 1,
                //         'status'=>1, 'category_id'=>$id ])->get();
                //     }
                // }

                $data[$key]['product_colours'] =
                    $ccat->productColours($q[0])->where(['status'=>1, 'is_popular'=>1, 'category_id'=>$id])
                        ->whereHas("subcategory", function ($query) use ($q) {
                    if ($q[0]) {
                        $query->where("subcategory_id", "=", $q[0]);
                    }
                    })->get();
                // $ccats = ColourCategory::where(['colour_palette_id'=> $paletteId])->get();
                // foreach($ccats as $key=>$ccat){
                //     $data[$key]['product_colours'] =
                //     $ccat->productColours($q[0])->whereHas("subcategory", function ($query) use ($q) {
                //     if ($q[0]) {
                //         $query->where("subcategory_id", "=", $q[0]);
                //     }
                //     })->get();
                // }

            }
        }

        }
        
        return response()->json($data);
    }
}
