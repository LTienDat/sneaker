<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

<<<<<<< HEAD
class UserService
{
    public function create(array $data)
    {
        // Validate the data
        $this->validate($data);

        // Hash the password
        $data['password'] = Hash::make($data['password']);

        // Create and save the user
        return User::create($data);
    }

    private function validate(array $data)
    {
        validator($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:5|max:255',
        ])->validate();
=======
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
>>>>>>> 899e94295808cd1684998bbb2c1f0b0e841b7f75
    }
    public function getAll(){
        return User::orderByDesc('id')->paginate(15);
    }

    public function update($id ,$request){
        try{
            $user = User::findOrFail($id);
            $user -> fill($request->input());
            $user -> save();
            Session::flash('success','Cập nhật thành công');
        }catch(\Exception $e){
            Session::flash('error','Cập nhật thất bại');
            \Log::info($e->getMessage());
            return false;
        }
        return true;    
    }

    public function getShow($id){
        return User::find($id);;
    }
    public function delete($request){
        $product = USER::where('id', $request->input('id'))->first();
        if($product){
            $product->delete();
            return true;
        }
        return false;

    }

}
