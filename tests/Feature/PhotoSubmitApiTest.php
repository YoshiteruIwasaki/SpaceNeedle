<?php

namespace Tests\Feature;

use App\Photo;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\PassportTestCase;
use Illuminate\Support\Facades\Log;

class PhotoSubmitApiTest extends PassportTestCase
{
    /**
     * @test
     */
    public function testPhotoUpload()
    {
        Storage::fake('avatars');
        $uploadedFile = UploadedFile::fake()->image('photo.jpg');
        $response = $this->withHeaders($this->headersWithToken)
              ->json('POST', route('photo.create'), [
        // ダミーファイルを作成して送信している
                 'photo' => $uploadedFile,
               ]);

        //Log::error($response->json());

        // レスポンスが201(CREATED)であること
        $response->assertStatus(201);
    }
}
