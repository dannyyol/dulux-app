<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ColourCategory;
use App\Models\Subcategory;

use App\Models\Language;
use App\Models\ColourPalette;
// use App\Models\Subcategory;
use App\Models\Pcategory;

use Validator;
use Session;
class ColourcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $lang = Language::where('code', $request->language)->first();
        $lang_id = $lang->id;
        $data['cpalettes'] = ColourPalette::where('status',1)->get();
        $data['subcategories'] = Subcategory::where('status',1)->get();
        $data['categories']= Pcategory::where('status',1)->get();

        $data['ccategories'] = ColourCategory::where('language_id', $lang_id)->orderBy('id', 'DESC')->paginate(10);

        $data['lang_id'] = $lang_id;
        return view('admin.colour.category.index',$data);
    }





    public function store(Request $request)
    {
        $messages = [
            'language_id.required' => 'The language field is required'
        ];

        $rules = [
            'language_id' => 'required',
            'category_name' => 'required|max:255',
            'colour_palette_id' => 'required|max:255',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }


        $data = new ColourCategory;
        $input = $request->all();

        $in = $request->all();

        if($request->hasFile('image')){
          $image = $request->image;
          $name =  uniqid() . '.'. $image->getClientOriginalExtension();
          $image->move('assets/front/img/colour/', $name);
          $input['image'] = $name;
        }

        $input['slug'] = make_slug($request->category_name);
        $data = ColourCategory::create($input);

        // $subs = Subcategory::where('status', 1)->get();
        // foreach($subs as $sub){
        //     $sub_id[] = $sub->id; 
        // }

        // if($subs){
        //     $data->Subcategory()->sync($sub_id, false);
        // } else {
        //     $data->Subcategory()->sync(array());
        // }

        Session::flash('success', 'Colour Category added successfully!');
        return "success";
    }


    public function edit($id)
    {
        $data = ColourCategory::findOrFail($id);
        $cpalettes = ColourPalette::where('status', 1)->get();
        $subcategories= Subcategory::where('status',1)->get();
        $categories= Pcategory::where('status',1)->get();

        return view('admin.colour.category.edit',compact('data', 'cpalettes','subcategories','categories'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'colour_palette_id' => 'required|max:255',
            'status' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $data = ColourCategory::findOrFail($request->colour_category_id);
        $input = $request->all();
        if($request->hasFile('image')){
@unlink('assets/front/img/colour/' . $data->image);
            $image = $request->image;
            $name =  uniqid() . '.'. $image->getClientOriginalExtension();
            $image->move('assets/front/img/colour/', $name);
            $input['image'] = $name;
          }

        $input['slug'] =  make_slug($request->category_name);
        // $data->update($input);

        // $subs = Subcategory::where('status', 1)->get();
        // foreach($subs as $sub){
        //     $sub_id[] = $sub->id; 
        // }

        // if($subs){
        //     $data->Subcategory()->sync($sub_id, true);
        // } else {
        //     $data->Subcategory()->sync(array());
        // }

        $data->fill($input)->save();


        Session::flash('success', 'Colour Category Updated successfully!');
        return "success";
    }

    public function delete(Request $request)
    {
        // dd($request->colour_category_id);
        $ccategory = ColourCategory::findOrFail($request->colour_category_id);
        // $ccategory->subcategory()->detach();

        if ($ccategory->productColours()->count() > 0) {
            Session::flash('warning', 'First, delete all the colours under the selected category!');
            return back();
        }
@unlink('assets/front/img/colour/' . $ccategory->image);
        $ccategory->delete();

        Session::flash('success', 'Colour category deleted successfully!');
        return back();
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        // dd($ids);
        foreach ($ids as $id) {
            $ccategory = ColourCategory::findOrFail($id);
            if ($ccategory->productColours()->count() > 0) {
                Session::flash('warning', 'First, delete all the colour under the selected categories!');
                return "success";
            }
        }

        foreach ($ids as $id) {
            $ccategory = ColourCategory::findOrFail($id);
@unlink('assets/front/img/colour/' . $ccategory->image);
            // $ccategory->subcategory()->detach();
            $ccategory->delete();
        }

        Session::flash('success', 'product categories deleted successfully!');
        return "success";
    }

    public function FeatureCheck($data)
    {
        $info = explode(',',$data);
        $id = $info[0];
        $value = $info[1];


        ColourCategory::where('id',$id)->update([
        'is_feature' => $value
        ]);

        Session::flash('success', 'Colour category updated successfully!');
        return 'done';
    }

    public function removeImage(Request $request) {
        $type = $request->type;
        $ccatid = $request->colour_category_id;


        $ccategory = ColourCategory::findOrFail($ccatid);

        if ($type == "ccategory") {
@unlink("assets/front/img/colour/" . $ccategory->image);
            $ccategory->image = NULL;
            $ccategory->save();
        }

        $request->session()->flash('success', 'Image removed successfully!');
        return "success";
    }

}
