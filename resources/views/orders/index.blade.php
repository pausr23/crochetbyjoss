@extends('extras.layout')

@section('content')
    <div class="container mx-auto p-8">

        <!-- Título con animación -->
        <div class="mb-8 text-center">
            <h2 class="text-6xl font-extrabold">
                Órdenes Recibidas
            </h2>
            <p class="text-lg text-gray-600 mb-8 animate__animated animate__fadeIn animate__delay-1.2s">Aquí puedes ver todas las órdenes realizadas. ¡Revisa los pedidos de nuestros clientes y gestiona eficientemente!</p>
            <!-- Botón para regresar al Home -->
            <div class="mt-12 text-center">
                <a href="{{ route('home') }}" class="px-10 py-5 bg-gradient-to-r from-yellow-400 to-yellow-500 text-black font-semibold rounded-full shadow-xl hover:bg-yellow-300 transition-all duration-300 ease-in-out transform hover:scale-105">
                    Volver al Inicio
                </a>
            </div>
        </div>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-5 mb-8 rounded-xl shadow-2xl transform hover:scale-105 transition-all duration-300">
                {{ session('success') }}
            </div>
        @endif

        <!-- Mensaje cuando no hay órdenes -->
        @if($orders->isEmpty())
            <div class="bg-yellow-500 text-white p-5 mb-8 rounded-xl shadow-2xl transform hover:scale-105 transition-all duration-300">
                No hay órdenes aún.
            </div>
        @else
            <div class="space-y-8">
                @foreach($orders as $order)
                    <div class="flex flex-col md:flex-row  bg-gradient-to-r from-yellow-50 via-green-50 to-teal-50 shadow-xl rounded-lg p-6 hover:scale-105 transform transition-all duration-500 ease-in-out">

                        <!-- Imagen de la orden con borde redondeado y efecto hover -->
                        @if($order->image)
                            <div class="md:w-1/3 mb-6 md:mb-0">
                                <img src="{{ Storage::url($order->image) }}" alt="Imagen del pedido" class="w-full h-64 object-cover rounded-xl shadow-lg hover:opacity-90 transition-all duration-300">
                                
                                <!-- Botón para descargar la imagen -->
                                <a href="{{ Storage::url($order->image) }}" download="{{ basename($order->image) }}" class="mt-4 inline-block px-4 py-2  text-indigo-600 rounded-md border border-indigo-600 hover:bg-transparent hover:text-indigo-600 hover:border-indigo-600 transition-all duration-300 ease-in-out transform hover:scale-105">
                                    Descargar Imagen
                                </a>


                            </div>
                        @endif

                        <!-- Detalles de la orden -->
                        <div class="md:w-2/3 md:pl-6 space-y-6">
                            <h3 class="text-3xl font-semibold text-gray-800 mb-4">{{ $order->name }}</h3>
                            <p class="text-sm text-gray-600">Correo: <span class="text-gray-800">{{ $order->email }}</span></p>
                            <p class="text-sm text-gray-600">Teléfono: <span class="text-gray-800">{{ $order->phone }}</span></p>
                            <p class="mt-4 text-lg text-gray-700">{{ $order->description }}</p>
                        </div>

                        <!-- Botón para eliminar la orden -->
                        <div class="mt-4 md:mt-0 flex justify-center items-center md:pl-6">
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-8 py-4 bg-red-500 text-white rounded-xl shadow-xl hover:bg-red-400 transition-all duration-300 transform hover:scale-110">
                                    Eliminar Pedido
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
@endsection
