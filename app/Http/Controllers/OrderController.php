<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validación del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Manejo de la imagen, si se sube
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('orders_images', 'public');
        }

        // Crear un nuevo pedido
        Order::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'description' => $validated['description'],
            'image' => $imagePath,
        ]);

        // Redirigir al home con un mensaje de éxito
        return redirect()->route('home')->with('success', 'Pedido enviado con éxito');
    }

    public function index()
    {
        // Obtener todas las órdenes
        $orders = Order::all();
        
        // Retornar la vista con las órdenes
        return view('orders.index', compact('orders'));
    }

    public function destroy(Order $order)
    {
        // Eliminar la orden
        $order->delete();

        // Redirigir a la vista de órdenes con un mensaje de éxito
        return redirect()->route('orders.index')->with('success', 'Orden eliminada con éxito');
    }


}
