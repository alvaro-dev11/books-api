<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

    // Para mostrar todos los libros
    public function index()
    {
        return Book::all();
    }


    // Para crear libros
    public function store(Request $request)
    {
        // Para validar que el campo titulo no esté vacío
        $request->validate([
            'title'=>['required']
        ]);
        // Para instanciar un nuevo libro
        $book = new Book;
        // Para asignar el titulo al libro
        $book->title=$request->input('title');
        // Para guardar en la BD
        $book->save();

        // Para devolver el libro
        return $book;
    }


    // Route Binding, proceso de pasar el modelo como parametro a la funcion "show"
    // para mostrar todas las columnas del registro que se encontró
    // Para mostrar un solo libro
    public function show(Book $book)
    {
        return $book;
    }

    // Para actualizar libros
    public function update(Request $request, Book $book)
    {
        // Para validar que el campo titulo no esté vacío
        $request->validate([
            'title'=>['required']
        ]);
        // Para asignar el nuevo título al libro
        $book->title=$request->input('title');
        // Para guardar en la BD
        $book->save();

        // Para devolver el libro
        return $book;
    }

    // Para eliminar libros
    public function destroy(Book $book)
    {
        // Para eliminar el libro
        $book->delete();
        // Para no devolver contenido alguno solo el estado 204
        return response()->noContent();
    }
}
