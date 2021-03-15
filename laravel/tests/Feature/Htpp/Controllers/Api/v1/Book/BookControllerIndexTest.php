<?php


namespace Tests\Feature\Htpp\Controllers\Api\v1\Book;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;

class BookControllerIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group http
     * @group index
     * */
    public function testNotAllowed()
    {
        $response = $this->getJson($this->getRoute());
        $response
            ->assertStatus(401);
    }

    /**
     * @group http
     * @group index
     * */
    public function testAllowed()
    {
        $response = $this
            ->actingAs(UsersGenerator::generateUser())
            ->getJson($this->getRoute());
        $response
            ->assertStatus(200);
    }

    protected function getRoute():string
    {
        return route('api.books.index',['locale' => 'en']);
    }
}
