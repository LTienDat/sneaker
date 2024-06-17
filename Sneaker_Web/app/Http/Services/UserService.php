<?php 
namespace App\Http\Services;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService{
    public function create($request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:5|max:255',
        ]);

        // Create and save the user
        return User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
    }
}