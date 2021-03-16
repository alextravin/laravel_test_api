<?php


namespace Tests\Feature\Htpp\Controllers\Api\v1\Author;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\AuthorsGenerator;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;

class AuthorControllerShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group http
     * @group show
     * @group authorShow
     * */
    public function testNotAllowed()
    {
        $item = AuthorsGenerator::generateEmptyAuthor();

        $response = $this->getJson($this->getRoute($item));
        $response
            ->assertStatus(401);
    }

    /**
     * @group http
     * @group authorShow
     * */
    public function testAllowed()
    {
        $item = AuthorsGenerator::generateEmptyAuthor();

        $response = $this
            ->actingAs(UsersGenerator::generateUser())
            ->getJson($this->getRoute($item));

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['id','books','name'])
        ;
    }

    protected function getRoute(Author $item):string
    {
        return route('api.authors.show',['locale' => 'en','author' => $item]);
    }
}
