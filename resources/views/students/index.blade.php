<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Estudiantes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            padding: 2rem;
        }
        .container {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            max-width: 80rem;
            margin: 0 auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .btn-primary {
            padding: 0.75rem 1.5rem;
            background-color: #3b82f6;
            color: #ffffff;
            font-weight: 600;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            text-decoration: none;
            transition: background-color 0.2s ease-in-out;
        }
        .btn-primary:hover {
            background-color: #2563eb;
        }
        .table-container {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
        }
        th, td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        th {
            background-color: #f9fafb;
            font-weight: 600;
            color: #4b5563;
            text-transform: uppercase;
            font-size: 0.875rem;
        }
        tr:hover {
            background-color: #f3f4f6;
        }
        .action-buttons a, .action-buttons button {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            text-decoration: none;
            margin-right: 0.5rem;
            transition: background-color 0.2s ease-in-out;
        }
        .action-buttons .view-btn {
            background-color: #10b981; /* green-500 */
            color: #ffffff;
        }
        .action-buttons .view-btn:hover {
            background-color: #059669; /* green-600 */
        }
        .action-buttons .edit-btn {
            background-color: #f59e0b; /* amber-500 */
            color: #ffffff;
        }
        .action-buttons .edit-btn:hover {
            background-color: #d97706; /* amber-600 */
        }
        .action-buttons .delete-btn {
            background-color: #ef4444; /* red-500 */
            color: #ffffff;
            border: none;
            cursor: pointer;
        }
        .action-buttons .delete-btn:hover {
            background-color: #dc2626; /* red-600 */
        }
        .pagination-links {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }
        .pagination-links nav div {
            display: flex;
            gap: 0.5rem;
        }
        .pagination-links nav span,
        .pagination-links nav a {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s ease-in-out;
        }
        .pagination-links nav a {
            background-color: #e5e7eb;
            color: #4b5563;
        }
        .pagination-links nav a:hover {
            background-color: #d1d5db;
        }
        .pagination-links nav span.relative {
            background-color: #3b82f6;
            color: #ffffff;
            cursor: default;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header flex justify-between items-center mb-8"> {{-- Utiliza las clases de Tailwind para el header --}}
            <h1 class="text-3xl font-bold text-gray-800">Estudiantes</h1>
        
            <div class="flex items-center gap-4"> {{-- Este div agrupa los dos botones y les da espacio --}}
                {{-- Enlace para regresar al Home (dashboard) --}}
                @if ($loggedInUser && $loggedInUser->role) {{-- Asegurarse de que el usuario y su rol existen --}}
                    @if ($loggedInUser->role->name === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                           class="rounded-lg bg-purple-600 px-4 py-2 font-semibold text-white transition duration-300 ease-in-out hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
                           Regresar al Dashboard de Admin
                        </a>
                    @elseif ($loggedInUser->role->name === 'manager')
                        <a href="{{ route('manager.dashboard') }}"
                           class="rounded-lg bg-orange-600 px-4 py-2 font-semibold text-white transition duration-300 ease-in-out hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50">
                           Regresar al Dashboard de Manager
                        </a>
                    @else
                        {{-- Opcional: si hay otros roles o usuarios sin rol específico --}}
                        <a href="{{ url('/') }}"
                           class="rounded-lg bg-gray-600 px-4 py-2 font-semibold text-white transition duration-300 ease-in-out hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                           Regresar al Inicio
                        </a>
                    @endif
                @else
                    {{-- Si no hay usuario logueado o el rol no está definido, podrías no mostrar nada o un enlace genérico --}}
                    <a href="{{ url('/') }}"
                       class="rounded-lg bg-gray-600 px-4 py-2 font-semibold text-white transition duration-300 ease-in-out hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
                       Regresar al Inicio
                    </a>
                @endif
        
                {{-- Botón "Añadir Nuevo Estudiante" --}}
                <a href="{{ route('students.create') }}"
                   class="rounded-lg bg-blue-500 px-4 py-2 font-semibold text-white transition duration-300 ease-in-out hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                   Añadir Nuevo Estudiante
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->first_name }}</td>
                            <td>{{ $student->last_name ?? 'N/A' }}</td>
                            <td>{{ $student->address ?? 'N/A' }}</td>
                            <td class="action-buttons">
                                <a href="{{ route('students.show', $student->id) }}" class="view-btn">Ver</a>
                                <a href="{{ route('students.edit', $student->id) }}" class="edit-btn">Editar</a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn" onclick="return confirm('¿Estás seguro de que quieres eliminar este estudiante?');">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">No hay estudiantes registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex justify-center">
            {{ $students->links() }}
        </div>
    </div>
</body>
</html>

