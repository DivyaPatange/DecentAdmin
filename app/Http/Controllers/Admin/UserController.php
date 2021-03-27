<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Admin::where('acc_type', '=', 'admin')->get();
        if(request()->ajax()) {
            return datatables()->of($users)
            ->addColumn('action', 'admin.user.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admins',
            'password' => 'required|confirmed',
            'role_access' => 'required',
        ]);
        // dd($request->role_access);
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->acc_type = "admin";
        $admin->role_access = implode(",", $request->role_access);
        $admin->save();
        return redirect('/admin/users')->with('success', 'User Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Admin::findorfail($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::findorfail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'unique:admins,email,'.$id,
            'role_access' => 'required',
        ]);
        $input_data = array (
            'name' => $request->name,
            'email' => $request->email,
            'role_access' => implode(",",$request->role_access), 
        );
        Admin::whereId($id)->update($input_data);
        return redirect('/admin/users')->with('success', 'User Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findorfail($id);
        $admin->delete();
        return response()->json(['success' => 'User Deleted Successfully']);
    }
}
