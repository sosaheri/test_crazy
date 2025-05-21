<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Gerente</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 40rem;
            text-align: center;
        }
        .alert {
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .btn-logout {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #dc2626;
            color: #ffffff;
            font-weight: 600;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.2s ease-in-out;
            margin-top: 1.5rem;
        }
        .btn-logout:hover {
            background-color: #b91c1c;
        }
        .nav-link {
            display: inline-block;
            padding: 0.5rem 1rem;
            margin: 0.5rem;
            background-color: #3b82f6;
            color: #ffffff;
            border-radius: 0.5rem;
            text-decoration: none;
            transition: background-color 0.2s ease-in-out;
        }
        .nav-link:hover {
            background-color: #2563eb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Dashboard de Manager</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="mb-6 flex items-center justify-center gap-4">
            {{-- Condición para mostrar la imagen de perfil si existe --}}
            @if ($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" 
                     alt="Foto de Perfil de {{ $user->name }}" 
                     class="h-24 w-24 rounded-full object-cover shadow-lg">
            @else
                {{-- Imagen de perfil por defecto si no hay una cargada --}}
                <img src="{{ asset('images/default_profile.png') }}" 
                     alt="Foto de Perfil por defecto" 
                     class="h-24 w-24 rounded-full object-cover border border-gray-300">
            @endif
        
            <div>
                <h2 class="text-3xl font-bold text-gray-800">¡Bienvenido, {{ $user->name }}!</h2>
            </div>
        </div>

        <div class="flex justify-center gap-4 mb-6">
            <a href="{{ route('students.index') }}" class="nav-link">Ver Estudiantes</a>
            </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">Cerrar Sesión</button>
        </form>
    </div>
</body>
</html>

