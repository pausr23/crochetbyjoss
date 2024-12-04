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
            // Opcional: Borrar el logo anterior si existe
            if ($category->logo && \File::exists(public_path($category->logo))) {
                \File::delete(public_path($category->logo));
            }

            // Guardar el nuevo logo
            $logoPath = $request->file('logo')->store('categories', 'public');
            $category->logo = 'storage/' . $logoPath;
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
            $logoPath = $request->file('logo')->store('categories', 'public');
            $category->logo = 'storage/' . $logoPath;
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
