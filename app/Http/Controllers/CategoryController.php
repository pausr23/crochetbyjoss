<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // Obtén las categorías desde la base de datos
        $categories = Category::all();

        // Pasa las categorías a la vista
        return view('extras.home', compact('categories'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Categoría eliminada exitosamente.');
    }

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Buscar la categoría por ID
        $category = Category::findOrFail($id);

        // Actualizar el nombre de la categoría
        $category->name = $request->input('name');

        // Si se subió un nuevo logo, manejar la subida
        if ($request->hasFile('logo')) {
            // Opcional: Manejar la eliminación del logo anterior (debes guardar el `public_id` de la imagen al subirla)
            if ($category->logo) {
                $publicId = pathinfo($category->logo, PATHINFO_FILENAME); // Obtén el ID público de la imagen anterior
                \Cloudinary::destroy("categories/{$publicId}"); // Elimina la imagen anterior
            }

            // Subir el nuevo logo a Cloudinary
            $logo = $request->file('logo');
            $uploadedLogo = \Cloudinary::upload($logo->getRealPath(), [
                'folder' => 'categories'
            ]);
            $category->logo = $uploadedLogo->getSecurePath(); // URL segura del nuevo logo
        }

        // Guardar los cambios en la base de datos
        $category->save();

        // Redirigir a la lista de categorías con un mensaje de éxito
        return redirect()->route('categories.index')->with('success', 'Categoría actualizada exitosamente.');
    }


    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Crear una nueva categoría
        $category = new Category();
        $category->name = $request->input('name');

        // Manejar la subida del logo si existe
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $uploadedLogo = \Cloudinary::upload($logo->getRealPath(), [
                'folder' => 'categories'
            ]);
            $category->logo = $uploadedLogo->getSecurePath(); // URL segura de la imagen en Cloudinary
        }

        // Guardar la categoría en la base de datos
        $category->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('categories.index')->with('success', 'Categoría creada exitosamente.');
    }


    public function create()
    {
        // Retorna la vista para crear una nueva categoría
        return view('categories.create');
    }




}
