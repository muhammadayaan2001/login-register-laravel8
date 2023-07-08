<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function dashboard(){
        $data = array();
        if(Session::has('adminId')){
            $data = User::where('id', '=', Session::get('adminId'))->first();
        }
        return view('dashboards.admin', compact('data'));
    }

    public function userDashboard(){
        $data = array();
        if(Session::has('userId')){
            $data = User::where('id', '=', Session::get('userId'))->first();
        }
        return view('dashboards.user', compact('data'));
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

        $user = User::where('email', $email)->first();
    
        if ($user) {
            if (Hash::check($password, $user->password)) {
                if ($user->role == 1) {
                    $request->session()->put('adminId', $user->id);
                    return redirect('/admin-dash');
                } elseif ($user->role == 2) {
                    $request->session()->put('userId', $user->id);
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
        if(Session::has('adminId')){
            Session::pull('adminId');
            return redirect('login');
        }
        elseif(Session::has('userId')){
            Session::pull('userId');
            return redirect('login');
        }
    }
}
