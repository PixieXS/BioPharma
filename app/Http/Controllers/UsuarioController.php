<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        $usuario = auth()->user();
        return view('usuario.index', compact('usuarios', 'usuario'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuario.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    
     public function edit($id)
     {
         $user = Usuario::findOrFail($id);  // Cambié '$usuario' por '$user'
         return view('usuario.edit', compact('user'));  // Aquí también cambiamos el nombre
     }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Usuario::findOrFail($id); 
    
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $user->id,
            'rol' => 'required|in:basico,root',
            'estado' => 'required|in:activo,inactivo',
        ]);
    
        // Solo cambiar contraseña si se llenó el campo
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
    
       $user->nombre = $request->nombre;
       $user->email = $request->email;
       $user->rol = $request->rol;
       $user->estado = $request->estado;
       $user->save();
    
        return redirect()->route('usuario.index')->with('success', 'Usuario actualizado correctamente');
    }
    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $request->validate([
            'password' => 'required',
        ]);
    
        $usuario = Usuario::findOrFail($id);
        $usuarioLogueado = Auth::user();
    
        // Validar la contraseña del usuario logueado
        if (!Hash::check($request->password, $usuarioLogueado->password)) {
            return back()->withErrors(['password' => 'La contraseña ingresada no es correcta.'])->withInput();
        }
    
        if ($usuario->id == auth()->id()) {
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
    
    
    /**
     * Mostrar la confirmación para eliminar un usuario.
     */
    public function confirmDelete($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuario.delete', compact('usuario'));
    }
}
