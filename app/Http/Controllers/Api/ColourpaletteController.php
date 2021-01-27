<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ColourPalette;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
class ColourpaletteController extends Controller
{
    //
    public function index(){
        $cpalette = ColourPalette::where('status', 1)->get();
        return response()->json($cpalette);
    }

    // public function paginate($items, $perPage = 2, $page = null, $options = [])
    // {
    //     $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    //     $items = $items instanceof Collection ? $items : Collection::make($items);
    //     return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    // }
    

    public function show($id){
        $cpalette = ColourPalette::find($id);
        if($cpalette->status ==  1){
            $data['ccategories'] = $cpalette->colourCategories()->where('status', 1)->get();
            foreach($data['ccategories'] as $key=>$ccolour){
                $data['ccategories'][$key]['product_colours'] = $ccolour->productColours()->where(['status'=>1, 'is_popular'=> 1])->get();
            }
        }else{
            return response()->json("Colour palette is not active");
        }
        return response()->json($data);
    }


    //     public function getWhite($id){
    //     $cpalette = ColourPalette::find($id);
    //     if($cpalette->status ==  1){
    //         $data['ccategories'] = $cpalette->colourCategories()->where('status', 1)->get();
    //         foreach($data['ccategories'] as $key=>$ccolour){
    //             $data['ccategories'][$key]['product_colours'] = $ccolour->productColours()->where(['status'=>1, 'is_popular'=> 1])->latest();
    //         }
    //     }else{
    //         return response()->json("Colour palette is not active");
    //     }
    //     return response()->json($data);
    // }

    public function allColours($id){
        $pcolours = DB::table('colour_palettes AS cp')
        ->join('colour_categories AS cc', 'cc.colour_palette_id', '=', 'cp.id')
        ->join('product_colours AS pc', 'pc.colour_category_id', '=', 'cc.id')
        ->where('cp.id', $id)
        ->select('pc.*', 'cc.*')->get();

        // dd($pcolours);

        return response()->json($pcolours);
    }

    public function getFilterCategory(Request $request, $id){
        $cpalette = ColourPalette::find($id);
        if($cpalette->status ==  1){
            $data = $cpalette->pcategories()->where('status', 1)->get();
            foreach($data as $key=>$value){
                $data[$key]['items'] = $value->subcategory()->where(['status'=>1])->get();
            }
        }else{
            return response()->json("Colour palette is not active");
        }
        // dd($data);
        return response()->json($data);
    }
}

