<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Muestra el formulario con la lista de carreras
    public function create()
    {
        $careers = Career::all();
        return view('register', compact('careers'));
    }

    // Guarda un nuevo usuario
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|min:8|confirmed',
            'career_id'      => 'required|exists:careers,id',
            'terms_accepted' => 'accepted',
        ], [
            'name.required'           => 'El nombre es obligatorio.',
            'name.max'                => 'El nombre no puede superar los 255 caracteres.',
            'email.required'          => 'El correo electrónico es obligatorio.',
            'email.email'             => 'El correo no tiene un formato válido.',
            'email.unique'            => 'Este correo ya está registrado.',
            'password.required'       => 'La contraseña es obligatoria.',
            'password.confirmed'      => 'Las contraseñas no coinciden.',
            'career_id.required'      => 'Debes seleccionar una carrera.',
            'career_id.exists'        => 'La carrera seleccionada no es válida.',
            'terms_accepted.accepted' => 'Debes aceptar los términos y condiciones.',
        ]);

        //  Guardamos el resultado para obtener el nombre del usuario creado.
        $user = User::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'password'       => Hash::make($request->password),
            'career_id'      => $request->career_id,
            'terms_accepted' => true,
        ]);

        //obtener el nombre de la carrera
        $career = Career::find($request->career_id);
        // Mandamos el nombre del estudiante en el flash para mostrarlo en el modal
        return redirect()->route('register')->with('success', $request->name
        . ' ha sido registrado a la carrera de ' . $career->name . ' correctamente.');
    }
}
