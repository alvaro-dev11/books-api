<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index()
    {
        return Book::all();
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'=>['required']
        ]);
        // Instanciar nuevo libro
        $book = new Book;
        // Asignar el nombre al libro
        $book->title=$request->input('title');
        // Guardar en la BD
        $book->save();

        // Devolver el libro
        return $book;
    }


    // Route Binding, proceso de pasar el modelo como parametro a la funcion "show"
    // para mostrar todas las columnas del registro que se encontró
    public function show(Book $book)
    {
        return $book;
    }


    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title'=>['required']
        ]);
        // Asignar el nuevo nombre al libro
        $book->title=$request->input('title');
        // Guardar en la BD
        $book->save();

        // Devolver el libro
        return $book;
    }


    public function destroy(Book $book)
    {
        $book->delete();
        return response()->noContent();
    }
}
