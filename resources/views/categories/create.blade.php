@extends('extras.layout')

@section('content')

<div class="container mx-auto px-4 py-12 bg-gradient-to-r from-yellow-50 via-green-50 to-teal-50 rounded-lg shadow-xl">
    <div class="text-center mb-10">
        <h2 class="text-5xl font-bold text-gray-800 mb-4">Crear Nueva Categoría</h2>
        <p class="text-lg text-gray-600">Agrega una nueva categoría para tus amigurumis.</p>
    </div>

    <div class="bg-white rounded-lg shadow-2xl p-8 md:p-10">
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Campo Nombre -->
            <div class="mb-6">
                <label for="name" class="block text-lg font-semibold text-gray-700">Nombre de la Categoría</label>
                <input type="text" id="name" name="name" placeholder="Ingrese el nombre de la categoría" 
                       class="mt-2 w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300" required>
            </div>

            <!-- Campo Logo -->
            <div class="mb-6">
                <label for="logo" class="block text-lg font-semibold text-gray-700">Logo</label>
                <input type="file" id="logo" name="logo" 
                       class="mt-2 w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300">
            </div>

            <!-- Botón Crear -->
            <div class="text-center mb-6">
                <button type="submit"
                        class="bg-gradient-to-r from-yellow-400 to-green-400 text-white text-lg font-semibold py-3 px-8 rounded-lg shadow-lg hover:from-yellow-300 hover:to-green-300 transition-all duration-300 ease-in-out">
                    Crear Categoría
                </button>
            </div>
        </form>

        <!-- Botón Volver -->
        <div class="text-center mt-6">
            <a href="{{ route('categories.index') }}" class="text-lg font-medium text-green-700 hover:text-green-900 transition duration-300 ease-in-out">
                <i class="fas fa-arrow-left mr-2"></i> Volver a la lista de categorías
            </a>
        </div>
    </div>
</div>

@endsection
