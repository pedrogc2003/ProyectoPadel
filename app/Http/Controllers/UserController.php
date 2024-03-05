<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pista;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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

    // Método para crear un nuevo usuario (jugador o trabajador)
    public function create(Request $request)
    {
        User::create([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellido'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'rol' => $request->input('rol'),
        ]);
        
        return redirect()->route('Registro.IniciarJugador');
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
    
        return back()->withErrors(['email' => 'Credenciales incorrectas']);
    }
    
    // Método para crear un nuevo trabajador
    public function createTrabajador(Request $request)
    {
        User::create([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellido'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'rol' => $request->input('rol'),
        ]);
        
        return redirect()->route('InicioTrabajador.InicioTrabajador');
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
