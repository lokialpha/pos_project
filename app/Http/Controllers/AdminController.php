<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    // password change
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id',Auth::user()->id)->first();

        $dbHashValue = $user->password;

        if (Hash::check($request->oldPassword, $dbHashValue)) {
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);

            Auth::logout();
            return redirect()->route('auth#loginPage');

        }
        return back()->with(['notMatch'=>'The Old Password Not Match.Please Try Again!']);

    }

    // admin info page
    public function detail(){
        return view('admin.account.detail');
    }

    // admin info edit page
    public function edit(){
        return view('admin.account.edit');
    }

    // admin info update
    public function update($id,Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        User::where('id',$id)->update($data);
        return redirect()->route('admin#detail')->with(['updateSuccess' => 'Admin account updated...']);
    }

    // go admin account list
    public function list(){
        $admin = User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                  ->orWhere('email','like','%'.request('key').'%')
                  ->orWhere('gender','like','%'.request('key').'%')
                  ->orWhere('phone','like','%'.request('key').'%')
                  ->orWhere('address','like','%'.request('key').'%');
                })
                ->where('role','admin')
                ->paginate(3);
        $admin->appends(request()->all());
        return view('admin.account.accountList',compact('admin'));
    }



    // admin account delete
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Admin Account Deleted...']);
    }

    // change role
    public function change(Request $request){
        $updateSource = [
            'role' => $request->role
        ];
        User::where('id',$request->userId)->update($updateSource);
    }

    // request user Data
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'address'=> $request->address,
            'gender'=> $request->gender,
            'updated_at'=> Carbon::now()
        ];
    }

    // account Validation
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'image' => 'mimes:jpg,jpeg,png|file'
        ])->validate();
    }

    // password Validation Check
    private function passwordValidationCheck($request){
        $validationRules=[
            'oldPassword'=>'required|min:6|max:10',
            'newPassword'=>'required|min:6|max:10',
            'confirmPassword'=>'required|min:6|max:10|same:newPassword'
        ];

        Validator::make($request->all(),$validationRules)->validate();
    }
}
