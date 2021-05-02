<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;

class AdminCommentController extends Controller
{
    public function index() {
       
        $result = Comment::select("comments.*","users.name as user_name","users.l_name as user_lname","users.id as userId")
                ->leftjoin("users","users.id","=","comments.user_id")->orderBy("comments.id","desc")->paginate(10);
      
        return view("admin.comment",["result" =>$result]);
    }
    
    public function del_comment($id) {
        
        Comment::where('id',$id)->delete();
        $result = Comment::select("comments.*","users.name as user_name","users.l_name as user_lname","users.id as userId")
                ->leftjoin("users","users.id","=","comments.user_id")->orderBy("comments.id","desc")->paginate(10);
      
        return view("admin.comment",["result" =>$result]);
    }
}
