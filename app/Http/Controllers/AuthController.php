<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\SignupRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{

    public function showSignupForm()
    {
        $roles = Role::all();
        return view('auth.signup', compact('roles'));
    }

    public function signup(SignupRequest $request)
    {
        $validatedData = $request->validated();

        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'age' => $validatedData['age'],
            'dob' => $validatedData['dob'],
            'address' => $validatedData['address'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => $validatedData['role_id'],
            'profile_picture' => $profilePicturePath,
        ]);

        return redirect()->route('welcome')->with('success', '¡Registro exitoso! Por favor, inicia sesión.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginFormRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
            ])->onlyInput('email');
        }


        $request->session()->put('user_id', $user->id);
        $request->session()->regenerate();

        $user->load('role');
        if ($user->role->name === 'admin') {
            return redirect()->intended('/admin/dashboard')->with('status', '¡Bienvenido Administrador!');
        } elseif ($user->role->name === 'manager') {
            return redirect()->intended('/manager/dashboard')->with('status', '¡Bienvenido MAnager!');
        }

        return redirect('/')->with('status', '¡Bienvenido!');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Has cerrado sesión correctamente.');
    }
}
