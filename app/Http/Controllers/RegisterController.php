<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\ConfirmPassword;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register', [
            'title' => 'Register',
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'gender' => ['required'],
            'password' => 'required|min:5|max:255',
            'password_confirmation' => ['required', 'string', new ConfirmPassword($request->password)],
            'role' => 'required'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        // $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registrasi berhasil!! Silahkan Login.');
    }
}
