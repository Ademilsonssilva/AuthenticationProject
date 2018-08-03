<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use App\Models\Pessoa;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login (Request $request)
    {

        $this->validate($request, [
            'cpf'   => 'required',
            'login' => 'required',
            'senha' => 'required',
        ]);

        $dados = $request->all();
        $pessoa = Pessoa::where('cpf', $dados['cpf'])
            ->where('login', $dados['login'])
            ->first();


        if ($pessoa == null) {

            return redirect()->back()
                ->with('fail', 'Credenciais não encontradas para o login e CPF informados')
                ->withInput();

        }

        if (md5($dados['senha']) != $pessoa->senha) {
            
            return redirect()->back()
                ->with('fail', 'Senha incorreta para o login ' . $dados['login'])
                ->withInput();

        }

        if (!$pessoa->ativo) {
            return redirect()->back()
                ->with('fail', 'O login não está ativo')
                ->withInput();          
        }


        if ($pessoa != null) {
            
            Auth::login($pessoa);

            return redirect()->route('home');

        }

        return $this->sendFailedLoginResponse($request);

    }

    protected function attemptLogin(Request $request)
    {
        return true;
    }


}
