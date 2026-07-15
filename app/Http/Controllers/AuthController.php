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

        // test database connection
        // try {
        //     DB::connection()->getPdo();
        //     echo 'Connection is OK';
        // }catch(\PDOException $e) {
        //     echo "Connection failed: " . $e->getMessage();
        // }
        

        // get all the users from the database
        // $users = User::all()->toArray();
        // echo '<pre>';
        // print_r($users);
        // echo '</pre>';

        // as an object instance of the model's class
        // $userModel = new User();
        // $users = $userModel->all()->toArray();
        // echo '<pre>';
        // print_r($users);
        // echo '</pre>';

        // get user input
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        // static methods
        $user = User::where('username', $username)
                    ->where('deleted_at', NULL)
                    ->first();
        
        if(!$user) {
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('loginError', 'Username ou password incorretos.');
        }

        // check if password is correct
        if(!password_verify($password, $user->password)) {
            return redirect()
                    ->back()
                    ->withInput()
                    ->with('loginError', 'Username ou password incorretos.');
        }

        // update last login
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();


        // login user
        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
            ]
        ]);

        // echo 'LOGIN com SUCESSO';
        // echo '<pre>';
        // print_r($user);
        // echo '</pre>';

        // redirect to home
        return redirect()->to('/');
    }

    public function logout(){
        // logout from the application
        session()->forget('user');
        return redirect()->to('/login');
    }
}
