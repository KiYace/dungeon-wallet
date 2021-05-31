<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\TagsTrait;

class TagsTest extends TestCase
{
    use DatabaseTransactions, TagsTrait;

    public function testTagsList()
    {
        $response = $this->getJson('api/tags/');
        $response->assertStatus(401);

        $this->createTag();
        $this->withoutMiddleware();
        $response = $this->getJson('api/tags/');

        print_r($response->getContent());
        $response->assertStatus(200);
        $this->assertNotEmpty($response->getContent());
    }

    public function testCreateTag()
    {
        $response = $this->postJson('api/tags/');
        $response->assertStatus(401);

        $this->withoutMiddleware();
        $response = $this->postJson('api/tags/', [
            'name' => 'test',
            'color' => '000000',
        ]);

        $response->assertStatus(201);
        $this->assertNotEmpty($response->getContent());
    }

    public function testUpdateTag()
    {
        $tag = $this->createTag([
            // TODO fix php8.0.6
//            'system' => false
        ]);

        $response = $this->putJson('api/tags/' . $tag->id);
        $response->assertStatus(401);

        $this->withoutMiddleware();
        $response = $this->putJson('api/tags/' . $tag->id, [
            'name' => 'test',
            'color' => '000000',
        ]);

        $response->assertStatus(200);
        $this->assertNotEmpty($response->getContent());

        $tag = $tag->refresh();
        $this->assertEquals('test', $tag->name);
        $this->assertEquals('000000', $tag->color);
    }
}
