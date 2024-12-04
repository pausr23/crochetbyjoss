@extends('extras.layout')

@section('content')
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 mb-4 rounded-lg shadow-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-yellow-50 via-green-50 to-teal-50">
        <div class="bg-white p-8 rounded-lg shadow-xl w-full md:w-1/2 lg:w-1/3 space-y-6">
            <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">
                <span class="text-yellow-500">Formulario</span> de Pedido
            </h2>
            
            <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" id="name" name="name" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                    <input type="email" id="email" name="email" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
                </div>

                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                    <input type="text" id="phone" name="phone" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Descripción del pedido</label>
                    <textarea id="description" name="description" rows="4" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Imagen (opcional)</label>
                    <input type="file" id="image" name="image" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400">
                </div>

                <div class="flex justify-center">
                    <button type="submit" class="px-8 py-3 bg-yellow-500 text-white font-medium text-lg rounded-full hover:bg-yellow-400 transition-all duration-300 transform hover:scale-105">
                        Enviar Pedido
                    </button>
                </div>
            </form>

            <div class="flex justify-center mt-6">
                <a href="/" class="text-yellow-500 text-lg font-medium hover:text-yellow-400 transition-all duration-300">
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>
@endsection
