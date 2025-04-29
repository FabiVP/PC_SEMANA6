<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function create()
    {
        return view('statuses.create');
    }
    public function index()
    {
        $statuses = Status::with('user')->latest()->get();
        return view('statuses.index', compact('statuses'));
    }
    // Método para almacenar un nuevo estado
    public function store(Request $request)
    {
        // Validar el campo 'body' del formulario
        $validated = $request->validate([
            'body' => 'required|min:10', // El cuerpo del estado debe tener al menos 10 caracteres
        ]);

        // Crear el nuevo estado en la base de datos
        $status = Status::create([
            'user_id' => Auth::id(),  // Asegurarse de que el usuario esté autenticado
            'body' => $request->input('body'), // El contenido del estado
        ]);

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->route('statuses.index')->with('success', 'Estado creado exitosamente!');
    }
}

