@extends('extras.layout')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-yellow-50 via-green-50 to-teal-50">
    <div class="max-w-lg w-full p-10 bg-white rounded-2xl shadow-xl space-y-8 transform transition-all duration-300 hover:scale-105">
        <div class="text-center space-y-3">
            <h2 class="text-4xl font-extrabold text-gray-800">Acceso <span class="text-yellow-400">Colaboradores</span></h2>
            <p class="text-lg text-gray-600">Ingresa con tus credenciales para acceder al panel de administración.</p>
        </div>

        <form action="{{ url('/login') }}" method="POST" class="space-y-6">
            @csrf
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-all duration-300" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="password" id="password" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 transition-all duration-300" required>
            </div>

            <div>
                <button type="submit" class="w-full py-3 bg-yellow-400 text-black font-medium text-lg rounded-lg shadow-md hover:bg-yellow-300 transition-all duration-300">
                    Iniciar Sesión
                </button>
            </div>
        </form>

        <div class="text-center text-sm text-gray-600">
            <span class="mr-1">¿No eres colaborador?</span>
            <a href="{{ url('/') }}" class="text-yellow-400 hover:text-yellow-500 transition-all duration-300">Volver al Home</a>
        </div>
    </div>
</div>
@endsection
