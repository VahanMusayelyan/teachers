<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Education;

class AdminEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Education::paginate(10);

        return view("admin_education.list", ["result" => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin_education.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'education_hy' => ['required'],
            'education_ru' => ['required'],
            'education_en' => ['required']
                ], [
            'education_hy.required' => "Պարտադիր է լրացնել",
            'education_ru.required' => "Պարտադիր է լրացնել",
            'education_en.required' => "Պարտադիր է լրացնել"
        ]);


        $data = new Education;
        $data->education_hy = $request->education_hy;
        $data->education_ru = $request->education_ru;
        $data->education_en = $request->education_en;
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
        $result = Education::where("id", $id)->first()->toArray();

        return view("admin_education.edit", ["result" => $result]);
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
         $validatedData = $request->validate([
            'education_hy' => ['required'],
            'education_ru' => ['required'],
            'education_en' => ['required']
                ], [
            'education_hy.required' => "Պարտադիր է լրացնել",
            'education_ru.required' => "Պարտադիր է լրացնել",
            'education_en.required' => "Պարտադիր է լրացնել"
        ]);



        $data = Education::find($id);
        $data->education_hy = $request->education_hy;
        $data->education_ru = $request->education_ru;
        $data->education_en = $request->education_en;
        $data->save();
        
        return redirect('/admin/dashboard/education');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Education::where('id',$id)->delete();
        
        return redirect()->back();
    }
}
