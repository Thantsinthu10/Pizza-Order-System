<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
     //change password page
     public function changePasswordPage()
     {
         return view('admin.account.changePassword');
     }
     //change password
     public function changePassword(Request $request)
     {
         //1. all field must fill
         //2.new password & confirm password length must be greater than 6
         //3.new password & confirm password must be same
         //4.Client old password must be same with db password
         //5.password change
         $this->passwordValidationCheck($request);

         $user = User::select('password')->where('id', Auth::user()->id)->first();
         $dbHashValue = $user->password; //hash value

         if (Hash::check($request->oldPassword, $dbHashValue)) {
             $data = [
                 'password' => Hash::make($request->newPassword)
             ];
             User::where('id', Auth::user()->id)->update($data);

             return redirect()->route('category#list')->with(['changeSuccess'=>'Password Changed Success...']);
         }
         return back()->with(['notMatch' => 'The Old Password not Match.Try Again!']);
     }

     //direct admin details page
     public function details(){
        return view('admin.account.details');
     }

     //direct admin profile page
    public function edit(){
       return view('admin.account.edit');
    }

    //update account
    public function update($id,Request $request){
        $this ->accountValidationCheck($request);
        $data = $this->getUserData($request);
        //for image
        if($request->hasFile('image')){
            //1.old image name | check => delete | store
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
               Storage::delete('public/'.$dbImage);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
           $request -> file('image')->storeAs('public',$fileName);
           $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess' =>'Admin Account Updated...']);

    }

    //admin list
    public function list(){
        $admin = User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                  ->orWhere('email','like','%'.request('key').'%')
                  ->orWhere('gender','like','%'.request('key').'%')
                  ->orWhere('phone','like','%'.request('key').'%')
                  ->orWhere('address','like','%'.request('key').'%');
        })
        ->where('role','admin')->paginate(4);
        $admin->appends(request()->all());
        return view('admin.account.list',compact('admin'));
    }

    //delete account
    public function delete($id){
       User::where('id',$id)->delete();
       return back()->with(['deleteSuccess'=>'Admin Account Delete Successful...']);
    }

 //change role
 public function changeRole(Request $request){

    User::where('id',$request->userId)->update([
        'role'=>$request->role
    ]);


}

    //change role
    // public function changeRole($id){
    //     $account = User::where('id',$id)->first();
    //     return view('admin.account.changeRole',compact('account'));
    // }

    //change
    public function change($id,Request $request){
        $data = $this->requestUserData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    //request user data
    private function requestUserData($request){
        return [
            'role' => $request->role
        ];
    }

    //request user data
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => Carbon::now()

        ];
    }

    //account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name'=> 'required',
            'email'=> 'required',
            'gender'=> 'required',
            'phone'=> 'required',
            'image'=> 'mimes:jpg,jpeg,png,webp|file',
            'address'=> 'required',
        ])->validate();
    }

     //password validation check
     private function passwordValidationCheck($request){
         Validator::make($request->all(), [
             'oldPassword' => 'required|min:6',
             'newPassword' => 'required|min:6',
             'confirmPassword' => 'required|min:6|same:newPassword',
         ])->validate();
     }
}
