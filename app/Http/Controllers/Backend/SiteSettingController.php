<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteSettingRequest;
use App\Models\SiteSetting;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Image;


class SiteSettingController extends Controller
{
    public function store(SiteSettingRequest $request){
        $data = $request->all();

        if($request->title_image){
            $title_image = $this->imageUploade($request->title_image,'title_image');
            $data['title_image'] = $title_image;
        }

        if($request->share_image){
            $share_image = $this->imageUploade($request->share_image, 'share_image');
            $data['share_image'] = $share_image;
        }
        
        SiteSetting::create($data);
    }

    private function imageUploade($image, $name){
        $positon = strpos($image,';');
        $sub = substr($image,0,$positon);
        $ext = explode('/',$sub)[1];

        $tempName = $this->imageName(); 
        $imgName = $tempName. '.' .$ext;

        if($name == 'title_image'){
            $img = Image::make($image)->resize(200,200);
        }else{
            $img = Image::make($image)->resize(400,400);
        }

        $img->save(public_path('/media/setting/') . $imgName);
        $img_name =  "/media/setting/" . $imgName;
        return $img_name;
        
    }

    private function imageName(){
        $charectere = 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z';
        $number = '123456789';
        $newCharecter = explode(',',$charectere);
        $charectere = implode('',$newCharecter);
        $char = '';
        
        for($i=1; $i <= 10;$i++){
          if($i <6){
            $char .= $charectere[rand(0,25)];
          }elseif($i<=9 && $i >= 5){
            $char .= $number[rand(0,8)];
          }elseif($i == 10){
            $char .= $charectere[rand(0,25)];
          }
        }     
        return $char;
    }

    public function edit(){
        $site_setting = SiteSetting::first();
        return response()->json($site_setting);
    }

    public function update(Request $request,SiteSetting $site_setting){
        $data = $request->all();

        if($request->title_image){
            $title_image = $this->imageUploade($request->title_image,'title_image');
            if($request->old_title_image){
                $this->deleteOldImage($request->old_title_image);
            }   
            $data['title_image'] = $title_image;
        }

        if($request->share_image){
            $share_image = $this->imageUploade($request->share_image, 'share_image');
            if($request->old_share_image){
                $this->deleteOldImage($request->old_share_image);
            }     
            $data['share_image'] = $share_image;
        }
        unset($data['old_title_image']);
        unset($data['old_share_image']);
        $site_setting->update($data);
    }
    private function deleteOldImage($img){
        $oldImg = ltrim($img,'/'); 
        unlink($oldImg);
    }

    // cocial media link 

    public function getSocialMediaLink()
    {
        $links = SocialMedia::latest()->get();
        return response()->json($links);
    }

    public function storeSocialMediaLink(Request $request)
    {
        SocialMedia::create(
            $request->validate([
                'link_url' => 'required',
                'link_icon' => 'required',
            ])
        );
    }

    public function updateSocialMediaLink(Request $request,SocialMedia $socialMedia)
    {
        $socialMedia->update(
            $request->validate([
                'link_url' => 'required',
                'link_icon' => 'required',
            ])
        );
    }
}
