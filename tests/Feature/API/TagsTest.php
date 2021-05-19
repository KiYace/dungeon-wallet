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
        $response->assertStatus(200);
        $this->assertNotEmpty($response->getContent());
    }
}
