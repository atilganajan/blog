<?php

use App\Http\Requests\CreatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class BlogControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testStoreMethod()
    {
        Category::create([
            'name' => "Technology",
        ]);

        $user = User::create([
            "name" => "test User",
            "email" => "testUser@gmail.com",
            "password" => Hash::make('password'),
        ]);

        Auth::login($user);

        $imageFile = UploadedFile::fake()->image('test_image.png');

        $requestData = [
            'title' => 'Test Post Title',
            'content' => 'Test Post Content',
            'image' => $imageFile,
            'category' => 'Technology',
        ];

        CreatePostRequest::create(route('create'), 'POST', $requestData);

        $response = $this->post(route('create'), $requestData);

        $response->assertRedirect("verify-email");

        $user->email_verified_at = now();
        $user->save();

        CreatePostRequest::create(route('create'), 'POST', $requestData);

        $response = $this->post(route('create'), $requestData);

        $response->assertRedirect(route('home'));

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post Title',
            'content' => 'Test Post Content',
        ]);

        $response->assertSessionHas('success', 'Post created successfully');

        $post = Post::where([
            'title' => 'Test Post Title',
            'content' => 'Test Post Content',
        ])->first();

        $imageFileName = $post->image;

        $this->assertTrue(file_exists($imageFileName));
    }

    public function testUpdateMethod()
    {
        $category = Category::create([
            'name' => "Technology",
        ]);

        $user = User::create([
            "name" => "test User1",
            "email" => "testUser1@gmail.com",
            "password" => Hash::make('password'),
            "email_verified_at" => now()
        ]);



        Auth::login($user);

        $imageFile = UploadedFile::fake()->image('test_image.png');

        $requestData = [
            'title' => 'Test Post Title',
            'content' => 'Test Post Content',
            'image' => $imageFile,
            'category' => 'Technology',
        ];

        CreatePostRequest::create(route('create'), 'POST', $requestData);

        $response = $this->post(route('create'), $requestData);

        $response->assertRedirect(route('home'));

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post Title',
            'content' => 'Test Post Content',
        ]);


        $post = Post::where([
            'title' => 'Test Post Title',
            'content' => 'Test Post Content',
        ])->first();


        $this->assertNotNull($post);


        $response = $this->get(route('edit', ["slug" => $post->slug]));

        $response->assertViewIs('pages.edit');

        $imageFileChange = UploadedFile::fake()->image('test_image_change.png');

        $requestUpdateData = [
            'title' => 'Test Post Title change',
            'content' => 'Test Post Content change',
            'image' => $imageFileChange,
            'category' => 'Technology',
            'slug'=>$post->slug,
            "change_image"=>true
        ];


        $response = $this->put(route('update'), $requestUpdateData);

        $response->assertSessionHas('success', 'Post updated successfully');

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post Title change',
            'content' => 'Test Post Content change',
        ]);

        $post = Post::where([
            'title' => 'Test Post Title change',
            'content' => 'Test Post Content change',
        ])->first();

        $imageFileName = $post->image;

        $this->assertTrue(file_exists($imageFileName));

    }

}
