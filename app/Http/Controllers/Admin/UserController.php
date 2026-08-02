<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(){
        
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function create(){

        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    
    public function store(Request $request){

        $request -> validate([
            'name'     => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z\s]+$/'  
            ],

           'email'    => [
                'required',
                'email:rfc',     
                'unique:users,email',
                'max:255',
                'regex:/^.+@(gmail\.com|smartpickz\.com)$/'
            ],

            'phone'    => [
                'nullable',
                'digits:10'   
            ],

            'role'     => [
                'required',
                'exists:roles,name'
            ],

             'status'   => [
                'required',
                'boolean'
            ],
            
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-zA-Z])(?=.*[0-9]).+$/',
            ],
],
            [   
                'name.regex' => 'Name must contain letters only',
                'email.regex' => 'Enter a valid Email',
                'phone.digits' => 'Phone number must contain 10 digits',
                'password.required'     => 'New password is required.',
                'password.min'          => 'New password must be at least 8 characters.',
                'password.regex'        => 'Password must contain at least one letter and one number e.g. Admin123',


        ]);

        $user= User::create([
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
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user){

    if ($user->isSuperAdmin() && !auth()->user()->isSuperAdmin()) {
            return redirect()->route('admin.users.index')
                             ->with('error',
                               'You cannot edit a Super Administrator.');
        
    }
        
        $request -> validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,'.$user->id,
            'phone'    => 'nullable|string|max:20',
            'role'     => 'required|exists:roles,name',
            'status'   => 'required|boolean',
            'password' => 'nullable|string|min:8|confirmed',
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
