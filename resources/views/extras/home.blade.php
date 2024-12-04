@extends('extras.layout')

@section('content')

@if(session('success'))
    <div class="flex items-center justify-between bg-green-100 text-green-800 p-4 rounded shadow-md">
        <span>{{ session('success') }}</span>
        <button class="bg-green-500 text-white px-3 py-1 rounded-full hover:bg-green-600" onclick="this.parentElement.style.display='none'">
            ×
        </button>
    </div>
@endif


<header class="relative w-full h-screen overflow-hidden mb-5">
    <!-- Imagen de fondo con efecto degradado -->
    <div
        class="absolute inset-0 bg-cover bg-center rounded-b-[10%] opacity-80"
        style="background-image: url('https://i.ibb.co/3m36F3F/Whats-App-Image-2024-12-01-at-6-55-47-PM.jpg');">
        <div class="absolute inset-0 bg-gradient-to-b from-black via-transparent to-black rounded-b-[10%]"></div>
    </div>

    <nav class="relative top-0 left-0 w-full py-6 z-50">
        <div class="container mx-auto flex justify-between items-center px-8 font-dm-sans">
            <!-- Logo del sitio -->
            <div class="text-white text-xl font-bold tracking-wide">
                Crochet By Joss
            </div>
            <!-- Menú -->
            <ul class="flex space-x-8 text-white text-base font-medium tracking-wider">
                <li><a href="#inicio" class="hover:text-yellow-400 transition duration-300">Inicio</a></li>
                <li><a href="#categorias" class="hover:text-yellow-400 transition duration-300">Categorías</a></li>
                <li><a href="#sobre-nosotros" class="hover:text-yellow-400 transition duration-300">Sobre Nosotros</a></li>
                <li><a href="#cuidados" class="hover:text-yellow-400 transition duration-300">Cuidados</a></li>
                @guest
                    <li><a href="#pedidos" class="hover:text-yellow-400 transition duration-300">Pedidos</a></li>
                @endguest
                <!-- Nuevo botón para ver órdenes -->
                @auth
                    <li><a href="{{ route('orders.index') }}" class="hover:text-yellow-400 transition duration-300">Ver Órdenes</a></li>
                @endauth

            </ul>
            <!-- Botón de inicio de sesión -->
            <div>
                @guest
                    <a href="{{ route('login') }}" class="px-4 py-2 bg-yellow-400 text-black font-medium text-sm rounded-md shadow-md hover:bg-yellow-300 transition duration-300">
                        Iniciar Sesión
                    </a>
                @else
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-400 text-white font-medium text-sm rounded-md shadow-md hover:bg-red-300 transition duration-300">
                            Cerrar Sesión
                        </button>
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Contenido del header -->
    <div  id="inicio" class="absolute inset-0 flex flex-col items-center justify-center text-center z-20 text-white space-y-6">
        <!-- Logo central -->
        <div class="w-52 h-52 md:w-72 md:h-72 rounded-full bg-white bg-opacity-30 flex items-center justify-center backdrop-blur-sm shadow-lg">
            <img
                src="https://i.ibb.co/mX4d6SP/Post-de-Instagram-Nota-de-Aviso-Doodle-Blanco-y-Amarillo-removebg-preview.png"
                alt="Logo Crochet By Joss"
                class="max-w-[80%]">
        </div>
        <!-- Slogan -->
        <h1 class="text-3xl md:text-5xl font-bold tracking-wide drop-shadow-lg">
            Hecho a mano con <span class="text-yellow-400">amor</span> y creatividad
        </h1>
        <!-- Botón -->
        <a href="/pedido" class="px-8 py-4 bg-yellow-400 text-black font-medium text-lg rounded-full shadow-md hover:bg-yellow-300 transition-all duration-300">
            Haz tu pedido
        </a>
    </div>

    <!-- Animación decorativa de líneas -->
    <div class="absolute bottom-0 left-0 w-full flex justify-center items-center space-x-4 z-10">
        <div class="w-6 h-6 rounded-full bg-yellow-400 animate-bounce"></div>
        <div class="w-8 h-8 rounded-full bg-yellow-300 animate-bounce delay-200"></div>
        <div class="w-6 h-6 rounded-full bg-yellow-400 animate-bounce delay-400"></div>
    </div>
</header>


