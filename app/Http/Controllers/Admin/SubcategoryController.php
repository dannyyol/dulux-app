<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Pcategory;
use App\Models\Subcategory;

use App\Models\Language;
use Validator;
use Session;

class SubcategoryController extends Controller
{
    public function index(Request $request)
    {
        $lang = Language::where('code', $request->language)->first();
        $lang_id = $lang->id;
        $data['categories'] = Pcategory::where('status',1)->get();
        $data['subcategories'] = Subcategory::where('language_id', $lang_id)->orderBy('id', 'DESC')->paginate(10);
        // dd($data);
        $data['lang_id'] = $lang_id;
        return view('admin.product.subcategory.index',$data);
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


        $data = new Subcategory;
        $input = $request->all();

        $in = $request->all();

        if($request->hasFile('image')){
          $image = $request->image;
          $name =  uniqid() . '.'. $image->getClientOriginalExtension();
          $image->move('assets/front/img/category/', $name);
          $input['image'] = $name;
        }

        $input['slug'] =  make_slug($request->name);
        $data->create($input);

        Session::flash('success', 'Subategory added successfully!');
        return "success";
    }


    public function edit($id)
    {
        $data = Subcategory::findOrFail($id);
        $categories = Pcategory::where('status', 1)->get();
        return view('admin.product.subcategory.edit',compact('data', 'categories'));
    }

    public function update(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $data = Subcategory::findOrFail($request->subcategory_id);
        // dd($data);
        $input = $request->all();
        if($request->hasFile('image')){
            @unlink('assets/front/img/category/' . $data->image);
            $image = $request->image;
            $name =  uniqid() . '.'. $image->getClientOriginalExtension();
            $image->move('assets/front/img/category/', $name);
            $input['image'] = $name;
          }

        $input['slug'] =  make_slug($request->name);
        $data->update($input);

        Session::flash('success', 'Category Update successfully!');
        return "success";
    }

    // public  

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        foreach ($ids as $id) {
            $pcategory = Subcategory::findOrFail($id);
            if ($pcategory->products()->count() > 0) {
                Session::flash('warning', 'First, delete all the product under the selected categories!');
                return "success";
            }
        }

        foreach ($ids as $id) {
            $pcategory = Subcategory::findOrFail($id);
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


        Subcategory::where('id',$id)->update([
        'is_feature' => $value
        ]);

        Session::flash('success', 'Product category updated successfully!');
        return 'done';
    }

    public function removeImage(Request $request) {
        $type = $request->type;
        $pcatid = $request->pcategory_id;

        $pcategory = Subcategory::findOrFail($pcatid);

        if ($type == "pcategory") {
            @unlink("assets/front/img/category/" . $pcategory->image);
            $pcategory->image = NULL;
            $pcategory->save();
        }

        $request->session()->flash('success', 'Image removed successfully!');
        return "success";
    }

}
