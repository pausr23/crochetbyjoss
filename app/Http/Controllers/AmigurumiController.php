<?php

namespace App\Http\Controllers;

use App\Models\Amigurumi;
use App\Models\Category;
use Illuminate\Http\Request;

class AmigurumiController extends Controller
{
    public function create()
    {
        // Obtener las categorías de la base de datos
        $categories = Category::all();

        // Pasar las categorías a la vista
        return view('amigurumis.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        
        // Manejar la imagen (si se sube una)
        if ($request->hasFile('image')) {
            // Almacenar la imagen en public/images/amigurumis
            $imagePath = $request->file('image')->store('images/amigurumis', 'public');
        } else {
            $imagePath = null;
        }


        // Crear el amigurumi
        Amigurumi::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);

        // Redirigir al listado de amigurumis o donde desees
        return redirect()->route('amigurumis.index')->with('success', 'Amigurumi creado con éxito');
    }

    public function showByCategory($categoryId)
    {
        // Obtener la categoría por su ID
        $category = Category::find($categoryId);

        // Verificar si la categoría existe
        if (!$category) {
            return redirect()->route('extras.home')->with('error', 'Categoría no encontrada');
        }

        // Obtener los amigurumis de esa categoría
        $amigurumis = Amigurumi::where('category_id', $categoryId)->get();

        // Si no hay amigurumis, mostrar un mensaje
        $message = $amigurumis->isEmpty() ? 'No hay amigurumis en esta categoría' : '';

        // Retornar la vista con los amigurumis y el mensaje
        return view('amigurumis.category', compact('amigurumis', 'category', 'message'));
    }
    
}