<!-- Sección de Categorías -->
<section id="categorias" class="py-20 bg-gray-100">
    <div class="container mx-auto text-center">
        <h2 class="text-4xl font-bold mb-12 text-gray-800">
            Explora Nuestras Categorías
        </h2>
        <!-- Grid configurado para una sola columna en dispositivos móviles -->
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-5 mx-5">
            @foreach($categories as $category)
            <div class="flex flex-col items-center text-center bg-white rounded-lg shadow-md p-4 transition-transform transform hover:scale-105">
                <!-- Logo de la categoría -->
                <a href="{{ route('amigurumis.byCategory', $category->id) }}" class="mb-4">
                    <img src="{{ $category->logo }}" alt="{{ $category->name }}" class="w-24 h-24 rounded-full shadow-lg object-cover">
                </a>
                <!-- Nombre y botones de acción -->
                <div class="flex flex-col items-center">
                    <p class="text-lg font-medium text-gray-800 mb-2">{{ $category->name }}</p>
                    @auth
                        <div class="flex space-x-4">
                            <!-- Botón editar -->
                            <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-500 hover:text-blue-600">
                                <i class="fas fa-edit"></i>
                            </a>
                            <!-- Botón borrar -->
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta categoría?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-600">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @auth
        <!-- Botón Añadir Amigurumi -->
        <div class="mt-14 text-center">
            <a
            href="/amigurumis/create"
            class="inline-block px-6 py-3 bg-yellow-400 text-black font-medium text-lg rounded-full shadow-md hover:bg-yellow-300 transition-all duration-300">
            Añadir Amigurumi
            </a>

            <a
            href="{{ route('categories.create') }}"
            class="inline-block px-6 py-3 bg-yellow-400 text-black font-medium text-lg rounded-full shadow-md hover:bg-yellow-300 transition-all duration-300">
            Crear Categoría
            </a>
        </div>
    @endauth
</section>




<section id="sobre-nosotros" class="py-20 bg-gray-50">
    <div class="container mx-auto px-8 text-center">
        <h2 class="text-4xl font-bold text-yellow-400 mb-6">¿Qué es un Amigurumi?</h2>
        <p class="text-lg text-gray-700 mb-12 max-w-3xl mx-auto">
            El amigurumi es una técnica artesanal originaria de Japón, que consiste en tejer o
            tejer a ganchillo pequeñas figuras, generalmente de animales, personajes o elementos
            de la naturaleza. Estas creaciones suelen ser adorables, tiernas y llenas de detalles
            únicos. Cada amigurumi es hecho a mano con dedicación y amor, haciendo que cada pieza
            sea especial y única.
        </p>
        <div class="flex justify-center items-center space-x-12">
            <div class="w-64 h-64 rounded-full bg-gray-100 p-6 shadow-lg flex items-center justify-center">
                <img src="https://i.ibb.co/Lzr6T5h/Whats-App-Image-2024-12-03-at-10-02-15-PM.jpg"
                    alt="Ejemplo de amigurumi"
                    class="max-w-[80%] rounded-full shadow-md">
            </div>
            <div class="w-64 h-64 rounded-full bg-gray-100 p-6 shadow-lg flex items-center justify-center">
                <img src="https://i.ibb.co/3knZPs7/Whats-App-Image-2024-12-03-at-9-59-00-PM.jpg"
                    alt="Ejemplo de amigurumi"
                    class="max-w-[80%] rounded-full shadow-md">
            </div>
        </div>
    </div>
</section>

