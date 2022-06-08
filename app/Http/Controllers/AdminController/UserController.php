<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Arr;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
   public function index(){

    $data = User::paginate(10); 
   //  dd($data);
    return view('Admin.User.index', compact('data'));
   }

   public function destroy($id)
   {
   
      User::find($id)->delete($id);
    
      return response()->json([
          'success' => Alert::success('Deleted', 'User Deleted Successfully')
          
      ]);
  }
  public function approve(Request $request,$id)
  { 
      $user = User::find($id);
      // dd($member);
      if($user->status == 1){
          $user->status = 0 ;
          $user->save();
          Alert::success('UnApprove', 'User Unapprove Successfully');

      }
      else{
          $user->status = 1 ;
          $user->save();
          Alert::success('Approve', 'User Approve Successfully');

      }
  
  return redirect()->back(); 
}

}
