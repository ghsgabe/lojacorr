<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'required' => 'O campo :attribute é obrigatporio.',
            'password.min'    => 'O campo senha precisa ter pelo menos 8 caracteres.',
            'cep.min'    => 'O campo cep precisa ter pelo menos 8 caracteres.',
            'between' => 'O campo :attribute precisa ter entre :min e :max caracteres.',
            'email.required' => 'Necessário um e-mail válido!',
            'unique' => 'O :attribute já existe',
            'confirmed' => 'A senha e a confirmação estão diferentes'
        ];
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'cep' => ['nullable', 'string', 'min:8', 'max:9'],
            'street' => ['nullable', 'string', 'min:8', 'max:255'],
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'cep' => $data['cep'],
            'street' => $data['street'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
