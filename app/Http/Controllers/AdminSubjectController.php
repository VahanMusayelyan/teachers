<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Subject;

class AdminSubjectController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $result = Subject::paginate(10);

        return view("admin_subject.list", ["result" => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view("admin_subject.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if (app()->getLocale() == 'ru') {
            $subject_hy = 'Պարտադիր է լրացնել առարկան հայերեն ';
            $subject_ru = 'Պարտադիր է լրացնել առարկան ռուսերեն';
            $subject_en = 'Պարտադիր է լրացնել առարկան անգլերեն';
        } elseif (app()->getLocale() == 'en') {
            $subject_hy = 'Պարտադիր է լրացնել առարկան հայերեն ';
            $subject_ru = 'Պարտադիր է լրացնել առարկան ռուսերեն';
            $subject_en = 'Պարտադիր է լրացնել առարկան անգլերեն';
        } elseif (app()->getLocale() == 'hy') {
            $subject_hy = 'Պարտադիր է լրացնել առարկան հայերեն ';
            $subject_ru = 'Պարտադիր է լրացնել առարկան ռուսերեն';
            $subject_en = 'Պարտադիր է լրացնել առարկան անգլերեն';
        }
        
        $validatedData = $request->validate([
            'subject_hy' => ['required'],
            'subject_ru' => ['required'],
            'subject_en' => ['required']
                ], [
            'subject_hy.required' => $subject_hy,
            'subject_ru.required' => $subject_ru,
            'subject_en.required' => $subject_en
        ]);

        if (!empty($request->school_subjects)) {
            $school_subjects = 1;
        } else {
            $school_subjects = 0;
        }
        if (!empty($request->foreign_langs)) {
            $foreign_langs = 1;
        } else {
            $foreign_langs = 0;
        }
        if (!empty($request->final_entrance)) {
            $final_entrance = 1;
        } else {
            $final_entrance = 0;
        }
        if (!empty($request->for_students)) {
            $for_students = 1;
        } else {
            $for_students = 0;
        }
        if (!empty($request->other)) {
            $other = 1;
        } else {
            $other = 0;
        }

        $data = new Subject;
        $data->subject_hy = $request->subject_hy;
        $data->subject_ru = $request->subject_ru;
        $data->subject_en = $request->subject_en;
        $data->school_subjects = $school_subjects;
        $data->foreign_langs = $foreign_langs;
        $data->final_entrance = $final_entrance;
        $data->for_students = $for_students;
        $data->other = $other;
        $data->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $result = Subject::where("id", $id)->first()->toArray();

        return view("admin_subject.edit", ["result" => $result]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        if (app()->getLocale() == 'ru') {
            $subject_hy = 'Պարտադիր է լրացնել առարկան հայերեն ';
            $subject_ru = 'Պարտադիր է լրացնել առարկան ռուսերեն';
            $subject_en = 'Պարտադիր է լրացնել առարկան անգլերեն';
        } elseif (app()->getLocale() == 'en') {
            $subject_hy = 'Պարտադիր է լրացնել առարկան հայերեն ';
            $subject_ru = 'Պարտադիր է լրացնել առարկան ռուսերեն';
            $subject_en = 'Պարտադիր է լրացնել առարկան անգլերեն';
        } elseif (app()->getLocale() == 'hy') {
            $subject_hy = 'Պարտադիր է լրացնել առարկան հայերեն ';
            $subject_ru = 'Պարտադիր է լրացնել առարկան ռուսերեն';
            $subject_en = 'Պարտադիր է լրացնել առարկան անգլերեն';
        }
        
       $validatedData = $request->validate([
            'subject_hy' => ['required'],
            'subject_ru' => ['required'],
            'subject_en' => ['required']
                ], [
            'subject_hy.required' => $subject_hy,
            'subject_ru.required' => $subject_ru,
            'subject_en.required' => $subject_en
        ]);

        if (!empty($request->school_subjects)) {
            $school_subjects = 1;
        } else {
            $school_subjects = 0;
        }
        if (!empty($request->foreign_langs)) {
            $foreign_langs = 1;
        } else {
            $foreign_langs = 0;
        }
        if (!empty($request->final_entrance)) {
            $final_entrance = 1;
        } else {
            $final_entrance = 0;
        }
        if (!empty($request->for_students)) {
            $for_students = 1;
        } else {
            $for_students = 0;
        }
        if (!empty($request->other)) {
            $other = 1;
        } else {
            $other = 0;
        }
        Subject::where('id',$id)->delete();
        
        $data = new Subject;
        $data->subject_hy = $request->subject_hy;
        $data->subject_ru = $request->subject_ru;
        $data->subject_en = $request->subject_en;
        $data->school_subjects = $school_subjects;
        $data->foreign_langs = $foreign_langs;
        $data->final_entrance = $final_entrance;
        $data->for_students = $for_students;
        $data->other = $other;
        $data->save();
        
        return redirect('/admin/dashboard/subjects');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
        Subject::where('id',$id)->delete();
        
        return redirect()->back();
    }

}
