<?php

namespace App\Http\Controllers;


use App\Models\Note;
use App\Models\User;
use App\Services\Operations;
use Illuminate\Http\Request;
// use Illuminate\Contracts\Encryption\DecryptException;
// use Illuminate\Support\Facades\Crypt;

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
        $notes = User::find($id)
                        ->notes()
                        ->whereNull('deleted_at')
                        ->get()
                        ->toArray();

        // show home view
    
        return view('home', [
            'notes' => $notes
        ]);
    }

    public function newNote() {
        // show new note view
        return view('new_note');
    }

    public function newNoteSubmit(Request $request) {
        // validate request
        $request->validate(
            // rules
            [
                'text_title' => 'required|min:3|max:200', // Igual ao banco de dados
                'text_note' => 'required|min:3|max:3000', // Igual ao banco de dados
            ],
            // error messages
            [
                'text_title.required' => 'O título é obrigatório',
                'text_title.min' => 'O título deve ter pelo menos :min caracteres',
                'text_title.max' => 'O título deve ter pelo menos :max caracteres',

                'text_note.required' => 'A nota é obrigatória',
                'text_note.min' => 'A nota deve ter pelo menos :min caracteres',
                'text_note.max' => 'A nota deve ter no máximo :max caracteres',
            ]
        );

        // get user id
        $id = session('user.id');

        // create new note
        $note = new Note();
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        // redirect to home
        return redirect()->route('home');
    }

    public function editNote($id) {
        // $id = $this->decryptId($id);                   Quando usava a função privada
        $id = Operations::decryptId($id); //  Agora usando o Service
        // load note
        $note = Note::find($id);
        // show edit note view
        return view('edit_note', ['note' => $note]);
    }

    public function editNoteSubmit(Request $request) {
        // validate request
        $request->validate(
            // rules
            [
                'text_title' => 'required|min:3|max:200', // Igual ao banco de dados
                'text_note' => 'required|min:3|max:3000', // Igual ao banco de dados
            ],
            // error messages
            [
                'text_title.required' => 'O título é obrigatório',
                'text_title.min' => 'O título deve ter pelo menos :min caracteres',
                'text_title.max' => 'O título deve ter pelo menos :max caracteres',

                'text_note.required' => 'A nota é obrigatória',
                'text_note.min' => 'A nota deve ter pelo menos :min caracteres',
                'text_note.max' => 'A nota deve ter no máximo :max caracteres',
            ]
        );
        // check if note_id exists
        if($request->note_id == null) {
            return redirect()->to('home');
        }
        // descrypt note_id
        $id = Operations::decryptId($request->note_id);

        // load note
        $note = Note::find($id);

        // update note
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        // redirect to home
        return redirect()->route('home');
    }

    public function deleteNote($id) {
        // $id = $this->decryptId($id);
        $id = Operations::decryptId($id);
        
        // load note
        $note = Note::find($id);

        // show delete note confirmation
        return view('delete_note', ['note' => $note]);
    }

    public function deleteNoteConfirm($id){
        // check if $id is encrypted
        $id = Operations::decryptId($id);

        // load note
        $note = Note::find($id);

        // 1. hard delete
        // $note->delete();

        // 2. soft delete
        $note->deleted_at = date('Y:m:d H:i:s');
        $note->save();

        // 3. soft delete (property in model)
        $note->delete();
        
        // redirect to home
        return redirect()->route('home');
    }
    // private function decryptId($id) {
    //     // check if $id is encrypted
    //     try {
    //         $id = Crypt::decrypt($id);
    //     } catch (DecryptException $e) {
    //         return redirect()->route('home');
    //     }

    //     return $id;
    // }
}
