<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserVerify;
use Hash;
use Auth;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Str;
use Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Response;
class UserController extends BaseController
{


    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    function register(Request $request){
       $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $details = [
                'title' => 'Mail from Dating.com',
                'body' => 'Please Verified Email !.... '
            ];
        $token = Str::random(64);
      
            UserVerify::create([
                  'user_id' => $user->id, 
                  'token' => $token
                ]);
      Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\MyTestMail($details , ['token' => $token]));
   
       
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
   

        return $this->sendResponse($success, 201);        
    }

    
	public function login(Request $request)
	{
	    $data = [
	        'email' => $request->email,
	        'password' => $request->password

	    ];
	    
	   $user = User::where('email',$request->email)->first();


		if(!$user){
		    return response()->json(['error' => 'user not found create new acoount !'], 401);
		}
        if($user->status === 0){
           return response()->json(['error' => 'Account has been UnApproved ! '], 402);
        }
       if($user->is_email_verified === 0){
           return response()->json(['error' => 'Please Verify Your Email Account After Login ! '], 403);
        }


		if (!Hash::check($request->password,$user->password)) {
		    return response()->json(['error' => 'Your password does not match ! '], 404);
		}
        

         else {
		    auth()->login($user);
            $token = $user->createToken($this->generateRandomString())->accessToken;
             $response = [
                    'user' => $user,
                    'token' => $token,
                ];
		    return response($response, 200);
		}
		return $token ;
	}

    public function logout(Request $request) {
        if ($request->user()) { 
            $request->user()->tokens()->delete();
        }

        return response()->json(['message' => 'You have been successfully logged out.'], 200);
        }



    // function show(){
    // 	$data = User::all();
    // 	return $data;
    // }

    // function deleteUser(Request $request,$id){
    //     $data = User::where('id',$request->id)->delete();
    // 	return $data;
    // }

    // function edit($id){
    //     $data = User::where('id',$id)->first();
    // 	return $data;
    // }

    // function update(Request $request, $id) {
       
    //    $item =  User::where('id',$id)->first();
    //    $item->update($request->all());
    //    return $item;
    // }


         public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
  
        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
              
            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }
  
            // return redirect()->url('http://localhost:3000/login')->response($message, 200);
     return redirect(('http://localhost:3000') . '/login');
    }
}
