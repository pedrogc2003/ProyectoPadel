<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pista;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Método para mostrar la vista de registro
    public function index(){
        return view('Registro.index');
    }
    
    // Método para mostrar el formulario de registro de jugador
    public function formularioRegistro()
    {
        return view('Registro.RegistroJugador');
    }

    // Método para mostrar la vista de inserción de trabajador
    public function insertaTrabajador()
    {
        return view('InicioTrabajador.InsertaTrabajador');
    }

    public function create(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
            ],
        ]);

        // Si la validación falla, redirigir con errores
        if ($validator->fails()) {
            return redirect()->route('Registro.RegistroJugador')->withErrors(['error' => 'Ya existe el correo introducido'])->withInput();
        }

        // Crear el nuevo usuario
        User::create([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellido'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'rol' => $request->input('rol'),
        ]);

        // Redirigir a la página de inicio de sesión del jugador con mensaje de éxito
        return redirect()->route('Registro.IniciarJugador')->with('success', 'Usuario creado satisfactoriamente.');
    }

    // Método para mostrar el formulario de inicio de sesión
    public function formularioLogin()
    {
        return view('Registro.IniciarJugador');
    }

    // Método para la página de inicio del jugador
    public function inicioJugador()
    {
        $pistas = Pista::all();

        return view('InicioCliente.InicioJugador', compact('pistas'));
    }

    // Método para la página de inicio del trabajador
    public function inicioTrabajador()
    {
        $pistas = Pista::all();

        return view('InicioTrabajador.InicioTrabajador', compact('pistas'));
    }

    // Método para iniciar sesión
    public function iniciarSesion(Request $request)
    {
        $credenciales = $request->only('email', 'password');
        
        if (Auth::attempt($credenciales)) {
            $user = Auth::user();
    
            if ($user->rol == "Cliente") {
                return redirect()->route('InicioCliente.InicioJugador');
            } elseif ($user->rol == "Trabajador") {
                return redirect()->route('InicioTrabajador.InicioTrabajador');
            }
        }
    
        return back()->withErrors(['error' => 'Contraseña incorrecta o la cuenta no existe']);
    }
    
    // Método para crear un nuevo trabajador
    public function createTrabajador(Request $request)
    {
        // Validar el correo electrónico único
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'), // Validar que el correo electrónico sea único en la tabla 'users'
            ],
        ]);

        // Verificar si la validación falla
        if ($validator->fails()) {
            return redirect()->route('InicioTrabajador.InsertaTrabajador')->withErrors(['error' => 'El correo electrónico ya está registrado.'])->withInput();
        }

        // Crear el nuevo trabajador si la validación es exitosa
        User::create([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellido'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'rol' => $request->input('rol'),
        ]);

        // Redirigir a la página de inicio del trabajador
        return redirect()->route('InicioTrabajador.InicioTrabajador')->with('success', 'Trabajador creado satisfactoriamente.');
    }

    // Método para mostrar el formulario de edición de perfil del jugador
    public function formularioEditar(Request $request){
        return view('InicioCliente.Perfil');
    }

    // Método para actualizar la información del jugador
    public function jugadorEditado(Request $request, User $user)
    {
        $user->update([
            'nombre' => $request->input('name'),
            'apellidos' => $request->input('apellidos'),
        ]);

        return redirect()->route('InicioCliente.InicioJugador');
    }   
    
}
