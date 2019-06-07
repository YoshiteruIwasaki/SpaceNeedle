<?php

namespace Tests\Feature;

use App\Photo;
use App\User;
use Tests\PassportTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddCommentApiTest extends PassportTestCase
{

    /**
     * @test
     */
    public function testAddComment()
    {
        factory(Photo::class)->create();
        $photo = Photo::first();

        $content = 'sample content';

        $response = $this->withHeaders($this->headersWithToken)
            ->json('POST', route('photo.comment', [
                'photo' => $photo->id,
            ]), compact('content'));

        $comments = $photo->comments()->get();

        $response->assertStatus(201)
            // JSONフォーマットが期待通りであること
            ->assertJsonFragment([
                "author" => [
                    "name" => $this->user->name,
                ],
                "content" => $content,
            ]);

        // DBにコメントが1件登録されていること
        $this->assertEquals(1, $comments->count());
        // 内容がAPIでリクエストしたものであること
        $this->assertEquals($content, $comments[0]->content);
    }
}
