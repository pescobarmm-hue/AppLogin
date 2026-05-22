<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\User; // ¡Importante! Faltaba importar el modelo User
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(){
        $careers = Career::all();
        return view('register', compact('careers'));
    }

    public function store(Request $request){
        // 1. Corregido 'validate' y las reglas de la base de datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Corregido: separado por coma
            'password' => 'required|min:8|confirmed',
            'career_id' => 'required|exists:careers,id', // Corregido: apunta a la tabla careers, columna id
            'terms_accepted' => 'accepted',
        ]);

        // 2. Corregido: Todo este bloque ahora está DENTRO de la función store
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'career_id' => $request->career_id,
        ]);

        return redirect()->route('register')->with('success', 'Usuario registrado exitosamente.');
    } // Llave de cierre del método store en su lugar correcto
}
