<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Image;

class ProfileController extends Controller
{
    public function getCurrentUser()
    {
        $currentUser = Auth::user();
        return response()->json($currentUser);
    }

    public function updateProfile(Request $request,User $user)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' =>['required','max:200'],
            'user_name' => 'required|unique:users,user_name,'.$user->id,
            'phone' =>['required','regex:/(01)[0-9]{9}/'],
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        ]);

        $data = $this->handelRequest($request);

        $user->update($data);
        
    }
    private function  handelRequest($request){

        $input = $request->all();
        $input['slug'] = str_slug($input['user_name']); 
        unset($input['old_img']);

        if($request->profile_img){
            if($request->old_img){
                $this->deleteold_img($request->old_img);
            }
            $position = strpos($request->profile_img, ';');
            $sub = substr($request->profile_img, 0, $position);
            $ext = explode('/',$sub)[1];

            $tempName = $input['slug']; 
            $userImageName = $tempName. '.' .$ext;

            $img = Image::make($request->profile_img)->resize(150,200);

            $img->save(public_path('/media/user/') . $userImageName);
            $input["profile_img"] = "/media/user/" . $userImageName;
        }

        return $input;
    }

    private function deleteold_img($old_img){
        $old_img = ltrim($old_img,'/'); 
        unlink($old_img);
    }
}
