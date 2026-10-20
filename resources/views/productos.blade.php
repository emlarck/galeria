<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans p-6">
    <div class="max-w-6xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Módulo de Productos</h1>
            <a href="/" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">Volver al Inicio</a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulario para agregar producto -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Agregar Nuevo Producto</h2>
            <form action="{{ route('productos.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                    <input type="text" name="nombre" required class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Precio ($)</label>
                    <input type="number" step="0.01" name="precio" required class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                    <input type="number" name="stock" required class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 font-semibold transition">
                        Guardar Producto
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabla de productos -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 text-sm">
                        <th class="p-4">ID</th>
                        <th class="p-4">Nombre</th>
                        <th class="p-4">Precio</th>
                        <th class="p-4">Stock</th>
                        <th class="p-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @forelse($productos as $producto)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 font-bold text-gray-600">#{{ $producto->id }}</td>
                            <td class="p-4">{{ $producto->nombre }}</td>
                            <td class="p-4">${{ number_format($producto->precio, 2) }}</td>
                            <td class="p-4">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $producto->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $producto->stock }} unidades
                                </span>
                            </td>
                            <td class="p-4 text-center flex justify-center space-x-3">
                                <!-- Botón Abrir Modal Editar -->
                                <button onclick="document.getElementById('edit-modal-{{ $producto->id }}').classList.remove('hidden')" class="text-amber-600 hover:text-amber-800 font-medium">
                                    Editar
                                </button>

                                <!-- Formulario Eliminar -->
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Eliminar</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal de Edición -->
                        <div id="edit-modal-{{ $producto->id }}" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
                            <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md">
                                <h3 class="text-xl font-bold mb-4 text-gray-800">Editar Producto #{{ $producto->id }}</h3>
                                <form action="{{ route('productos.update', $producto->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                                        <input type="text" name="nombre" value="{{ $producto->nombre }}" required class="w-full border border-gray-300 p-2 rounded-lg">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Precio ($)</label>
                                        <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}" required class="w-full border border-gray-300 p-2 rounded-lg">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                                        <input type="number" name="stock" value="{{ $producto->stock }}" required class="w-full border border-gray-300 p-2 rounded-lg">
                                    </div>
                                    <div class="flex justify-end space-x-2">
                                        <button type="button" onclick="document.getElementById('edit-modal-{{ $producto->id }}').classList.add('hidden')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                                            Cancelar
                                        </button>
                                        <button type="submit" class="px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 font-semibold">
                                            Actualizar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">No hay productos registrados aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>