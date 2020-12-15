<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function show()
    {
        $data['user']=auth()->user();

        return response()->json([
            'response_code'=>  '00',
            'response_message'=>'Profile user telah ditampilkan',
            'data'=>$data,
        ]);
    }

    public function update(Request $request){
        $user=auth()->user();
        if ($request->hasFile('photo_profile')) {
            $photo=$request->file('photo_profile');
            $photo_extensi=$photo->getClientOriginalExtension();
            $photo_name=Str::slug($user->name,'-').'-'.$user->id.'.'.$photo_extensi;
            $photo_folder='/photo/users/photo-profile/';
            $photo_location= $photo_folder.$photo_name;
            try {
                $photo->move(public_path($photo_folder),$photo_name);
                $user->update([
                    'photo_profile'=>$photo_location
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'response_code'=>'01',
                    'response_message'=> 'photo profile user gagal di upload',
                    'data'=>$data,
                ],401);
            }

        }
        $user->update([
            'name'=>$request->name
        ]);

        $data['user']=$user;

        return response()->json([
            'response_code'=>'00',
            'response_message'=> 'Profile user berhasil di update',
            'data'=>$data,
        ],200);
    }
    
}
