@extends('extras.layout')

@section('content')

<div class="container mx-auto text-center py-12 bg-gradient-to-r from-yellow-50 via-green-50 to-teal-50">
    <!-- Título de la categoría -->
    <h2 class="text-5xl font-extrabold text-gray-800 mb-12 uppercase tracking-wide">
        Explora nuestra categoría: <span class="text-yellow-500">{{ $category->name }}</span>
        <br>
        <span>¡Hecho a mano!</span>
    </h2>

    <!-- Botón de regreso -->
    <div class="mb-8">
        <a href="{{ url('/#categorias') }}" class="bg-yellow-500 text-white py-3 px-6 rounded-full shadow-lg hover:bg-yellow-600 hover:shadow-xl transition duration-300">
            <i class="fas fa-arrow-left mr-2"></i> Volver atrás
        </a>
    </div>

    <!-- Mensaje si no hay amigurumis -->
    @if($message)
        <p class="text-2xl text-gray-600 italic">¡Ups! No hay amigurumis en esta categoría por ahora.</p>
    @else
        <!-- Grid de Amigurumis -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-12">
            @foreach($amigurumis as $amigurumi)
                <div class="flex flex-col items-center text-center bg-white rounded-lg p-6 shadow-lg transform hover:scale-105 hover:shadow-xl transition-all duration-300">
                    <!-- Imagen del Amigurumi -->
                    <img src="{{ $amigurumi->image }}" alt="Imagen de {{ $amigurumi->name }}" class="w-40 h-40 rounded-lg shadow-md mb-4 object-cover transition-transform duration-300 hover:scale-110">

                    <!-- Nombre del Amigurumi -->
                    <p class="text-lg font-semibold text-gray-800 mb-2">{{ $amigurumi->name }}</p>

                    <!-- Botón de detalles -->
                    <a href="{{ route('amigurumi.show', $amigurumi->id) }}" class="mt-4 bg-yellow-500 text-white py-2 px-4 rounded-full hover:bg-yellow-600 transition duration-300">
                        Ver Detalles
                    </a>

                    @auth
                        <!-- Botones de Editar y Eliminar -->
                        <div class="flex space-x-2 mt-3">
                            <!-- Botón de Editar -->
                            <a href="{{ route('amigurumis.edit', $amigurumi->id) }}" class="text-sm text-gray-500 hover:text-gray-700 transition duration-300">
                                Editar
                            </a>

                            <!-- Separador -->
                            <span class="text-gray-400">|</span>

                            <!-- Botón de Eliminar -->
                            <form action="{{ route('amigurumis.destroy', $amigurumi->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este amigurumi?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-500 hover:text-red-700 transition duration-300">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
