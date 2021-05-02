<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use DB;

class BlogController extends Controller
{
    public function index() {
       $blogs = Blog::paginate(8);
       $sort_blogs = Blog::orderBy('sort','desc')->paginate(8);
        $meta_tags= DB::table('meta_tags')->where('page','blog')->first();

        return view('blog', ['blogs' => $blogs,'sort_blogs' => $sort_blogs,'meta_tags'=>$meta_tags]);
    }

    public function show($lang = null,$blog_id = null) {

       $blogs = Blog::where('id',$blog_id)->first();
       $sort_blogs = Blog::orderBy('sort','desc')->paginate(8);


       $meta_tags = clone $blogs;
        $blog_desc_hy = $meta_tags->description_hy;
        $blog_desc_en = $meta_tags->description_en;
        $blog_desc_ru = $meta_tags->description_ru;

        $blog_desc_hy = explode( ':',$blog_desc_hy)[0];
        $blog_desc_en = explode( '.',$blog_desc_en);
        $blog_desc_ru = explode( '.',$blog_desc_ru);

        if(strlen($blog_desc_en[0]) > 2){
            $blog_desc_en =$blog_desc_en[0];
        }else{
              $blog_desc_en = $blog_desc_en[0].''.$blog_desc_en[1];
        }

        if(strlen($blog_desc_ru[0]) > 2){
           $blog_desc_ru =$blog_desc_ru[0];
        }else{
            $blog_desc_ru = $blog_desc_ru[0].''.$blog_desc_ru[1];
        }

        $meta_tags->description_hy = $blog_desc_hy;
        $meta_tags->description_en = $blog_desc_en;
        $meta_tags->description_ru = $blog_desc_ru;


//        dd($meta_tags);

       return view('show-blog', ['blogs' => $blogs,'sort_blogs' => $sort_blogs,'meta_tags' => $meta_tags]);
    }
}
