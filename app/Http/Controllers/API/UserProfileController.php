<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Response;
use DB;
class UserProfileController extends Controller
{
    public function create(Request $request){
        
        $input = $request->all();
        // return$input;

         if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
          }
        $user = UserProfile::create($input);
       if($user){
        return response('profile Added Successfully' ,200);
       }else{
        return response('some went to wrong !' , 401);
       }
    }

    public function profileGet(){
      // $data = UserProfile::all();

      $data = DB::table('user_profiles')
                ->inRandomOrder()
                ->get();
      return $data;
    }

}
