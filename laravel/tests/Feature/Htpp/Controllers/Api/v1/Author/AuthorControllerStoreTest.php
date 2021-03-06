<?php


namespace Tests\Feature\Htpp\Controllers\Api\v1\Author;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;

class AuthorControllerStoreTest extends TestCase
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
        $prevCount = count(Author::all());
        $data = [
            'name' => 'Johnny',
        ];
        $response = $this
            ->actingAs(UsersGenerator::generateUser())
            ->postJson($this->getRoute(),$data);

        $response->assertStatus(201);
        $currentCount = count(Author::all());

        self::assertEquals($prevCount+1, $currentCount);
    }


    protected function getRoute():string
    {
        return route('api.authors.store',['locale' => 'en']);
    }
}
