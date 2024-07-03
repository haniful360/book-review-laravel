<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;

class AccountController extends Controller
{
    public function register()
    {
        return view('account.register');
    }

    public function processRegister(RegisterRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|min:3',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|confirmed|min:5',
        //     'password_confirmation' => 'required'
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->route('account.register')->withInput()->withErrors($validator);
        // }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('account.login')->with('success', 'You have registered Successfully');
    }

    public function login()
    {
        return view('account.login');
    }

    public function authenticate(LoginRequest $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('account.profile');
        } else {
            return redirect()->route('account.login')->with('error', 'Either Email/Password is not correct');
        }
    }

    public function profile()
    {

        $user = User::find(Auth::user()->id);
        // dd($user);

        return view('account.profile', [
            'user' => $user,
        ]);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {

        $user = User::find(Auth::user()->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // image upload
        // if(!empty($request->image)){

        //     // delete file
        //     File::delete(public_path('uploads/profile/'.$user->image));

        //     $image = $request->image;
        //     $ext = $image->getClientOriginalExtension();
        //     $imageName = time().'.'.$ext; //121212.jpg
        //     $image->move(public_path('uploads/profile'),$imageName);

        //     $user->image = $imageName;
        //     $user->save();

        // }
        if ($request->hasFile('image')) {

            if ($user->image) {
                File::delete(public_path('uploads/profile/' . $user->image));
            }

            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; //121212.jpg
            $image->move(public_path('uploads/profile'), $imageName);

            $user->image = $imageName;
            $user->save();
        }

        return redirect()->route('account.profile')->with('success', "Profile Updated Successfully");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }
}
