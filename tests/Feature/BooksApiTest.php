<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BooksApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_get_all_books()
    {
        // Para crear 4 libros
        $books = Book::factory(4)->create();
        // Para mostrar todos los libros
        $response = $this->getJson(route('books.index'));
        // Para verificar el titulo del libro 1 y el 2
        $response->assertJsonFragment([
            'title' => $books[0]->title
        ])->assertJsonFragment([
            'title' => $books[1]->title
        ]);
    }

    /** @test */
    function can_get_one_book()
    {
        // Para crear un libro
        $book = Book::factory()->create();

        // Para mostrar un libro
        $response = $this->getJson(route('books.show', $book));

        // Para verificar el libro mostrado
        $response->assertJsonFragment([
            'title' => $book->title
        ]);
    }

    /** @test */
    function can_create_books()
    {
        // Para validar que la columna title tenga un valor
        $this->postJson(route('books.store'), [])
            ->assertJsonValidationErrorFor('title');

        // Para crear un nuevo libro
        $this->postJson(route('books.store'), [
            'title' => 'My new book'
        ])->assertJsonFragment([
            'title' => 'My new book'
        ]);

        // Para verificar el libro creado en la BD
        $this->assertDatabaseHas('books', [
            'title' => 'My new book'
        ]);
    }

    /** @test */
    function can_update_books()
    {
        // Para crear un libro
        $book = Book::factory()->create();

        // Para validar que la columna title tenga un valor
        $this->patchJson(route('books.update', $book), [])
            ->assertJsonValidationErrorFor('title');

        // Para realizar la actualización del libro
        $this->patchJson(route('books.update', $book), [
            'title' => 'Edited book'
        ])->assertJsonFragment([
            'title' => 'Edited book'
        ]);

        // Para verificar el libro actualizado en la BD
        $this->assertDatabaseHas('books', [
            'title' => 'Edited book'
        ]);
    }

    /** @test */
    function can_delete_books()
    {
        // Para crear un libro
        $book = Book::factory()->create();

        // Para realizar la eliminación del libro
        $this->deleteJson(route('books.destroy', $book))
            ->assertNoContent();

        // Para verificar que no quede ningun libro
        $this->assertDatabaseCount('books', 0);
    }
}
