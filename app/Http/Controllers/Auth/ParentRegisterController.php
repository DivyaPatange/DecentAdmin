<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentLogin;
use Illuminate\Support\Facades\Hash;

class ParentRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:parent')->except('logout');
    }

    public function showRegisterForm()
    {
      return view('parents.register');
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'unique:parent_logins',
            'mobile_no' => 'required',
            'address' => 'required',
            'password' => 'required|confirmed|min:8',
            'username' => 'required|unique:parent_logins',
        ]);
        $parentR = new ParentLogin();
        $parentR->name = $request->name;
        $parentR->email = $request->email;
        $parentR->mobile_no = $request->mobile_no;
        $parentR->address = $request->address;
        $parentR->username = $request->username;
        $parentR->password = Hash::make($request->password);
        $parentR->save();
        return redirect('/parent/login')->with('success', 'Registration is Successfully Done!');
    }
}
