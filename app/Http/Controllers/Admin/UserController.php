<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function create(){

        return view ('admin.users.create');
    }

    
    public function store(Request $request){

        $request -> validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'nullable|string|max:20',
            'role'     => 'required|in:admin,customer,staff',
            'status'   => 'required|boolean',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name'      => $request ->name,
            'email'     => $request ->email,
            'phone'    => $request->phone,
            'role'     => $request->role,
            'status'   => $request->status,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')
                        ->with('success', 'User created successfully!');
    }


    public function edit(User $user){
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user){
        
        $request -> validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,'.$user->id,
            'phone'    => 'nullable|string|max:20',
            'role'     => 'required|in:admin,customer,staff',
            'status'   => 'required|boolean',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data = [
            'name'   => $request->name,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'role'   => $request->role,
            'status' => $request->status,
        ];

        if($request->filled('password')){
            $data['password']=Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
                        ->with('success', 'User updated successfully!');

    }


    public function destroy(User $user){
        if($user->id === auth()->id()){
            return redirect()->route('admin.users.index')
                        ->with('error', ' You cannot delete yourself!');
        }

        $user->delete();

         return redirect()->route('admin.users.index')
                        ->with('success', 'User deleted successfully!');
    }












}
