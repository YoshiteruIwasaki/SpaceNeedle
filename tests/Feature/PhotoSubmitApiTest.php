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
        // S3ではなくテスト用のストレージを使用する
        // → storage/framework/testing
        Storage::fake('avatars');

        $response = $this->withHeaders($this->headersWithToken)
              ->json('POST', route('photo.create'), [
        // ダミーファイルを作成して送信している
                 'photo' => UploadedFile::fake()->image('photo.jpg'),
               ]);

        //Log::error($response->json());

        // レスポンスが201(CREATED)であること
        $response->assertStatus(201);

        $photo = Photo::first();

        // DBに挿入されたファイル名のファイルがストレージに保存されていること
        Storage::disk('local')->assertExists($photo->filename);
    }
}
