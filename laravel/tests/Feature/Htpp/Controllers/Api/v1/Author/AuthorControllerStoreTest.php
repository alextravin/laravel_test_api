<?php


namespace Tests\Feature\Htpp\Controllers\Api\v1\Author;

use App\Models\Author;
use Tests\TestCase;

class AuthorControllerStoreTest extends TestCase
{
    /**
     * @group http
     * @group store
     * */
    public function testNotAllowed()
    {
        //@todo implement
    }

    protected function getRoute():string
    {
        return route('dashboard.question.store',['locale' => 'en']);
    }


    /**
     * @group http
     * @group store
     * @group wd
     * */
    public function testWrongDataPassed()
    {
        //@todo implement
    }

}
