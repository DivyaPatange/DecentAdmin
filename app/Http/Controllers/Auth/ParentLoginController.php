<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use DB;

class ParentLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:parent')->except('logout');
    }

    public function showLoginForm()
    {
      return view('parents.login');
    }
    
    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'username'   => 'required',
        'password' => 'required|min:6'
      ]);
      
      // Attempt to log the user in
      if (Auth::guard('parent')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('parent.dashboard'));
      } 
      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('username', 'remember'))->with('danger', 'Incorrect Credentials');
    }

    public function logout()
    {
        Auth::guard('parent')->logout();
        return redirect('/parent/login');
    }
}
