<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DocumentControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_documents(): void
    {
        $response = $this->json('get', route('api.documents'));
        $documents = $response->decodeResponseJson()['documents'];

        $response->assertJsonStructure(['documents']);
        $response->assertStatus(200);

        $this->assertEquals(count($documents), 3);
        $this->assertEquals($documents[0]['total'], 30);
        $this->assertEquals($documents[0]['priority'], 'high');
    }
}
