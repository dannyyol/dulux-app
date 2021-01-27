<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ColourPalette;
use App\Models\Language;
use Validator;
use Session;

class ColourpaletteController extends Controller
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
        $data['cpalettes'] = ColourPalette::where('language_id', $lang_id)->orderBy('id', 'DESC')->paginate(10);

        $data['lang_id'] = $lang_id;
        return view('admin.colour.palette.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $messages = [
            'language_id.required' => 'The language field is required'
        ];

        $rules = [
            'language_id' => 'required',
            'palette_name' => 'required|max:255',
            'palette_code' => 'required|max:255',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }


        $data = new ColourPalette;
        $input = $request->all();

        $in = $request->all();

        if($request->hasFile('image')){
          $image = $request->image;
          $name =  uniqid() . '.'. $image->getClientOriginalExtension();
          $image->move('assets/front/img/colour/', $name);
          $input['image'] = $name;
        }

        $input['slug'] =  make_slug($request->palette_name);
        $data->create($input);

        Session::flash('success', 'Colour paltte added successfully!');
        return "success";
    }


    public function FeatureCheck($data)
    {
        $info = explode(',',$data);
        $id = $info[0];
        $value = $info[1];


        ColourPalette::where('id',$id)->update([
            'is_feature' => $value
        ]);

        Session::flash('success', 'Colour palette updated successfully!');
        return 'done';
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ColourPalette::findOrFail($id);
        return view('admin.colour.palette.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'palette_name' => 'required|max:255',
            'palette_code' => 'required|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errmsgs = $validator->getMessageBag()->add('error', 'true');
            return response()->json($validator->errors());
        }
        $data = ColourPalette::findOrFail($request->colour_palette_id);
        $input = $request->all();
        if($request->hasFile('image')){
            @unlink('assets/front/img/colour/' . $data->image);
            $image = $request->image;
            $name =  uniqid() . '.'. $image->getClientOriginalExtension();
            $image->move('assets/front/img/colour/', $name);
            $input['image'] = $name;
          }

        $input['slug'] =  make_slug($request->palette_name);
        $data->update($input);

        Session::flash('success', 'Category Update successfully!');
        return "success";
    }


    public function delete(Request $request)
    {
        $cpalette = ColourPalette::findOrFail($request->colour_palette_id);
        if ($cpalette->colourCategories()->count() > 0) {
            Session::flash('warning', 'First, delete all the colour categories under the selected colour palette!');
            return back();
        }
@unlink('assets/front/img/colour/' . $cpalette->image);
        $cpalette->delete();

        Session::flash('success', 'Colour palette deleted successfully!');
        return back();
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        foreach ($ids as $id) {
            $cpalette = ColourPalette::findOrFail($id);
            if ($cpalette->colourCategories()->count() > 0) {
                Session::flash('warning', 'First, delete all the colour categories under the selected colour palette!');
                return "success";
            }
        }

        foreach ($ids as $id) {
            $cpalette = ColourPalette::findOrFail($id);
            @unlink('assets/front/img/colour/' . $cpalette->image);
            $cpalette->delete();
        }

        Session::flash('success', 'colour palettes deleted successfully!');
        return "success";
    }


    public function removeImage(Request $request) {
        $type = $request->type;
        $cpalid = $request->colour_palette_id;

        $cpalette = ColourPalette::findOrFail($cpalid);

        if ($type == "cpalette") {
            @unlink("assets/front/img/colour/" . $cpalette->image);
            $cpalette->image = NULL;
            $cpalette->save();
        }

        $request->session()->flash('success', 'Image removed successfully!');
        return "success";
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
