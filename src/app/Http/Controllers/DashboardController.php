<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Auth;
use Exception;

class DashboardController extends Controller
{
    private $repository;
    private $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {        
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function index(){

        if(Auth::check()){
            return view('user.dashboard');
        }
        
        return redirect()->route('user.login.page');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('user.login.page');
    }

    public function auth(Request $request){ 

        if(!filter_var($request['username'], FILTER_VALIDATE_EMAIL)){
            return redirect()->back()->withInput()->withErrors(['O e-mail digitado não é válido!']);
        }

        $data = [
            'email'     => $request['username'],
            'password'  => $request['password']
        ];
                
        try
        {   
            if(Auth::attempt($data, false)){
                return redirect()->route('user.dashboard');
            }
            
            return redirect()->back()->withInput()->withErrors(['Usuário ou senha incorreta!']);
            
        }
        catch(Exception $ex)
        {
            return $ex->getMessage();
        }

    }
}
