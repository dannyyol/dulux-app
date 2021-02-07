<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\ProductColour;
use App\Models\ColourCategory;
use App\Models\Subcategory;
use App\Models\Pcategory;

use Validator;
use Session;
class ProductcolourController extends Controller
{
    public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->first();
        $lang_id = $lang->id;
        $data['ccategories'] = ColourCategory::where('status',1)->get();
        $data['categories'] = Pcategory::where('status',1)->get();
        $data['pcolours'] = ProductColour::where('language_id', $lang_id)->orderBy('id', 'DESC')->paginate(10);
        $data['subcategories'] = Subcategory::where('status',1)->get();
        $data['categories'] = Pcategory::where('status',1)->get();

        $data['lang_id'] = $lang_id;
        return view('admin.colour.index',$data);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $messages = [
            'language_id.required' => 'The language field is required'
        ];

        $rules = [
            'language_id' => 'required',
            'colour_name' => 'required|max:255',
            'colour_code' => 'required|max:255',
            'colour_category_id' => 'required',
            'colour_stages*' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'status' => 'required',
        ];

        // dd($request->all());

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $data = new ProductColour;
        $input = $request->all();
        $in = $request->all();
        if($request->hasFile('image')){
          $image = $request->image;
          $name =  uniqid() . '.'. $image->getClientOriginalExtension();
          $image->move('assets/front/img/colour/', $name);
          $input['image'] = $name;
        }

        $input['slug'] =  make_slug($request->colour_name);
        $data = ProductColour::create($input);
        // $product = Product::create($in);

        // added by AYO
        if(isset($request->subcategory_id)){
            $data->subcategory()->sync($request->subcategory_id, false);
        } else {
            $data->subcategory()->sync(array());
        }

        Session::flash('success', 'Product Colour added successfully!');
        return "success";
    }


    public function edit(Request $request, $id)
    {
        $lang = Language::where('code', $request->language)->first();
        $categories = $lang->pcategories()->where('status',1)->get();
        $data = ProductColour::findOrFail($id);
        $subcategories = Subcategory::where('status', 1)->get();
        $ccategories = ColourCategory::where('status', 1)->get();
        return view('admin.colour.edit',compact('data', 'ccategories','subcategories','categories'));
    }

    public function update(Request $request)
    {
        $rules = [
            'colour_name' => 'required|max:255',
            'colour_code' => 'required|max:255',
            'colour_category_id' => 'required',
            'colour_stages*' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'status' => 'required',

        ];

        // dd($request->subcategories);

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $data = ProductColour::findOrFail($request->product_colour_id);
        $input = $request->all();
        if($request->hasFile('image')){
@unlink('assets/front/img/colour/' . $data->image);
            $image = $request->image;
            $name =  uniqid() . '.'. $image->getClientOriginalExtension();
            $image->move('assets/front/img/colour/', $name);
            $input['image'] = $name;
          }

        $input['slug'] =  make_slug($request->colour_name);
        if(isset($request->subcategory_id)){
            $data->subcategory()->sync($request->subcategory_id, true);
        } else {
            $data->subcategory()->sync(array());
        }
        $data->update($input);
        // $data = $data->fill($input)->save();
        


        Session::flash('success', 'Product Colour Updated successfully!');
        return "success";
    }

    public function delete(Request $request)
    {

        $pcolour = ProductColour::findOrFail($request->product_colour_id);

        $pcolour->subcategory()->detach();

        if ($pcolour->products()->count() > 0) {
            Session::flash('warning', 'First, delete all the product under the selected colour!');
            return back();
        }
@unlink('assets/front/img/colour/' . $pcolour->image);
        $pcolour->delete();

        Session::flash('success', 'Product colour deleted successfully!');
        return back();
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        foreach ($ids as $id) {
            $pcolour = ProductColour::findOrFail($id);
            if ($pcolour->products()->count() > 0) {
                Session::flash('warning', 'First, delete all the product under the selected colours!');
                return "success";
            }
        }

        foreach ($ids as $id) {
            $pcolour = ProductColour::findOrFail($id);
             $pcolour->subcategory()->detach(); //added by me
@unlink('assets/front/img/colour/' . $pcolour->image);
            $pcolour->delete();
        }

        Session::flash('success', 'product colours deleted successfully!');
        return "success";
    }

    public function FeatureCheck($data)
    {
        $info = explode(',',$data);
        $id = $info[0];
        $value = $info[1];
        ProductColour::where('id',$id)->update([
        'is_feature' => $value
        ]);

        Session::flash('success', 'Product Colour updated successfully!');
        return 'done';
    }


    public function PopularCheck($data)
    {
        $info = explode(',',$data);
        $id = $info[0];
        $value = $info[1];
        ProductColour::where('id',$id)->update([
            'is_popular' => $value
        ]);

        Session::flash('success', 'Product Colour updated successfully!');
        return 'done';
    }

    public function removeImage(Request $request) {
        $type = $request->type;
        $pcolid = $request->product_colour_id;

        $pcolour = ProductColour::findOrFail($pcolid);

        if ($type == "pcolour") {
@unlink("assets/front/img/colour/" . $pcolour->image);
            $pcolour->image = NULL;
            $pcolour->save();
        }

        $request->session()->flash('success', 'Image removed successfully!');
        return "success";
    }
}
