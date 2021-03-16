<?php


namespace Tests\Feature\Htpp\Controllers\Api\v1\Book;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\BooksGenerator;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;

class BookControllerUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group http
     * @group update
     * */
    public function testNotAllowed()
    {
        $item = BooksGenerator::generateEmptyBook();

        $response = $this->putJson($this->getRoute($item));
        $response
            ->assertStatus(401);
    }

    /**
     * @group http
     * @group update
     * @group wd
     * */
    public function testWrongDataPassed()
    {
        $item = BooksGenerator::generateEmptyBook();

        $data = [];
        $response = $this
            ->actingAs(UsersGenerator::generateUser())
            ->putJson($this->getRoute($item),$data);
        $response->assertStatus(422);
    }


    /**
     * @group http
     * @group update
     * */
    public function testRightDataPassed()
    {
        $item = BooksGenerator::generateEmptyBook();


        $authors = Author::factory(4)->create();

        $data = [
            'title' => 'Lord of wings',
            'authors_id' => $authors->pluck('id')->toArray()
        ];
        $response = $this
            ->actingAs(UsersGenerator::generateUser())
            ->putJson($this->getRoute($item),$data);

        $updatedItem = Book::find( $item->id);

        $response->assertStatus(200);
        self::assertEquals('Lord of wings', $updatedItem->title);
        self::assertCount(4, $updatedItem->authors);
    }


    protected function getRoute(Book $item):string
    {
        return route('api.books.update',['locale' => 'en','book' => $item]);
    }
}
