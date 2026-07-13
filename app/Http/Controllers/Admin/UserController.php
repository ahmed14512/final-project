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

        $roles = \App\Models\Role::all();
        return view('admin.users.create', compact('roles'));
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
            'status'   => $request->status,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::where('name', $request->role)->first();
        $user->roles()->attach($role->id);

        return redirect()->route('admin.users.index')
                        ->with('success', 'User created successfully!');
    }


    public function edit(User $user){
        $roles = \App\Models\Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user){

    if ($user->isSuperAdmin() &&
        !auth()->user()->isSuperAdmin()) {
        return redirect()->route('admin.users.index')
                         ->with('error',
                           'You cannot edit a Super Administrator.');
    }
        
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
            'status' => $request->status,
        ];

        if($request->filled('password')){
            $data['password']=Hash::make($request->password);
        }

        $user->update($data);

            $role = Role::where('name', $request->role)->first();
            $user->roles()->sync([$role->id]);

        return redirect()->route('admin.users.index')
                        ->with('success', 'User updated successfully!');

    }


    public function destroy(User $user){
        if($user->id === auth()->id()){
            return redirect()->route('admin.users.index')
                        ->with('error', ' You cannot delete yourself!');
        }

         if ($user->isSuperAdmin() &&
        !auth()->user()->isSuperAdmin()) {
        return redirect()->route('admin.users.index')
                         ->with('error',
                           'You cannot delete a Super Administrator.');
    }

        $user->delete();

         return redirect()->route('admin.users.index')
                        ->with('success', 'User deleted successfully!');
    }
}
