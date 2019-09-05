<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware('auth');
        $this->user = new User();
    }
    
    public function index()
    {
        $users = $this->user->all();
        return UserResource::collection($users);  
    }
    public function update(Request $request, $id)
    {
        $mensagem = [
            'required' => 'O campo :attribute é obrigatporio.',
            'cep.min'    => 'O campo cep precisa ter pelo menos 8 caracteres.',
            'between' => 'O campo :attribute precisa ter entre :min e :max caracteres.',
            'email.required' => 'Necessário um e-mail válido!',
            'unique' => 'O :attribute já existe',
        ];
        $this->validate($request, [            
            'name' => ['required', 'string', 'max:255'],
            'cep' => ['nullable', 'string', 'min:8', 'max:9'],
            'street' => ['nullable', 'string', 'min:8', 'max:255'], 
        ], $mensagem);
        $user = User::find($id);
        $user->name = $request->name;
        $user->cep = $request->cep;
        $user->street = $request->street;
        $user->save();
        return $request;
    }
    public function updatePass(Request $request, $id)
    {  
        $mensagem = [
            'required' => 'O campo :attribute é obrigatporio.',
            'password.min'    => 'O campo senha precisa ter pelo menos 8 caracteres.',
            'confirmed' => 'A senha e a confirmação estão diferentes'
        ];
        $this->validate($request, [            
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], $mensagem);
        $user = User::find($id);
                   
        if($request->password == $request->password_confirmation){
            $user->password = Hash::make($request->password);
            $user->save();
        }

        $user->save();
        return $request;
    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return '';
    }
}
