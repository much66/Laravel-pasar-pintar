<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Rules\ConfirmPassword;

class UserController extends Controller
{
    public function storeForm1(Request $request){
        $rules = [
            'image' => 'required|image|file|max:1024'
        ];

        $validatedData = $request->validate($rules);

        if($request->file('image')){
            if(auth()->user()->image){
                Storage::delete(auth()->user()->image);
            }
            $validatedData['image'] = $request->file('image')->store('user-images', 'public');
        }
        User::where('id', auth()->user()->id)->update($validatedData);
        return redirect('/profile')->with('success', 'Foto Profil Berhail Diupdate');
    }

    public function storeForm2(Request $request){
        $rules = [
            'name' => 'required|max:100',
            'tanggal_lahir' => 'required',
            'gender' => 'required'
        ];
        $validatedData = $request->validate($rules);
        User::where('id', auth()->user()->id)->update($validatedData);
        return redirect('/profile')->with('success', 'Biodata Berhail Diupdate');
    }

    public function storeForm3(Request $request){
        $rules = [];
        if($request->email != auth()->user()->email){
            $rules['email'] = 'required|email:dns|unique:users';
        }
        if($request->no_telp != auth()->user()->no_telp){
            $rules['no_telp'] = 'required|max:13';
        }
        $validatedData = $request->validate($rules);
        User::where('id', auth()->user()->id)->update($validatedData);
        return redirect('/profile')->with('success', 'Kontak Berhail Diupdate');
    }

    public function storeForm4(Request $request){
        $validatedData = $request->validate([
                 'alamat' => [
                 'required',
                 'min:50',
                 'max:255'
                 ]
        ]);
        User::where('id', auth()->user()->id)->update($validatedData);
        return redirect('/profile')->with('success', 'Alamat Berhail Diupdate');
    }
    public function storeForm5(Request $request){
    $user = auth()->user();
    if (!Hash::check($request->old_password, $user->password)) {
        return redirect('/profile')->with('error', 'Password lama salah');
    }
    $rules = [
        'password' => [
            'required',
            'string',
            'min:5',
        ],
        'password_confirmation' => ['required', 'string', new ConfirmPassword($request->password)],
    ];

    $request->validate($rules);

    $validatedData['password'] = bcrypt($request->password); // Enkripsi password baru

    User::where('id', auth()->user()->id)->update($validatedData);

    return redirect('/profile')->with('success', 'Password Berhasil Diupdate');
}

}
