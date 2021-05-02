<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;

class MetaTagController extends Controller
{
    //

    public function index(){
        $meta_tags = DB::table('meta_tags')->get()->toArray();


        return view('admin.metatag', compact('meta_tags'));
    }


    public function tag_add(Request $request){
    //    dd($request->all());
    //    die();

        DB::table('meta_tags')->insert([
            'title_hy' => $request->title_hy,
            'description_hy' => $request->description_hy,
            'title_en' => $request->title_en,
            'description_en' => $request->description_en,
            'title_ru' => $request->title_ru,
            'description_ru' => $request->description_ru,
            'page' => $request->page
        ]);

        return redirect()->back();
    }


public function tag_edit($id){
    $result = DB::table('meta_tags')->where('id',$id)->first();
        
    return view("admin.metatag_edit",["result" =>$result]);
      

}

public function tag_update(Request $request, $id){
    DB::table('meta_tags')->where('id',$id)->update(['title_hy' => $request->title_hy,
    'description_hy' => $request->description_hy,
    'title_en' => $request->title_en,
    'description_en' => $request->description_en,
    'title_ru' => $request->title_ru,
    'description_ru' => $request->description_ru,
    ]);

            //    dd($request->all());

            return redirect()->back();


}
// public function tag_delete(Request $request){


//            dd($request->all());
//                   die();
//                   return redirect()->back();


// }

}
