<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\ServiceProvider;
use DB;
use Illuminate\Support\Facades\View;

class ViewProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        /***** site phone *****/
        
            $phone = DB::table('other')->where("property","=","phone")->first();
          
            view()->composer('layout',function($view) use ($phone)
            {
                $view->with('phone', $phone);
            });
            
           
          
        
        
       

    }
}
