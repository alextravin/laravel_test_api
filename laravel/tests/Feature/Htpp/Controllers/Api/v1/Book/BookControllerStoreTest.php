<?php


namespace Tests\Feature\Htpp\Controllers\Api\v1\Book;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;

class BookControllerStoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group http
     * @group store
     * */
    public function testNotAllowed()
    {
        $response = $this->postJson($this->getRoute());
        $response
            ->assertStatus(401);
    }

    /**
     * @group http
     * @group store
     * @group wd
     * */
    public function testWrongDataPassed()
    {
        $data = [];
        $response = $this
            ->actingAs(UsersGenerator::generateUser())
            ->postJson($this->getRoute(),$data);
        $response->assertStatus(422);
    }


    /**
     * @group http
     * @group store
     * */
    public function testRightDataPassed()
    {
        $prevCount = count(Book::all());

        Author::factory(2)->create();

        $data = [
            'title' => 'Lord of wings',
            'authors_id' => [
                1,2
            ]
        ];
        $response = $this
            ->actingAs(UsersGenerator::generateUser())
            ->postJson($this->getRoute(),$data);

        $response->assertStatus(201);
        $currentCount = count(Book::all());

        self::assertEquals($prevCount+1, $currentCount);
    }


    protected function getRoute():string
    {
        return route('api.books.store',['locale' => 'en']);
    }
}
