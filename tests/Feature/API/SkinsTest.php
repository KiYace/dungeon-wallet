<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\SkinTrait;

class SkinsTest extends TestCase
{
    use DatabaseTransactions, SkinTrait;

    public function testSkinList()
    {
        $response = $this->getJson('api/skins/');
        $response->assertStatus(401);

        $this->createSkin();
        $this->withoutMiddleware();
        $response = $this->getJson('api/skins/');
        $response->assertStatus(200);
        $this->assertNotEmpty($response->getContent());
    }

    public function testShowSkin()
    {
        $skin = $this->createSkin();
        $response = $this->getJson('api/skins/' . $skin->id);
        $response->assertStatus(401);

        $this->withoutMiddleware();
        $response = $this->getJson('api/skins/' . $skin->id);
        $response->assertStatus(200);
        $this->assertNotEmpty($response->getContent());
    }
}
