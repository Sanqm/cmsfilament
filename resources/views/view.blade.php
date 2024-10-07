<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome Blade</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Menú de Navegación</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-gray-100">
        <header class="w-full container mx-auto">
            <div class="flex flex-col items-center py-12">
                <a href="#" class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl">Mini Blog </a>

            </div>
        </header>
        <!-- Navbar -->
        <nav class="bg-blue-600 p-4">
            <div class="container mx-auto flex justify-between items-center">
                <!-- Logo -->
                <a href="#" class="text-white text-2xl font-bold">MiLogo</a>

                <!-- Botón Hamburguesa para pantallas pequeñas -->
                <button class="md:hidden text-white focus:outline-none" id="menuButton">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>

                <!-- Enlaces del Menú -->
                <div class="hidden md:flex space-x-4" id="menuLinks">
                    <a href="#" class="text-white hover:bg-blue-500 px-3 py-2 rounded">Inicio</a>
                    <a href="#" class="text-white hover:bg-blue-500 px-3 py-2 rounded">Servicios</a>
                    <a href="#" class="text-white hover:bg-blue-500 px-3 py-2 rounded">Nosotros</a>
                    <a href="#" class="text-white hover:bg-blue-500 px-3 py-2 rounded">Contacto</a>
                </div>
            </div>

            <!-- Menú desplegable para móviles -->
            <div class="md:hidden hidden flex-col space-y-2 mt-2" id="mobileMenu">
                <a href="#" class="text-white hover:bg-blue-500 px-4 py-2">Inicio</a>
                <a href="#" class="text-white hover:bg-blue-500 px-4 py-2">Servicios</a>
                <a href="#" class="text-white hover:bg-blue-500 px-4 py-2">Nosotros</a>
                <a href="#" class="text-white hover:bg-blue-500 px-4 py-2">Contacto</a>
            </div>
        </nav>

        <!-- Contenido de la página -->
        <script>
            // Script para manejar el menú en pantallas pequeñas
            const menuButton = document.getElementById('menuButton');
            const mobileMenu = document.getElementById('mobileMenu');

            menuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        </script>
     
        <!--Cuerpo con los posts-->

        <div class="overflow-x-auto">
          
            <article class="flex flex-col shadow my-4">
                <div class="bg-white flex flex-col justify-start p-6">
                    <a href="/{{$post->slug}}" class="hover:opacity-75">
                        <img src="http://localhost:8000/storage/{{$post->image_url}}" alt="fotos de mi blog">
                    </a>
                    <a href="" class="text-blue-700 text-sm font-bold uppercase pb-4">{{$post->category->name}}</a>
                    <a href="/{{$post->slug}}" class="text-blue-700 text-sm font-bold uppercase pb-4">{{$post->title}}</a>
                    <a href="" class="text-blue-700 text-sm font-bold uppercase pb-4">{{$post->user->name}}</a>, Published on {{$post->created_at}}
                    <a href="" class="text-blue-700 text-sm font-bold uppercase pb-4">{!! $post->body !!}</a>
                    <!-- con la  linea anterior controlamos la cantidad de texto que quereos mostrar y establecemos el boton que al cliclar señalará el resto -->
                </div>
            </article>
            
            
        </div>
        </div>

    </body>

    </html>
