<?php

use Illuminate\Support\Facades\Route;
use resources\views\Registro\RegistroJugador;
use resources\views\Registro\IniciarJugador;
use resources\views\Registro\IniciarTrabajador;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PistasController;
use App\Http\Controllers\ReservasController;


Route::get('/',[UserController::class,'index'])->name('Registro.index');

Route::get('/registroJugador',[UserController::class,'formularioRegistro'])->name('Registro.RegistroJugador');
Route::post('/registroJugador', [UserController::class, 'create'])->name('Registro.create');

Route::get('/iniciarJugador', [UserController::class,'formularioLogin'])->name('Registro.IniciarJugador');
Route::post('/iniciarSesion', [UserController::class,'iniciarSesion'])->name('Registro.Iniciar');

Route::get('/inicioJugador', [UserController::class,'inicioJugador'])->name('InicioCliente.InicioJugador')->middleware('auth');

Route::get('/datosJugador',[UserController::class,'formularioEditar'])->name('perfil.edit')->middleware('auth');
Route::put('/perfil/update/{user}', [UserController::class, 'jugadorEditado'])->name('perfil.update');



Route::get('/anadirReserva', [ReservasController::class,'insertaReserva'])->name('InicioCliente.AnadirRerserva')->middleware('auth');
Route::post('/instarReserva', [ReservasController::class,'guardarReserva'])->name('InicioCliente.InsertaRerserva')->middleware('auth');

Route::get('/anadirReservaTrabajador', [ReservasController::class,'insertaReservaTrabajador'])->name('InicioTrabajador.AnadirReservaTrabajador')->middleware('auth');
Route::post('/instarReservaTrabajador', [ReservasController::class,'guardarReservaTrabajador'])->name('InicioTrabajador.InsertaRerservaTrabajador')->middleware('auth');


Route::get('/verReservas', [ReservasController::class,'verReserva'])->name('InicioCliente.VerRerservas')->middleware('auth');
Route::delete('/reservas/{reserva}/delete', [ReservasController::class, 'destroy'])->name('reservas.destroy');
Route::get('/reservas/{reserva}/edit', [ReservasController::class, 'edit'])->name('reservas.edit');
Route::put('/reservas/{reserva}/update', [ReservasController::class, 'update'])->name('reservas.update');

Route::get('/inicioTrabajador',[UserController::class,'inicioTrabajador'])->name('InicioTrabajador.InicioTrabajador')->middleware('auth');

Route::get('/anadirPista', [PistasController::class,'anadirPista'])->name('InicioTrabajador.AnadirPista')->middleware('auth');
Route::post('/insertarPista', [PistasController::class,'createPista'])->name('InicioTrabajador.createPista')->middleware('auth');

Route::get('/verVistas', [PistasController::class,'verVistas'])->name('InicioTrabajador.VerPistas')->middleware('auth');

Route::get('/insertaTrabajador', [UserController::class, 'insertaTrabajador'])->name('InicioTrabajador.InsertaTrabajador')->middleware('auth');
Route::post('/insertarTrabajador', [UserController::class, 'createTrabajador'])->name('InicioTrabajador.create')->middleware('auth');


Route::get('/pista/reparar/{pista}', [PistasController::class, 'mostrarFormularioReparacion'])->name('pista.mostrarFormularioReparacion');
Route::post('/pista/reparar/{pista}', [PistasController::class, 'repararPista'])->name('pista.reparar');