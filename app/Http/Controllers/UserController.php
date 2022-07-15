<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::latest()->get();

        return view('users.index', $data);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|max:40',
            'phone'         => 'required|unique:users|max:20',
            'email'         => 'required|email|unique:users|max:80',
            'password'      => 'required|min:6',
            'user_identity' => 'required|integer|unique:users',
            'dob'           => 'required|date',
            'gender'        => 'required',
            'image'         => 'required|image',
            'role'          => 'required',
            'address'       => 'required',
        ]);

        $user                = new User();
        $user->name          = $request['name'];
        $user->email         = $request['email'];
        $user->phone         = $request['phone'];
        $user->password      = Hash::make($request['password']);
        $user->user_identity = $request['user_identity'];
        $user->dob           = $request['dob'];
        $user->gender        = $request['gender'];
        $user->role          = $request['role'];
        $user->address       = $request['address'];

        $file      = $request->file('image');
        $file_name = base64_encode($request['user_identity']) . '.' . $file->getClientOriginalExtension();
        $path      = 'images';
        $file->move($path, $file_name);
        $user->image = $path . '/' . $file_name;

        if ($user->save()) {
            Alert::success('Success', 'New User added successfully');
            return redirect()->route('users.index');
        } else {
            Alert::error('Error', 'Wrong!! try again');
            return redirect()->back();
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'          => 'required|max:40',
            'phone'         => 'required|max:20|unique:users,phone,' . $user->id,
            'email'         => 'required|max:80|unique:users,email,' . $user->id,
            'user_identity' => 'required|integer|unique:users,user_identity,' . $user->id,
            'dob'           => 'required|date',
            'gender'        => 'required',
            'role'          => 'required',
            'address'       => 'required',
        ]);

        $user                = User::findOrFail($user->id);
        $user->name          = $request['name'];
        $user->email         = $request['email'];
        $user->phone         = $request['phone'];
        $user->user_identity = $request['user_identity'];
        $user->dob           = $request['dob'];
        $user->gender        = $request['gender'];
        $user->role          = $request['role'];
        $user->address       = $request['address'];

        if($request->hasFile('image')){
            $file      = $request->file('image');
            $file_name = base64_encode($request['user_identity']) . '.' . $file->getClientOriginalExtension();
            $path      = 'images';
            $file->move($path, $file_name);
            if(file_exists($user->image))
            {
                unlink($user->image);
            }
            $user['image'] = $path.'/'.$file_name;
        }

        if ($user->save()) {
            Alert::success('Success', 'User Updated successfully');
            return redirect()->route('users.index');
        } else {
            Alert::error('Error', 'Wrong!! try again');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        User::destroy($id);

        Alert::success('Success', 'User deleted successfully');

        return redirect()->route('users.index');
    }

    public function profile()
    {
        $data['userData'] = Auth::user();
        return view('users.profile',$data);
    }
}
