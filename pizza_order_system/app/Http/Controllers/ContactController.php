<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // create home page
    public function homePage(){
        return view('user.contact.home');
    }

    //send message
    public function send($id, Request $request){
        $this->contactValidationCheck($request);
        $data = $this->getUserData($request);
        Contact::where('id',$id)->create($data);
        return back()->with(['sendSuccessful'=>'Message Send Successful...']);
    }


    //admin contact home page
    public function contactHomePage(){
        $contact = Contact::OrderBy('id','desc')->paginate(5);
        return view('admin.contact.home',compact('contact'));
    }

    //details contact
    public function detailsContact($id){
        $data = Contact::where('id',$id)->first();
        return view('admin.contact.details',compact('data'));
    }

    //delete Contact
    public function deleteMessage($id){
        Contact::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Message Delete Successful...']);
    }


    //request user data
    private function getUserData($request){
        return[
            'name' => $request->name ,
            'email' => $request->email ,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ];
    }

    //contact validation check
    private function contactValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email'=> 'required',
            'message' => 'required'
        ])->validate();
    }


}
