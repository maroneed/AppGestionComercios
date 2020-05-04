<?php

namespace sisVentas\Http\Controllers\Auth;

use sisVentas\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';   // funciona con /home

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    public function showloginForm(){
        return View('auth.login');
    }

    public function login(Request $request){
        
        $this->validateLogin($request);
        
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password,'condicion'=>1])){
          return redirect()->route('almacen/articulo');
        }
        return back()
        ->withErrors(['email'=>trans('auth.failed')])
        ->withInput(request(['email']));
        
    }

    

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect(\URL::previous());       //para que no al tocar el botos 'atras' del navegador no muestre la vista anterior a deslogearse
    }

    protected function validateLogin(Request $request){
        $this->validate($request,[
            'email'=>'required|string',
            'password'=>'required|string'
        ]);
    }
}
