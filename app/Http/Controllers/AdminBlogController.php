<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Blog;

class AdminBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Blog::orderBy("id","DESC")->paginate(10);
        
        return view("admin_blog.list",["result" =>$result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin_blog.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (app()->getLocale() == 'ru') {
            $title_hy = 'Պարտադիր է լրացնել վերնագիրը հայերեն ';
            $title_ru = 'Պարտադիր է լրացնել վերնագիրը ռուսերեն';
            $title_en = 'Պարտադիր է լրացնել վերնագիրը անգլերեն';
            $description_hy = 'Պարտադիր է լրացնել նկարագրությունը հայերեն ';
            $description_ru = 'Պարտադիր է լրացնել նկարագրությունը ռուսերեն';
            $description_en = 'Պարտադիր է լրացնել նկարագրությունը անգլերեն';
            $file = 'Պարտադիր է ընտրել նկար';
        } elseif (app()->getLocale() == 'en') {
            $title_hy = 'Պարտադիր է լրացնել վերնագիրը հայերեն ';
            $title_ru = 'Պարտադիր է լրացնել վերնագիրը ռուսերեն';
            $title_en = 'Պարտադիր է լրացնել վերնագիրը անգլերեն';
            $description_hy = 'Պարտադիր է լրացնել նկարագրությունը հայերեն ';
            $description_ru = 'Պարտադիր է լրացնել նկարագրությունը ռուսերեն';
            $description_en = 'Պարտադիր է լրացնել նկարագրությունը անգլերեն';
            $file = 'Պարտադիր է ընտրել նկար';
        } elseif (app()->getLocale() == 'hy') {
            $title_hy = 'Պարտադիր է լրացնել վերնագիրը հայերեն ';
            $title_ru = 'Պարտադիր է լրացնել վերնագիրը ռուսերեն';
            $title_en = 'Պարտադիր է լրացնել վերնագիրը անգլերեն';
            $description_hy = 'Պարտադիր է լրացնել նկարագրությունը հայերեն ';
            $description_ru = 'Պարտադիր է լրացնել նկարագրությունը ռուսերեն';
            $description_en = 'Պարտադիր է լրացնել նկարագրությունը անգլերեն';
            $file = 'Պարտադիր է ընտրել նկար';
        }
        
       $validatedData = $request->validate([
            'title_hy' => ['required'],
            'title_ru' => ['required'],
            'title_en' => ['required'],
            'description_hy' => ['required'],
            'description_ru' => ['required'],
            'description_en' => ['required'],
            'file' => ['required']
        ],[

            'title_hy.required' => $title_hy,
            'title_ru.required' => $title_ru,
            'title_en.required' => $title_en,
            'description_hy.required' => $description_hy,
            'description_ru.required' => $description_ru,
            'description_en.required' => $description_en,
            'file.required' => $file,

        ]);

            
            $data = new Blog;
            
            $data->title_hy = $request->title_hy;
            $data->title_ru = $request->title_ru;
            $data->title_en = $request->title_en;
            $data->description_hy = $request->description_hy;
            $data->description_ru = $request->description_ru;
            $data->description_en = $request->description_en;
            $data->sort = $request->sort;
            
        if (!empty($request->file)) { 
            $destinationPath = public_path()."/images/blogs/";
            $files = $request->file;
            $blog = date('YmdHis') . '.' . $files->getClientOriginalExtension();
             
            if (isset($blog)) {
                $files->move($destinationPath, $blog);
            }

            $data->img = $blog;
        }
            $data->save();
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $result = Blog::where('id',$id)->first()->toArray();
        
        return view("admin_blog.details",["result" =>$result]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result = Blog::where('id',$id)->first()->toArray();
        
        return view("admin_blog.edit",["result" =>$result]);
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
        
         if (app()->getLocale() == 'ru') {
            $title_hy = 'Պարտադիր է լրացնել վերնագիրը հայերեն ';
            $title_ru = 'Պարտադիր է լրացնել վերնագիրը ռուսերեն';
            $title_en = 'Պարտադիր է լրացնել վերնագիրը անգլերեն';
            $description_hy = 'Պարտադիր է լրացնել նկարագրությունը հայերեն ';
            $description_ru = 'Պարտադիր է լրացնել նկարագրությունը ռուսերեն';
            $description_en = 'Պարտադիր է լրացնել նկարագրությունը անգլերեն';
        } elseif (app()->getLocale() == 'en') {
            $title_hy = 'Պարտադիր է լրացնել վերնագիրը հայերեն ';
            $title_ru = 'Պարտադիր է լրացնել վերնագիրը ռուսերեն';
            $title_en = 'Պարտադիր է լրացնել վերնագիրը անգլերեն';
            $description_hy = 'Պարտադիր է լրացնել նկարագրությունը հայերեն ';
            $description_ru = 'Պարտադիր է լրացնել նկարագրությունը ռուսերեն';
            $description_en = 'Պարտադիր է լրացնել նկարագրությունը անգլերեն';
        } elseif (app()->getLocale() == 'hy') {
            $title_hy = 'Պարտադիր է լրացնել վերնագիրը հայերեն ';
            $title_ru = 'Պարտադիր է լրացնել վերնագիրը ռուսերեն';
            $title_en = 'Պարտադիր է լրացնել վերնագիրը անգլերեն';
            $description_hy = 'Պարտադիր է լրացնել նկարագրությունը հայերեն ';
            $description_ru = 'Պարտադիր է լրացնել նկարագրությունը ռուսերեն';
            $description_en = 'Պարտադիր է լրացնել նկարագրությունը անգլերեն';
        }
        
       $validatedData = $request->validate([
            'title_hy' => ['required'],
            'title_ru' => ['required'],
            'title_en' => ['required'],
            'description_hy' => ['required'],
            'description_ru' => ['required'],
            'description_en' => ['required'],
        ],[

            'title_hy.required' => $title_hy,
            'title_ru.required' => $title_ru,
            'title_en.required' => $title_en,
            'description_hy.required' => $description_hy,
            'description_ru.required' => $description_ru,
            'description_en.required' => $description_en,

        ]);
         
            $data = Blog::find($id);
            $old_image = $data['img'];
            
            $data->title_hy = $request->title_hy;
            $data->title_ru = $request->title_ru;
            $data->title_en = $request->title_en;
            $data->description_hy = $request->description_hy;
            $data->description_ru = $request->description_ru;
            $data->description_en = $request->description_en;
            $data->sort = $request->sort;
            
        if (!empty($request->file)) { 
            $destinationPathFile = 'images/blogs/'.$old_image; 
            \File::delete(public_path($destinationPathFile));
            
            $destinationPath = public_path()."/images/blogs/";
            $files = $request->file;
            $blog = date('YmdHis') . '.' . $files->getClientOriginalExtension();
             
            if (isset($blog)) {
                $files->move($destinationPath, $blog);
            }

            $data->img = $blog;
        }
            $data->save();
            
            return redirect('/admin/dashboard/blogs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $result = Blog::where("id",$id)->first()->toArray();
        $destinationPathFile = 'images/blogs/'.$result['img'];
        \File::delete(public_path($destinationPathFile));
        Blog::where("id",$id)->delete();
        
        return redirect()->back();
        
    }
}
