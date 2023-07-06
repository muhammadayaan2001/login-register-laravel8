<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function dashboard(){
        return view('dashboards.admin');

    }

    public function userDashboard(){
        return view('dashboards.user');
    }

    public function login(){
        return view('auth.login');
    }

    public function userLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
    
        // Email ke existence ko check kare
        $user = User::where('email', $email)->first();
    
        if ($user) {
            // Password ko compare kare
            if (Hash::check($password, $user->password)) {
                // User role ke basis par redirect kare
                if ($user->role == 1) {
                    return redirect('/admin-dash');
                } elseif ($user->role == 2) {
                    return redirect('/user-dash');
                }
            }
        }
    
        // Invalid login case
        return redirect('/login')->with('error', 'Invalid credentials');
    }
    

    public function register(){
        return view('auth.register');
    }

    public function userRegister(Request $request){

        $model = new User();

        $passwordHash = Hash::make($request['password']);

        $model->name = $request->name;
        $model->email = $request->email;
        $model->password = $passwordHash;
        
        if($model->save()){
            return redirect('/user-dash')->withSuccess('Registeration Succeed');
        }
        else{
            return redirect('/register')->withSuccess('Registeration Failed');
        }
    }
}
