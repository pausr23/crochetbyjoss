@extends('extras.layout')

@section('content')

<div class="container mx-auto px-4 py-12 bg-gradient-to-r from-yellow-50 via-green-50 to-teal-50 rounded-lg shadow-xl">
    <div class="text-center mb-10">
        <h2 class="text-5xl font-bold text-gray-800 mb-4">Editar Amigurumi</h2>
        <p class="text-lg text-gray-600">¡Actualiza los detalles de este amigurumi!</p>
    </div>

    <div class="bg-white rounded-lg shadow-2xl p-8 md:p-10">
        <form action="{{ route('amigurumis.update', $amigurumi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="name" class="block text-lg font-semibold text-gray-700">Nombre</label>
                <input type="text" id="name" name="name" value="{{ old('name', $amigurumi->name) }}" class="mt-2 w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300" required>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-lg font-semibold text-gray-700">Descripción</label>
                <textarea id="description" name="description" class="mt-2 w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300" rows="4" required>{{ old('description', $amigurumi->description) }}</textarea>
            </div>

            <div class="mb-6">
                <label for="image" class="block text-lg font-semibold text-gray-700">Imagen</label>
                <input type="file" id="image" name="image" class="mt-2 w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300">
                @if($amigurumi->image)
                    <img src="{{ $amigurumi->image }}" alt="Imagen de {{ $amigurumi->name }}" class="mt-4 w-32 h-32 object-cover rounded-lg">
                @endif
            </div>

            <div class="mb-6">
                <label for="category_id" class="block text-lg font-semibold text-gray-700">Categoría</label>
                <select id="category_id" name="category_id" class="mt-2 w-full p-4 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $amigurumi->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="text-center mb-6">
                <button type="submit" class="bg-gradient-to-r from-yellow-400 to-green-400 text-white text-lg font-semibold py-3 px-8 rounded-lg shadow-lg hover:from-yellow-300 hover:to-green-300 transition-all duration-300 ease-in-out">
                    Guardar Cambios
                </button>
            </div>
        </form>

        <!-- Botón Volver -->
        <div class="text-center mt-6">
            <a href="{{ route('amigurumis.byCategory', $amigurumi->category_id) }}" class="text-lg font-medium text-green-700 hover:text-green-900 transition duration-300 ease-in-out">
                <i class="fas fa-arrow-left mr-2"></i> Volver a la lista de amigurumis
            </a>
        </div>

    </div>
</div>

@endsection
