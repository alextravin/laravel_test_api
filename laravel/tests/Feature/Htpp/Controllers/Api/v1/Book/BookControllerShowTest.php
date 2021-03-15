<?php


namespace Tests\Feature\Htpp\Controllers\Api\v1\Book;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\BooksGenerator;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;

class BookControllerShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group http
     * @group show
     * */
    public function testNotAllowed()
    {
        $item = BooksGenerator::generateEmptyBook();

        $response = $this->getJson($this->getRoute($item));
        $response
            ->assertStatus(401);
    }

    /**
     * @group http
     * @group show
     * */
    public function testAllowed()
    {
        $item = BooksGenerator::generateEmptyBook();

        $response = $this
            ->actingAs(UsersGenerator::generateUser())
            ->getJson($this->getRoute($item));
        $response
            ->assertStatus(200);
    }

    protected function getRoute(Book $item):string
    {
        return route('api.books.update',['locale' => 'en','book' => $item]);
    }
}
