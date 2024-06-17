<?php 
namespace App\Http\Services;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService{
    public function create($request){
        // Validate request data
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users|max:255',
                'password' => 'required|string|min:5|max:255',
            ]);
    
            return User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);
        } catch (\Exception $e) {
            // Log lỗi để xem chi tiết lỗi là gì
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Failed to create user'], 500);
        }
    }
}