<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    // contact
    public function contact(){
        return view('user.contact.contact');
    }

    // sent Message
    public function sentMessage(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestContactData($request);
        Contact::create($data);
        return redirect()->route('user#home');
    }

    // contact message list
    public function messageList(){
        $messages = Contact::get();
        return view('admin.contact.contactList',compact('messages'));
    }

    // delete contact message
    public function deleteContact($id){
        Contact::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Delete Success!']);
    }

    // validation
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ])->validate();
    }

    // request user Data
    private function requestContactData($request){
        return [
            'name' => $request->name,
            'email'=> $request->email,
            'message'=> $request->message,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ];
    }


}
