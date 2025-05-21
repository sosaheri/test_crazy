<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Estudiante</title>
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
        .detail-item {
            margin-bottom: 1rem;
        }
        .detail-item strong {
            display: block;
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 0.25rem;
        }
        .detail-item span {
            color: #374151;
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
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Detalles del Estudiante</h2>

        <div class="detail-item">
            <strong>ID:</strong>
            <span>{{ $student->id }}</span>
        </div>
        <div class="detail-item">
            <strong>Nombre:</strong>
            <span>{{ $student->first_name }}</span>
        </div>
        <div class="detail-item">
            <strong>Apellido:</strong>
            <span>{{ $student->last_name ?? 'N/A' }}</span>
        </div>
        <div class="detail-item">
            <strong>Dirección:</strong>
            <span>{{ $student->address ?? 'N/A' }}</span>
        </div>
        <div class="detail-item">
            <strong>Creado en:</strong>
            <span>{{ $student->created_at->format('d/m/Y H:i') }}</span>
        </div>
        <div class="detail-item">
            <strong>Última Actualización:</strong>
            <span>{{ $student->updated_at->format('d/m/Y H:i') }}</span>
        </div>

        <div class="text-center">
            <a href="{{ route('students.index') }}" class="btn-secondary">Volver a la Lista</a>
        </div>
    </div>
</body>
</html>

