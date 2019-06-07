<?php

namespace Tests\Feature;

use App\Photo;
use App\User;
use Tests\PassportTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;

class LikeApiTest extends PassportTestCase
{
    protected $photo;


    public function setUp(): void
    {
        parent::setUp();

        factory(Photo::class)->create();
        $this->photo = Photo::first();
    }

    /**
     * @test
     */
    public function testAddLike()
    {
        $response = $this->withHeaders($this->headersWithToken)
            ->json('PUT', route('photo.like', [
                'photo' => $this->photo->id,
            ]));

        $response->assertStatus(200);

        $this->assertEquals(1, $this->photo->likes()->count());
    }

    /**
     * @test
     */
    public function testOnceLike()
    {
        $param = ['id' => $this->photo->id];
        $this->withHeaders($this->headersWithToken)->json('PUT', route('photo.like', $param));
        $this->withHeaders($this->headersWithToken)->json('PUT', route('photo.like', $param));

        $this->assertEquals(1, $this->photo->likes()->count());
    }

    /**
     * @test
     */
    public function testDeleteLike()
    {
        $this->photo->likes()->attach($this->user->id);

        $response = $this->withHeaders($this->headersWithToken)
            ->json('DELETE', route('photo.like', [
                'photo' => $this->photo->id,
            ]));

        $response->assertStatus(200);

        $this->assertEquals(0, $this->photo->likes()->count());
    }
}
