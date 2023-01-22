<?php
namespace App\View\Composers;

use App\Models\SiteSetting;

use Illuminate\View\View;

class HomePageComposer{
    public function compose(View $view){
        $site_setting = SiteSetting::first();
        if($site_setting){
            $view->with('site_setting',$site_setting); 
        }
    }
}