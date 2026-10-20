<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo de Clientes</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 p-6">
    <div class="max-w-6xl mx-auto space-y-6">
        <h1 class="text-3xl font-bold text-slate-800">Administración de Clientes</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario Crear -->
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h2 class="text-xl font-semibold mb-4 text-slate-700">Registrar Cliente</h2>
            <form action="{{ route('clientes.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                @csrf
                <input type="text" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}" class="border p-2 rounded">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="border p-2 rounded">
                <input type="text" name="direccion" placeholder="Dirección" value="{{ old('direccion') }}" class="border p-2 rounded">
                <input type="text" name="telefono" placeholder="Teléfono" value="{{ old('telefono') }}" class="border p-2 rounded">
                <button type="submit" class="bg-blue-600 text-white font-semibold rounded p-2 hover:bg-blue-700">Guardar</button>
            </form>
        </div>

        <!-- Tabla Clientes -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-800 text-white">
                    <tr>
                        <th class="p-3">Nombre</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Dirección</th>
                        <th class="p-3">Teléfono</th>
                        <th class="p-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                    <tr class="border-b hover:bg-slate-50">
                        <td class="p-3">{{ $cliente->nombre }}</td>
                        <td class="p-3">{{ $cliente->email }}</td>
                        <td class="p-3">{{ $cliente->direccion }}</td>
                        <td class="p-3">{{ $cliente->telefono }}</td>
                        <td class="p-3 flex justify-center gap-2">
                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Eliminar cliente?')" class="bg-red-600 text-white text-xs px-3 py-1 rounded">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>