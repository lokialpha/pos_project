<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //go user home
    public function home(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    public function filter($categoryId){
        $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }


    // admin->user list
    public function userList(){
        $users = User::when(request('key'),function($userQuery){
              $userQuery->orWhere('name','like','%'.request('key').'%')
                        ->orWhere('email','like','%'.request('key').'%')
                        ->orWhere('gender','like','%'.request('key').'%')
                        ->orWhere('phone','like','%'.request('key').'%')
                        ->orWhere('address','like','%'.request('key').'%');
                })
                ->where('role','user')
                ->paginate('2');
        $users->appends(request()->all());
        return view('admin.user.list',compact('users'));
    }

    // admin->user change role
    public function userChangeRole(Request $request){
        $updateSource = [
            'role' => $request->role
        ];
        User::where('id',$request->userId)->update($updateSource);
    }

    // user acc delete
    public function deleteUser($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Delete Success!']);
    }

    // use acc edit
    public function editUser($id){
        $user = User::where('id',$id)->first();
        return view('admin.user.edit',compact('user'));
    }

    // user info update
    public function updateUser($id,Request $request){
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
        return redirect()->route('admin#userList')->with(['success' => 'User account updated...']);
    }

    // password change page
    public function changePasswordPage(){
        return view('user.password.change');
    }

    // change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id',Auth::user()->id)->first();

        $dbHashValue = $user->password;

        if (Hash::check($request->oldPassword, $dbHashValue)) {
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);

            // Auth::logout();
            // return redirect()->route('auth#loginPage');
            return back()->with(['success' => 'Password Change Success...']);

        }
        return back()->with(['notMatch'=>'The Old Password Not Match.Please Try Again!']);

    }

    // go account change page
    public function accountChangePage(){
        return view('user.profile.account');
    }

    // account change
    public function accountChange($id,Request $request){
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
        return back()->with(['success' => 'Admin account updated...']);
    }

    // pizza detail
    public function detail($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.detail',compact('pizza','pizzaList'));
    }

    // cart list
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.image as pizza_image','products.price as pizza_price')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)
                    ->get();

        $totalPrice = 0;

        foreach ($cartList as $c) {
            $totalPrice += $c->pizza_price * $c->qty;
        }

        return view('user.main.cart',compact('cartList','totalPrice'));
    }


    // cart history
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate('6');
        return view('user.main.history',compact('order'));
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
