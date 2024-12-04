<?php

namespace App\Http\Controllers;

use App\Models\Amigurumi;
use App\Models\Category;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary; // Importar la fachada de Cloudinary

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
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        
        // Manejar la imagen (si se sube una)
        if ($request->hasFile('image')) {
            // Subir la imagen a Cloudinary
            $image = $request->file('image');
            $uploadedImage = Cloudinary::upload($image->getRealPath(), [
                'folder' => 'amigurumis' // Puedes personalizar el nombre de la carpeta en Cloudinary
            ]);

            // Obtener la URL segura de la imagen subida
            $imagePath = $uploadedImage->getSecurePath();
        } else {
            $imagePath = null;
        }

        // Crear el amigurumi
        Amigurumi::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $imagePath, // Guardar la URL de la imagen subida en Cloudinary
        ]);

        // Redirigir al listado de amigurumis o donde desees
        return redirect()->route('home')->with('success', 'Amigurumi creado con éxito');
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

    public function edit($id)
    {
        $amigurumi = Amigurumi::findOrFail($id); // Encuentra el amigurumi por su ID
        $categories = Category::all(); // Obtén todas las categorías

        return view('amigurumis.edit', compact('amigurumi', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $amigurumi = Amigurumi::findOrFail($id); // Encuentra el amigurumi por su ID
    
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Actualizar los datos del amigurumi
        $amigurumi->name = $request->name;
        $amigurumi->description = $request->description;
        $amigurumi->category_id = $request->category_id;
    
        // Manejar la imagen (si se sube una nueva)
        if ($request->hasFile('image')) {
            // Subir la nueva imagen a Cloudinary
            $image = $request->file('image');
            $uploadedImage = Cloudinary::upload($image->getRealPath(), [
                'folder' => 'amigurumis', // Carpeta en Cloudinary
            ]);
    
            // Obtener la URL segura de la nueva imagen
            $imagePath = $uploadedImage->getSecurePath();
    
            // Opcional: Eliminar la imagen anterior de Cloudinary si tienes la lógica para obtener su ID público
            if ($amigurumi->image) {
                Cloudinary::destroy(basename($amigurumi->image)); // Reemplaza con la lógica para extraer el ID público
            }
    
            // Asignar la nueva URL al amigurumi
            $amigurumi->image = $imagePath;
        }
    
        // Guardar los cambios en la base de datos
        $amigurumi->save();
    
        return redirect()->route('amigurumis.byCategory', $amigurumi->category_id)
                     ->with('success', 'Amigurumi actualizado con éxito.');
    }

    public function destroy($id)
    {
        // Encontrar el amigurumi por ID
        $amigurumi = Amigurumi::findOrFail($id);
        
        // Eliminar la imagen de Cloudinary (si existe)
        if ($amigurumi->image) {
            // Obtener el ID de la imagen de Cloudinary y eliminarla
            Cloudinary::destroy(basename($amigurumi->image)); // Extrae el ID de la imagen de la URL
        }
        
        // Eliminar el amigurumi de la base de datos
        $amigurumi->delete();

        // Redirigir al listado de amigurumis de la categoría o a una ruta general
        return redirect()->route('amigurumis.byCategory', $amigurumi->category_id)
                        ->with('success', 'Amigurumi eliminado con éxito.');
    }

    public function show($id)
    {
        // Obtener el amigurumi por su ID
        $amigurumi = Amigurumi::findOrFail($id);

        // Retornar la vista con los detalles del amigurumi
        return view('amigurumis.show', compact('amigurumi'));
    }


}