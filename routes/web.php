<?php

use Illuminate\Support\Facades\Route;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::redirect('/', '/hy');



Route::group(['prefix' => '{lang}', 'middleware' => 'setLocale'], function() {
    Auth::routes();

    Route::get('/', 'MenuController@index')->name('welcome');

    Route::get('/register', 'Auth\RegisterController@register_page')->name('register');

    Route::get('/contact', 'MenuController@contact_us')->name('cont_us');

    Route::get('/about', 'MenuController@about')->name('about');
    Route::get('/blog', 'BlogController@index')->name('blog_list');
    Route::get('/blog/{blog_id}', 'BlogController@show')->name('blog_show');
    Route::get('/subjects', 'MenuController@subjects')->name('subject_show');
    Route::get('/subjects/{subject_id}', 'UserController@choosen_subjects_second')->name('choosen_subject_second');
    Route::get('/teacher/', 'UserController@index')->name('teachers_show');
    Route::get('/teacher/{id}', 'UserController@show')->name('show');
    Route::get('/{id}/comment', 'CommentRateController@show')->name('show_comment');
    Route::get('/account', 'UserController@account')->name('account')->middleware('auth');
    Route::get('/profile', 'UserController@profile')->name('profile')->middleware('auth');
    Route::get('/archive', 'UserController@archive')->name('profile')->middleware('auth');

    Route::get('/suggest-teacher', function () {

        return view('suggest-teacher');
    });
    
    Route::get('/suggest-teacher', 'SuggestTeacherController@show_form')->name('suggest_teacher_form');

    
    Route::post('/contact', 'MenuController@contact')->name('contact');

    Route::post('/search', 'UserController@search')->name('search');

    Route::post('/suggest-teacher', 'SuggestTeacherController@index')->name('suggest_teacher');

    Route::post('/add-comment', 'CommentRateController@add_comment')->name('add_teacher_comment');

    Route::post('/contact-teacher', 'CommentRateController@contact_teacher')->name('contact_teacher');

    Route::post('/prifile-update', 'UserController@update_profile')->name('update_profile');

    Route::any('/find-teacher', 'UserController@subject_city')->name('subject_city');

    Route::any('/teachers-subjects', 'UserController@choosen_subject')->name('choosen_subject');

    Route::any('/teachers-filter', 'UserController@filter')->name('filter');
    
    Route::any('/reset-password', 'ResetPasswordController@reset')->name('res_password');
    
    Route::any('/reset', 'ResetPasswordController@resetpassword')->name('resetpassword');
    
    Route::get('/update-password/{token}', function ($lang) {
        return view('reset');
    });
    Route::get('/verify/{token}', 'VerifyController@index')->name('verfy_email_u');\
    
    Route::post('/resend', 'VerifyController@resend')->name('resend');
    

});

 Route::get('/admin/dashboard', 'AdminController@index')->name('dashboard_index')->middleware('auth');
 Route::get('/admin/dashboard/comments', 'AdminCommentController@index')->name('dashboard_comment_index')->middleware('auth');
 Route::any('/admin/dashboard/comments/{id}', 'AdminCommentController@del_comment')->name('del_comment')->middleware('auth');
 Route::any('/admin/dashboard/contact-us', 'AdminController@contact')->name('contact_us_admin')->middleware('auth');
 Route::any('/admin/dashboard/contact-teachers', 'AdminController@contact_teachers')->name('contact_teachers_admin')->middleware('auth');

 Route::resource('/admin/dashboard/blogs', 'AdminBlogController')->middleware('auth');
 Route::resource('/admin/dashboard/subjects', 'AdminSubjectController')->middleware('auth');
 Route::resource('/admin/dashboard/education', 'AdminEducationController')->middleware('auth');
 Route::get('/admin/dashboard/teachers', 'AdminController@teachers')->middleware('auth');
 Route::get('/admin/dashboard/teachers/{id}', 'AdminController@teacher_show')->middleware('auth');
 Route::post('/admin/dashboard/teachers/{id}', 'AdminController@teacher_show')->middleware('auth');
 Route::any('/admin/dashboard/suggest-teachers', 'AdminController@suggest_teachers')->middleware('auth');
 Route::get('/admin/dashboard/subject/{id}', 'AdminController@subject_teacher')->middleware('auth');
 Route::get('/admin/dashboard/other', 'AdminController@other')->middleware('auth');
 Route::get('/admin/dashboard/language', 'AdminController@language')->middleware('auth');
 Route::get('/admin/dashboard/download/{filename}', 'AdminController@download')->middleware('auth');
 
 
 Route::post('/admin/dashboard/other', 'AdminController@update_other')->middleware('auth');
 Route::any('/admin/dashboard/search', 'AdminController@search_teacher')->name('search_admin')->middleware('auth');
 Route::post('/admin/dashboard/language', 'AdminController@update_language')->middleware('auth');

 Route::get('/admin/dashboard/metatag', 'MetaTagController@index')->name('admin_metatag')->middleware('auth');
 Route::post('/admin/dashboard/metatag', 'MetaTagController@tag_add')->name('tag_add')->middleware('auth');
//  Route::post('/admin/dashboard/metatag/{$id}', 'MetaTagController@tag_edit')->name('tag_edit')->middleware('auth');

//  Route::post('/admin/dashboard/metatag', 'MetaTagController@tag_delete')->name('tag_delete')->middleware('auth');
Route::get('/admin/dashboard/metatag_edit/{id}', 'MetaTagController@tag_edit')->name('tag_edit')->middleware('auth');
Route::post('/admin/dashboard/metatag_edit/{id}', 'MetaTagController@tag_update')->name('tag_update')->middleware('auth');



Route::post('/ajax-regions', 'AjaxController@regions')->name('ajax_regions');
Route::post('/ajax-cities', 'AjaxController@cities')->name('ajax_cities');
Route::post('/ajax-subject', 'AjaxController@subject')->name('ajax_subject');
Route::post('/ajax-subject-add', 'AjaxController@subject_add')->name('ajax_subject_add');
Route::post('/ajax-cert-del', 'AjaxController@del_cert')->name('del_cert');
Route::post('/ajax-sub-del', 'AjaxController@del_sub')->name('del_sub');
Route::post('/ajax-comment', 'AjaxController@comment')->name('check_comment');
Route::post('/ajax-user-active', 'AjaxController@user_active')->name('user_active');
Route::post('/ajax-admin-emailsend', 'AjaxController@sendemail')->name('sendemail');
Route::post('/ajax-teacher-emailsend', 'AjaxController@sendemailteacher')->name('sendemailteacher');
Route::post('/ajax-teacher-emailsendsecond', 'AjaxController@sendemailteachersecond')->name('sendemailteachersecond');
Route::post('/ajax-teacher-all', 'AjaxController@sendemailall')->name('sendall');
Route::post('/ajax-teacher-accept', 'AjaxController@acceptnot')->name('acceptnot');
Route::post('/ajax-teacher-decline', 'AjaxController@declinenot')->name('declinenot');
Route::post('/ajax-teacher-archive', 'AjaxController@archivenot')->name('archive');
Route::post('/ajax-teacher-modal', 'AjaxController@modal')->name('modal');
Route::post('/ajax-teacher-deleteslider', 'AjaxController@deleteslider')->name('deleteslider');
//    Route::post('/ajax-filter','AjaxController@filter')->name('ajax_filter');
  
    
    




