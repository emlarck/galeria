<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 font-sans text-gray-800 flex flex-col min-h-screen">

    <nav class="bg-slate-900 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex-shrink-0 font-bold text-xl tracking-wide">
                    Galería
                </div>

                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-6 text-sm font-medium">
                        <a href="#" class="hover:text-gray-300 transition duration-150">Inicio</a>
                        <a href="#" class="font-semibold text-white border-b-2 border-white pb-1">Galería</a>
                        <a href="#" class="hover:text-gray-300 transition duration-150">Nosotros</a>
                        <a href="#" class="hover:text-gray-300 transition duration-150">Contacto</a>
                    </div>
                </div>

                <div class="-mr-2 flex md:hidden">
                    <button type="button" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-slate-800 focus:outline-none">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="hidden md:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 text-sm">
                <a href="#" class="block px-3 py-2 rounded-md hover:bg-slate-800">Inicio</a>
                <a href="#" class="block px-3 py-2 rounded-md bg-slate-800 text-white font-semibold">Galería</a>
                <a href="#" class="block px-3 py-2 rounded-md hover:bg-slate-800">Nosotros</a>
                <a href="#" class="block px-3 py-2 rounded-md hover:bg-slate-800">Contacto</a>
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-10">
        
        <h1 class="text-3xl sm:text-4xl font-extrabold text-center text-slate-900 mb-10">
            Nuestra Galería
        </h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden flex flex-col">
                <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80" alt="Paisaje Natural">
                <div class="p-5 flex-grow">
                    <h3 class="font-bold text-lg text-slate-900">Paisaje Natural</h3>
                    <p class="text-gray-500 text-sm mt-2">Una hermosa vista de la naturaleza.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden flex flex-col">
                <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?auto=format&fit=crop&w=600&q=80" alt="Montañas">
                <div class="p-5 flex-grow">
                    <h3 class="font-bold text-lg text-slate-900">Montañas</h3>
                    <p class="text-gray-500 text-sm mt-2">Paisajes increíbles rodeados de montañas.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden flex flex-col">
                <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1448375240586-882707db888b?auto=format&fit=crop&w=600&q=80" alt="Bosque">
                <div class="p-5 flex-grow">
                    <h3 class="font-bold text-lg text-slate-900">Bosque</h3>
                    <p class="text-gray-500 text-sm mt-2">Un tranquilo bosque rodeado de naturaleza.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden flex flex-col">
                <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=600&q=80" alt="Playa">
                <div class="p-5 flex-grow">
                    <h3 class="font-bold text-lg text-slate-900">Playa</h3>
                    <p class="text-gray-500 text-sm mt-2">Un lugar perfecto para descansar.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden flex flex-col">
                <img class="h-48 w-full object-cover" src="https://thumbs.dreamstime.com/b/modern-futuristic-empty-urban-landscape-embraces-sustainability-eco-friendly-city-roads-green-spaces-rooftop-gardens-286885326.jpg?w=768" alt="Ciudad">
                <div class="p-5 flex-grow">
                    <h3 class="font-bold text-lg text-slate-900">Ciudad</h3>
                    <p class="text-gray-500 text-sm mt-2">Arquitectura moderna en una gran ciudad.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden flex flex-col">
                <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=600&q=80" alt="Aventura">
                <div class="p-5 flex-grow">
                    <h3 class="font-bold text-lg text-slate-900">Aventura</h3>
                    <p class="text-gray-500 text-sm mt-2">Explora nuevos lugares y vive nuevas experiencias.</p>
                </div>
            </div>

        </div>
    </main>

</body>
</html>