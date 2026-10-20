<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo de Ventas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 p-6">
    <div class="max-w-6xl mx-auto space-y-6">
        <h1 class="text-3xl font-bold text-slate-800">Administración de Ventas</h1>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <!-- Formulario Crear Venta -->
        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h2 class="text-xl font-semibold mb-4 text-slate-700">Nueva Venta</h2>
            <form action="{{ route('ventas.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-6 gap-4">
                @csrf
                <select name="cliente_id" required class="border p-2 rounded">
                    <option value="">Cliente...</option>
                    @foreach($clientes as $c)
                        <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                    @endforeach
                </select>

                <select name="producto_id" required class="border p-2 rounded">
                    <option value="">Producto...</option>
                    @foreach($productos as $p)
                        <option value="{{ $p->id }}">{{ $p->nombre }} (${{ $p->precio }} | Stock: {{ $p->stock }})</option>
                    @endforeach
                </select>

                <input type="number" name="cantidad" min="1" placeholder="Cant." required class="border p-2 rounded">
                <input type="date" name="fecha_venta" value="{{ date('Y-m-d') }}" required class="border p-2 rounded">
                
                <select name="estado" required class="border p-2 rounded">
                    <option value="pendiente">Pendiente</option>
                    <option value="confirmada">Confirmada</option>
                    <option value="cancelada">Cancelada</option>
                </select>

                <button type="submit" class="bg-blue-600 text-white font-semibold rounded p-2 hover:bg-blue-700">Registrar</button>
            </form>
        </div>

        <!-- Tabla Ventas -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-800 text-white">
                    <tr>
                        <th class="p-3">ID</th>
                        <th class="p-3">Cliente</th>
                        <th class="p-3">Fecha</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Estado</th>
                        <th class="p-3 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $venta)
                    <tr class="border-b hover:bg-slate-50">
                        <td class="p-3">{{ $venta->id }}</td>
                        <td class="p-3">{{ $venta->cliente->nombre }}</td>
                        <td class="p-3">{{ $venta->fecha_venta }}</td>
                        <td class="p-3">${{ number_format($venta->total, 2) }}</td>
                        <td class="p-3">
                            <form action="{{ route('ventas.update', $venta) }}" method="POST">
                                @csrf @method('PUT')
                                <select name="estado" onchange="this.form.submit()" class="border p-1 rounded text-sm">
                                    <option value="pendiente" {{ $venta->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="confirmada" {{ $venta->estado == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                                    <option value="cancelada" {{ $venta->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                </select>
                            </form>
                        </td>
                        <td class="p-3 flex justify-center">
                            @if(in_array($venta->estado, ['pendiente', 'cancelada']))
                                <form action="{{ route('ventas.destroy', $venta) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Eliminar venta?')" class="bg-red-600 text-white text-xs px-3 py-1 rounded">Eliminar</button>
                                </form>
                            @else
                                <span class="text-xs text-gray-400">No eliminable</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>