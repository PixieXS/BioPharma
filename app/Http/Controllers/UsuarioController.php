<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuario.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuario.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6',
            'rol' => 'required|in:basico,root',
            'estado' => 'required|in:activo,inactivo',
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
            'estado' => $request->estado,
        ]);

        return redirect()->route('usuario.index')->with('success', 'Usuario creado exitosamente');
    }

    public function show(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuario.show', compact('usuario'));
    }

    public function edit($id)
    {
        $user = Usuario::findOrFail($id);
        return view('usuario.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = Usuario::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $user->id,
            'rol' => 'required|in:basico,root',
            'estado' => 'required|in:activo,inactivo',
        ]);

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($user->rol === 'root' && $request->estado === 'inactivo') {
            $rootActivo = Usuario::where('rol', 'root')
                ->where('estado', 'activo')
                ->where('id', '!=', $user->id)
                ->exists();

            if (!$rootActivo) {
                return back()->withErrors(['estado' => 'Debe existir al menos un usuario root activo.']);
            }
        }

        $user->update([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'rol' => $request->rol,
            'estado' => $request->estado,
        ]);

        return redirect()->route('usuario.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuarioLogueado = auth()->user();

        if ($usuario->id == $usuarioLogueado->id) {
            return back()->withErrors(['error' => 'No puedes eliminar tu propio usuario.']);
        }

        if ($usuario->rol === 'root') {
            $rootActivo = Usuario::where('rol', 'root')
                ->where('estado', 'activo')
                ->where('id', '!=', $usuario->id)
                ->exists();

            if (!$rootActivo) {
                return back()->withErrors(['error' => 'No puedes eliminar al único usuario root activo.']);
            }
        }

        $usuario->delete();
        return redirect()->route('usuario.index')->with('success', 'Usuario eliminado exitosamente');
    }

    public function confirmDelete($id)
    {
        $usuario = Usuario::findOrFail($id);
        dd($usuario); // Para depuración
        return view('usuario.delete', compact('usuario'));
    }
}
