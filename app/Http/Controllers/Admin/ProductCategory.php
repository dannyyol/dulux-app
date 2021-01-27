<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Pcategory;
use App\Models\ColourPalette;

use App\Models\Language;
use Validator;
use Session;

class ProductCategory extends Controller
{
    public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->first();
        $lang_id = $lang->id;
        $data['pcategories'] = Pcategory::where('language_id', $lang_id)->orderBy('id', 'DESC')->paginate(10);
        // $data['cpalettes'] = ColourPalette::orderBy('palette_name')->get();


        $data['lang_id'] = $lang_id;
        return view('admin.product.category.index',$data);
    }


    public function store(Request $request)
    {
        $messages = [
            'language_id.required' => 'The language field is required'
        ];

        $rules = [
            'language_id' => 'required',
            'name' => 'required|max:255',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }


        $data = new Pcategory;
        $input = $request->all();

        $in = $request->all();

        if($request->hasFile('image')){
          $image = $request->image;
          $name =  uniqid() . '.'. $image->getClientOriginalExtension();
          $image->move('assets/front/img/category/', $name);
          $input['image'] = $name;
        }

        $input['slug'] =  make_slug($request->name);
        $data = Pcategory::create($input);
        $cpalettes = ColourPalette::where('status', 1)->get();
        foreach($cpalettes as $cpalette){
            $cpalette_id[] = $cpalette->id; 
        }

        // dd($cpalette_id);
        // array:4 [
        // 0 => "2"
        // 1 => "3"
        // 2 => "4"
        // 3 => "6"
        // ]

        // array:9 [
        // 0 => 13
        // 1 => 14
        // 2 => 15
        // 3 => 23
        // 4 => 24
        // 5 => 25
        // 6 => 26
        // 7 => 27
        // 8 => 28
        // ]

        if($cpalettes){
            $data->colourPalettes()->sync($cpalette_id, true);
        } else {
            $data->colourPalettes()->sync(array());
        }

        Session::flash('success', 'Category added successfully!');
        return "success";
    }


    public function edit($id)
    {
        $data = Pcategory::findOrFail($id);
        $cpalettes = ColourPalette::all();
        return view('admin.product.category.edit',compact('data','cpalettes'));
    }

    public function update(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
        ];

                // dd($request->category_id);


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $data = Pcategory::findOrFail($request->category_id);
        // $input = $request->all();
        if($request->hasFile('image')){
            @unlink('assets/front/img/category/' . $data->image);
            $image = $request->image;
            $name =  uniqid() . '.'. $image->getClientOriginalExtension();
            $image->move('assets/front/img/category/', $name);
            $input['image'] = $name;
          }

        $input['slug'] =  make_slug($request->name);
        // $cpalettes = ColourPalette::where('status', 1)->get();
        
        // foreach($cpalettes as $cpalette){
        //     $cpalette_id[] = $cpalette->id; 
        // }
        // if(isset($request->subcategories)){
        //     $data->subcategory()->sync($request->subcategories, true);
        // } else {
        //     $data->subcategory()->sync(array());
        // }
        $data->update($input);
        

        Session::flash('success', 'Category Update successfully!');
        return "success";
    }

    public function delete(Request $request)
    {
        $category = Pcategory::findOrFail($request->category_id);
        $category->colourPalettes()->detach();
        if ($category->products()->count() > 0) {
            Session::flash('warning', 'First, delete all the product under the selected categories!');
            return back();
        }
        @unlink('assets/front/img/category/' . $category->image);
        $category->delete();

        Session::flash('success', 'Category deleted successfully!');
        return back();
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        foreach ($ids as $id) {
            $pcategory = Pcategory::findOrFail($id);
            if ($pcategory->products()->count() > 0) {
                Session::flash('warning', 'First, delete all the product under the selected categories!');
                return "success";
            }
        }

        foreach ($ids as $id) {
            $pcategory = Pcategory::findOrFail($id);
            $pcategory->colourPalettes()->detach();
            @unlink('assets/front/img/category/' . $pcategory->image);
            $pcategory->delete();
        }

        Session::flash('success', 'product categories deleted successfully!');
        return "success";
    }

    public function FeatureCheck($data)
    {
        $info = explode(',',$data);
        $id = $info[0];
        $value = $info[1];


        Pcategory::where('id',$id)->update([
        'is_feature' => $value
        ]);

        Session::flash('success', 'Product category updated successfully!');
        return 'done';
    }

    public function removeImage(Request $request) {
        $type = $request->type;
        $pcatid = $request->pcategory_id;

        $pcategory = Pcategory::findOrFail($pcatid);

        if ($type == "pcategory") {
            @unlink("assets/front/img/category/" . $pcategory->image);
            $pcategory->image = NULL;
            $pcategory->save();
        }

        $request->session()->flash('success', 'Image removed successfully!');
        return "success";
    }

}
