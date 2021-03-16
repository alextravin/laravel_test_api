<?php


namespace Tests\Feature\Htpp\Controllers\Api\v1\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;

class AuthControllerLoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @group http
     * @group auth
     * @group login
     * */
    public function testNotAllowed()
    {
        $response = $this
            ->postJson($this->getRoute());
        $response
            ->assertStatus(401);
    }

    /**
     * @group http
     * @group auth
     * @group login
     * */
    public function testGetToken()
    {
        $password = '1234test';
        $email = 'test@test.test';
        UsersGenerator::generateUser(['password' => Hash::make($password), 'email' => $email]);

        $response = $this
            ->postJson($this->getRoute(),['password' => $password, 'email' => $email]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['access_token'])
        ;
    }

    /**
     * @group http
     * @group auth
     * @group login
     * @group wd
     * */
    public function testWrongPassword()
    {
        $password = '1234test';
        $email = 'test@test.test';
        UsersGenerator::generateUser(['password' => Hash::make($password), 'email' => $email]);

        $response = $this
            ->postJson($this->getRoute(),['password' => 'wrongData', 'email' => $email]);

        $response
            ->assertStatus(401)
        ;
    }

    /**
     * @group http
     * @group auth
     * @group login
     * @group wd
     * */
    public function testWrongEmail()
    {
        $password = '1234test';
        $email = 'test@test.test';
        UsersGenerator::generateUser(['password' => Hash::make($password), 'email' => $email]);

        $response = $this
            ->postJson($this->getRoute(),['password' => $password, 'email' => 'wrongData']);

        $response
            ->assertStatus(401)
        ;
    }

    /**
     * @group http
     * @group auth
     * @group login
     * */
    public function testSuccessfullLogin()
    {
        $password = '1234test';
        $email = 'test@test.test';
        UsersGenerator::generateUser(['password' => Hash::make($password), 'email' => $email]);

        $response = $this
            ->postJson($this->getRoute(),['password' => $password, 'email' => $email]);

        $answer = json_decode($response->getContent(), true);
        $token = $answer['accessToken'] ?? null;

        if ($token && is_string($token)) {
            $this->withHeaders([
                'Authorization'=>'Bearer ' . $token
            ]);
        }

        $response = $this->postJson(route('api.auth.me'));

        $answer = json_decode($response->getContent(), true);
        $loggedEmail = $answer['email'] ?? null;
        self::assertEquals($email, $loggedEmail);
    }


    protected function getRoute():string
    {
        return route('api.auth.login');
    }
}
