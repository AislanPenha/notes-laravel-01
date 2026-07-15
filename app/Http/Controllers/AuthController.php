<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function loginsubmit(Request $request){
        // $POST['text_username']
        // echo dd($request);

        // form validation
        $request->validate(
            // rules
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:16',
            ],
            // error messages
            [
                'text_username.required' => 'O username é obrigatório',
                'text_username.email' => 'Username deve ser um email válido',
                'text_password.required' => 'O password é obrigatório',
                'text_password.min' => 'O password deve ter pelo menos :min caracteres',
                'text_password.max' => 'O password deve ter no máximo :max caracteres',

            ]
        );

        // get user input
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        // test database connection
        try {
            DB::connection()->getPdo();
            echo 'Connection is OK';
        }catch(\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        

        // get all the users from the database
        // $users = User::all()->toArray();
        // echo '<pre>';
        // print_r($users);
        // echo '</pre>';

        // as an object instance of the model's class
        $userModel = new User();
        $users = $userModel->all()->toArray();
        echo '<pre>';
        print_r($users);
        echo '</pre>';
    }

    public function logout(){
        echo 'logout';
    }
}
