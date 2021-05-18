<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\PlayerTrait;
use Tests\Traits\SkinTrait;

class PlayerTest extends TestCase
{
    use DatabaseTransactions, PlayerTrait, SkinTrait;

    public function testPlayerRegister()
    {
        $skin = $this->createSkin();
        $response = $this->postJson('api/player/', [
            'nickname' => 'Lerroyy',
            'mail' => 'kiyacelerroy@gmail.com',
            'password' => '123123',
            'password_confirm' => '123123',
            'skin' => $skin->id,
            'push_enabled' => true,
            'push_token' => '123123',
        ]);

        $response->assertStatus(201);
        $this->assertNotEmpty($response['data']);
        $this->assertNotEmpty($response['data']['id']);
        $this->assertNotEmpty($response['data']['nickname']);
        $this->assertNotEmpty($response['data']['skin']);
        $this->assertNotEmpty($response['data']['push_token']);
        $this->assertNotEmpty($response['token']);
    }

    public function testPlayerRegisterValidation()
    {
        $skin = $this->createSkin();
        $response = $this->postJson('api/player/', [
            'nickname' => 'Lerroyy',
            'mail' => 'kiyacelerroy@gmail.com',
            'password' => '123123',
            'password_confirm' => '121233123',
            'skin' => $skin->id,
            'push_enabled' => true,
            'push_token' => '123123',
        ]);

        $response->assertStatus(422);
        $this->assertNotEmpty($response['message']);
        $this->assertNotEmpty($response['errors']);

        $response = $this->postJson('api/player/', [
            'nickname' => 'Lerroyy',
            'mail' => 'kiyacelerroy',
            'password' => '123123',
            'password_confirm' => '123123',
            'skin' => $skin->id,
            'push_enabled' => true,
            'push_token' => '123123',
        ]);

        $response->assertStatus(422);
        $this->assertNotEmpty($response['message']);
        $this->assertNotEmpty($response['errors']);
    }

    public function testUniquePlayerRegistration()
    {
        $player = $this->createPlayer();

        $response = $this->postJson('api/player/', [
            'nickname' => $player->nickname,
            'mail' => $player->mail,
            'password' => $player->password,
            'password_confirm' => $player->password,
            'skin' => $player->skin_id,
            'push_token' => $player->push_token,
            'push_enabled' => $player->push_enabled,
        ]);

//        print_r($response->getContent());
        $response->assertStatus(422);
        $this->assertNotEmpty($response['message']);
        $this->assertNotEmpty($response['errors']);
    }
}
