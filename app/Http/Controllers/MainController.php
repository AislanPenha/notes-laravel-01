<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    // function login($value) {
    //     echo 'oi';

    //     //return view('main')->with('nome', 'Aislan');
    //     // return view('main')->with('idade', '55');
    //     // return view('main')->with('sexo', 'Masculino');
    // }

    // function page2($value) {
    //     return view('page2', ['valor' => $value]);
    // }

    public function index() {
        // load user's notes
        $id = session('user.id');
        
        // $user = User::find($id)->toArray();
        $notes = User::find($id)->notes()->get()->toArray();

        // show home view
    
        return view('home', [
            'notes' => $notes
        ]);
    }

    public function newNote() {
        return 'NEW NOTE';
    }

    public function editNote($id) {
        $id = $this->decryptId($id);
        
        echo 'EDITAR ' . $id;
    }

    public function deleteNote($id) {
        $id = $this->decryptId($id);

        echo 'DELETAR ' . $id;
    }

    private function decryptId($id) {
        // check if $id is encrypted
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->route('home');
        }

        return $id;
    }
}
