<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
   
     public function register(Request $request)
    {
        $fields = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'hp' => 'required|string'
        ]);


        $user = User::create([
            'nama' => $fields['nama'],
            'email' => $fields['email'],
            'hp' => $fields['hp'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('tokenku')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        //check email
        $user = User::where('email', $fields['email'])->first();

        //password
        if (!$user || !Hash::check($fields['password'], $user->password))
        return response([
            'message' => 'unauthorized'
        ], 401);
        
    

    $token = $user->createToken('tokenku')->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token
    ];

    return response($response, 201);

    
}

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken('tokenku')->delete();

        return[
            'message' => 'Logged Out'
        ];
    }

    public function updateProfile(Request $request)
    {
        $id = $user = Auth::id();
        $user = User::where('id', $id)->first();
        if($user){
            $user->nama = $request->nama ? $request->nama : $user->nama;
            $user->email = $request->email ? $request->email : $user->email;
            $user->hp = $request->hp ? $request->hp : $user->hp;
            $user->password = bcrypt($request->nama) ? bcrypt($request->nama) : $user->nama;
            $user->save();
            return response()->json([
                'status' => 200,
                'message' => "Data admin berhasil diubah", 
                'data' => $user
            ], 200);
            
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data dengan id ' . $id . ' tidak ditemukan'
            ], 404);
        }
    }

    public function deleteAccount()
    {
        $id = $user = Auth::id();
        $user = Admin::where('id', $id)->first();
        if($user){
            $user->delete();
            return response()->json([
                'status' => 200,
                'message' => "Account berhasil dihapus", 
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data dengan Id ' . $id . ' tidak ditemukan' 
            ], 404);
        }
    }
}