<section id="cuidados" class="py-20 bg-gray-100">
    <div class="container mx-auto px-8 text-center">
        <h2 class="text-4xl font-bold text-yellow-400 mb-6">Cuidados y Cómo Lavar Tu Amigurumi</h2>
        <p class="text-lg text-gray-700 mb-12 max-w-3xl mx-auto">
            Los amigurumis son creaciones delicadas que requieren de cuidados especiales para
            mantenerse en su mejor estado. Aunque son piezas resistentes, es importante seguir
            algunos consejos para asegurar su durabilidad y limpieza. Aquí te dejamos algunos
            consejos sobre cómo cuidar y lavar tu amigurumi de manera adecuada.
        </p>
        <div class="flex flex-col md:flex-row justify-center items-center space-x-12 space-y-8 md:space-y-0">
            <!-- Imagen de lavado a mano -->
            <div class="w-64 h-64 rounded-lg bg-white p-6 shadow-lg flex items-center justify-center">
                <img src="https://i.ibb.co/DL6XCVB/Whats-App-Image-2024-12-02-at-11-09-22-PM.jpg" alt="Lavado a mano" class="max-w-[80%] rounded-lg shadow-md">
            </div>
            <div class="w-full md:w-2/3">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Lavado a Mano</h3>
                <p class="text-base text-gray-600 mb-6">
                    La mejor manera de lavar tu amigurumi es a mano. Utiliza agua tibia y un jabón suave,
                    asegurándote de frotar suavemente para no dañar las fibras. Evita los detergentes fuertes
                    o abrasivos que puedan dañar el material o descolorear el amigurumi.
                </p>
                <ul class="list-disc text-left text-gray-600 mx-auto max-w-xl">
                    <li>Lávalo con movimientos suaves, sin frotar con fuerza.</li>
                    <li>No uses blanqueadores ni productos químicos fuertes.</li>
                    <li>Sécalo al aire, nunca en la secadora.</li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col md:flex-row justify-center items-center space-x-12 space-y-8 md:space-y-0 mt-16">
            <!-- Imagen de secado -->
            <div class="w-64 h-64 rounded-lg bg-white p-6 shadow-lg flex items-center justify-center">
                <img src="https://i.ibb.co/G0WH5yt/Whats-App-Image-2024-12-02-at-11-32-45-PM.jpg" alt="Secado" class="max-w-[80%] rounded-lg shadow-md">
            </div>
            <div class="w-full md:w-2/3">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Secado y Mantenimiento</h3>
                <p class="text-base text-gray-600 mb-6">
                    Una vez lavado, es esencial secar tu amigurumi de manera adecuada. Nunca lo pongas
                    en la secadora, ya que esto podría deformar la figura. Es recomendable dejarlo secar al aire
                    en un lugar cálido, pero sin exponerlo directamente al sol para evitar que los colores se desvanezcan.
                </p>
                <ul class="list-disc text-left text-gray-600 mx-auto max-w-xl">
                    <li>Coloca el amigurumi sobre una toalla limpia para absorber el exceso de agua.</li>
                    <li>Déjalo secar al aire durante al menos 12 horas.</li>
                    <li>Asegúrate de que esté completamente seco antes de guardarlo o usarlo.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="pedidos" class="py-20 bg-gray-50">
    <div class="container mx-auto text-center">
        <h2 class="text-4xl font-bold text-yellow-400 mb-6">Haz tu Pedido</h2>
        <p class="text-lg text-gray-700 mb-12 max-w-3xl mx-auto">
            Si ya has encontrado tu amigurumi favorito, no dudes en hacer tu pedido. ¡Te garantizamos
            que cada pieza será única y hecha con mucho amor!
        </p>
        <a href="/pedido" class="px-8 py-4 bg-yellow-400 text-black font-medium text-lg rounded-full shadow-md hover:bg-yellow-300 transition-all duration-300">
            Pedir ahora
        </a>
    </div>
</section>


<footer class="bg-gray-800 text-white py-12">
    <div class="container mx-auto px-8">
        <!-- Información de la empresa -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-12 mb-8">
            <!-- Sección de información -->
            <div class="flex flex-col space-y-4">
                <h3 class="text-lg font-semibold">Sobre Nosotros</h3>
                <p class="text-sm text-gray-400">
                    Somos una empresa dedicada a crear amigurumis únicos, hechos a mano con amor y creatividad. ¡Encuentra el perfecto para ti!
                </p>
            </div>

            <!-- Enlaces rápidos -->
            <div class="flex flex-col space-y-4">
                <h3 class="text-lg font-semibold">Enlaces Rápidos</h3>
                <ul class="space-y-2">
                    <li><a href="#inicio" class="text-gray-400 hover:text-yellow-400 transition duration-300">Inicio</a></li>
                    <li><a href="#categorias" class="text-gray-400 hover:text-yellow-400 transition duration-300">Categorías</a></li>
                    <li><a href="#pedidos" class="text-gray-400 hover:text-yellow-400 transition duration-300">Pedidos</a></li>
                    <li><a href="#sobre-nosotros" class="text-gray-400 hover:text-yellow-400 transition duration-300">Sobre Nosotros</a></li>
                </ul>
            </div>

            <!-- Contacto -->
            <div class="flex flex-col space-y-4">
                <h3 class="text-lg font-semibold">Contacto</h3>
                <p class="text-sm text-gray-400">Email: rossp8159@gmail.com</p>
                <p class="text-sm text-gray-400">Teléfono: +506 6441-7827</p>
            </div>

            <!-- Redes Sociales -->
            <div class="flex flex-col space-y-4">
                <h3 class="text-lg font-semibold">Síguenos</h3>
                <div class="flex space-x-6">
                    <a href="https://www.instagram.com/crochetbyjoss_?igsh=ZjdvaDcyOXYwdmV2&utm_source=qr" class="text-gray-400 hover:text-yellow-400 transition duration-300">
                        <i class="fab fa-instagram"></i> Instagram
                    </a>
                </div>
            </div>
        </div>

        <!-- Sección de copyright -->
        <div class="text-center text-sm text-gray-400">
            <p>&copy; 2024 Crochet By Joss. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>
@endsection
