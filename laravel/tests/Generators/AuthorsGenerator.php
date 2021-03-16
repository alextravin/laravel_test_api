<?php


namespace Tests\Generators;


use App\Models\Author;

class AuthorsGenerator
{

    public static function generateEmptyAuthor(): Author
    {
        return Author::factory()->create();
    }

}
