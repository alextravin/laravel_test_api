<?php


namespace Tests\Generators;


use App\Models\Book;

class BooksGenerator
{

    public static function generateEmptyBook(): Book
    {
        return Book::factory()->create();
    }

}
