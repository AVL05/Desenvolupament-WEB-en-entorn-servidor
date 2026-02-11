<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    private array $books = [
        [
            'title' => 'El Señor de los Anillos',
            'year' => '1954',
            'author' => 'J.R.R. Tolkien',
            'cover' => 'https://m.media-amazon.com/images/I/91eO-jR5XCL._AC_UF1000,1000_QL80_.jpg',
            'available' => true,
            'synopsis' => 'En la Tierra Media, el Señor Oscuro Sauron ordena a los Elfos que forjen los Grandes Anillos de Poder.'
        ],
        [
            'title' => '1984',
            'year' => '1949',
            'author' => 'George Orwell',
            'cover' => 'https://m.media-amazon.com/images/I/71kxa1-0mfL._AC_UF1000,1000_QL80_.jpg',
            'available' => true,
            'synopsis' => 'Winston Smith arrastra una larga existencia gris y deprimida como funcionario del Ministerio de la Verdad.'
        ],
        [
            'title' => 'Dune',
            'year' => '1965',
            'author' => 'Frank Herbert',
            'cover' => 'https://m.media-amazon.com/images/I/81ydZG10gBL._AC_UF1000,1000_QL80_.jpg',
            'available' => false,
            'synopsis' => 'Arrakis: un planeta desierto donde el agua es el bien más preciado y llorar a los muertos, el símbolo de máxima prodigalidad.'
        ],
        [
            'title' => 'Cien años de soledad',
            'year' => '1967',
            'author' => 'Gabriel García Márquez',
            'cover' => 'https://m.media-amazon.com/images/I/81dY+jWJzWL._AC_UF1000,1000_QL80_.jpg',
            'available' => true,
            'synopsis' => 'La historia de la familia Buendía en el pueblo ficticio de Macondo.'
        ],
        [
            'title' => 'El Hobbit',
            'year' => '1937',
            'author' => 'J.R.R. Tolkien',
            'cover' => 'https://m.media-amazon.com/images/I/91b0C2YNSrL._AC_UF1000,1000_QL80_.jpg',
            'available' => true,
            'synopsis' => 'Bilbo Bolsón es un hobbit que disfruta de una vida cómoda y sin ambiciones.'
        ]
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->seedBooks();
        
        // Crear un usuario de prueba
        \App\Models\User::factory()->create([
            'name' => 'Usuario Prueba',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);
    }

    private function seedBooks(): void
    {
        DB::table('books')->delete();

        foreach ($this->books as $bookData) {
            $book = new Book();
            $book->title = $bookData['title'];
            $book->year = $bookData['year'];
            $book->author = $bookData['author'];
            $book->cover = $bookData['cover'];
            $book->available = $bookData['available'];
            $book->synopsis = $bookData['synopsis'];
            $book->save();
        }
    }
}
