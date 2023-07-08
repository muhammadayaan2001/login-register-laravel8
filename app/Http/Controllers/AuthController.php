<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
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

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12',
        ]);

        $email = $request->email;
        $password = $request->password;
    
        // Email ke existence ko check kare
        $user = User::where('email', $email)->first();
    
        if ($user) {
            // Password ko compare kare
            if (Hash::check($password, $user->password)) {
                if ($user->role == 1) {
                    $request->session()->put('loginId', $user->id);
                    return redirect('/admin-dash');
                } elseif ($user->role == 2) {
                    $request->session()->put('loginId', $user->id);
                    return redirect('/user-dash');
                }
            }
            else{
              return back()->with('fail', 'Invalid Password');
            }
        }else{
            return back()->with('fail', 'the email is not registered');
        }
    
        // Invalid login case
        return redirect('/login')->with('error', 'Invalid credentials');
    }
    

    public function register(){
        return view('auth.register');
    }

    public function userRegister(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique',
            'password' => 'required|min:5|max:12',
        ]);

        $model = new User();

        $passwordHash = Hash::make($request['password']);

        $model->name = $request->name;
        $model->email = $request->email;
        $model->password = $passwordHash;
        
        if($model->save()){
            return back()->with('sucess', 'Registeration Succeed');
        }
        else{
            return back()->with('fail', 'Registeration Failed');
        }
    }

    public function logout(){
        if(Session::has('loginId')){
            Session::pull('loginId');
            return redirect('login');
        }
    }
}
