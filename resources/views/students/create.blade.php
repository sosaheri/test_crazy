<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Nuevo Estudiante</title>
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
            max-width: 32rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #4b5563;
        }
        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 1rem;
            color: #374151;
            transition: border-color 0.2s ease-in-out;
        }
        .form-group input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .btn-primary {
            width: 100%;
            padding: 0.75rem;
            background-color: #3b82f6;
            color: #ffffff;
            font-weight: 600;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.2s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #2563eb;
        }
        .btn-secondary {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background-color: #6b7280;
            color: #ffffff;
            font-weight: 600;
            border-radius: 0.5rem;
            text-decoration: none;
            transition: background-color 0.2s ease-in-out;
            margin-top: 1rem;
        }
        .btn-secondary:hover {
            background-color: #4b5563;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Añadir Nuevo Estudiante</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md relative mb-4" role="alert">
                <strong class="font-bold">¡Ups!</strong>
                <span class="block sm:inline">Hubo algunos problemas con tu entrada.</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="first_name">Nombre:</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                @error('first_name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="last_name">Apellido:</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}">
                @error('last_name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="address">Dirección:</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}">
                @error('address')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="btn-primary">Guardar Estudiante</button>
        </form>
        <div class="text-center">
            <a href="{{ route('students.index') }}" class="btn-secondary">Volver a la Lista</a>
        </div>
    </div>
</body>
</html>

