<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MultiRole;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DataController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'lastname' => 'required|min:3|max:50',
            'firstname' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $hashedPassword = Hash::make($data['password']);

        $user = User::create([
            'lastname' => $data['lastname'],
            'firstname' => $data['firstname'],
            'email' => $data['email'],
            'password' => $hashedPassword,
        ]);

        $userId = $user->id;

        $defaultRoleId = 1;
        MultiRole::create([
            'userId' => $userId,
            'roleName' => $defaultRoleId,
        ]);

        auth()->login($user);

        return redirect('/');
        }

    public function login(Request $request)
    {
         $request->validate([
             'email' => 'required|email',
             'password' => 'required',
         ]);

         if (auth()->attempt($request->only('email', 'password'))) {

             return redirect()->intended('/');
         } else {

             return back()->with('error', 'Invalid credentials. Please try again.');
         }
    }

    public function logout()
    {
        auth()->logout();
    
        return redirect('/login')->with('success', 'You have been logged out successfully.');
    }
}
