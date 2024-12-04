@extends('extras.layout')

@section('content')

<div class="container mx-auto py-16 px-6 md:px-12 bg-gradient-to-r from-yellow-50 via-green-50 to-teal-50 rounded-lg shadow-lg">
    <!-- Título del Amigurumi -->
    <h2 class="text-5xl font-extrabold text-gray-800 mb-8 text-center tracking-wide">{{ $amigurumi->name }}</h2>

    <!-- Grid de detalles del Amigurumi -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16 md:gap-24">
        <!-- Imagen del Amigurumi -->
        <div class="flex justify-center items-center">
            <img src="{{ $amigurumi->image }}" alt="Imagen de {{ $amigurumi->name }}" class="w-96 h-96 object-cover rounded-3xl shadow-2xl transform transition-all duration-500 hover:scale-110 hover:shadow-2xl">
        </div>

        <!-- Descripción y Datos del Amigurumi -->
        <div class="flex flex-col justify-center space-y-8 text-center md:text-left">
            <!-- Descripción del Amigurumi -->
            <div class="text-gray-800 bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-3xl font-semibold text-gray-800 mb-6">Descripción</h3>
                <p class="text-xl text-gray-700 leading-relaxed">{{ $amigurumi->description }}</p>
            </div>

            <!-- Detalles adicionales -->
            <div class="bg-white p-6 rounded-xl shadow-lg space-y-4">
                <div class="flex justify-between">
                    <span class="font-medium text-gray-600 text-lg">Categoría:</span>
                    <span class="text-lg font-semibold text-gray-800">{{ $amigurumi->category->name }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Botón de Regreso -->
    <div class="mt-12 text-center">
        <a href="{{ route('amigurumis.byCategory', $amigurumi->category_id) }}" class="bg-yellow-500 text-white py-3 px-8 rounded-full shadow-xl transform transition-all duration-300 hover:bg-yellow-600 hover:scale-105 hover:shadow-2xl">
            <i class="fas fa-arrow-left mr-2"></i> Volver a las Categorías
        </a>
    </div>
</div>

@endsection
