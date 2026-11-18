<?php

namespace Tests\Feature\Admin;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BlogImageFilenameTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_saves_uploaded_image_using_slug_from_name(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create());

        $response = $this->post(route('admin.blogs.store'), [
            'name' => 'One Screen, Real Numbers, No Guessing',
            'status' => false,
            'image_file' => UploadedFile::fake()->image('photo.PNG'),
        ]);

        $response->assertRedirect(route('admin.blogs.index'));
        Storage::disk('public')->assertExists('blogs/one-screen-real-numbers-no-guessing.PNG');
        $this->assertDatabaseHas('blogs', [
            'slug' => 'one-screen-real-numbers-no-guessing',
            'image' => 'storage/blogs/one-screen-real-numbers-no-guessing.PNG',
        ]);
        $this->assertSame(['blogs/one-screen-real-numbers-no-guessing.PNG'], Storage::disk('public')->files('blogs'));
    }

    public function test_update_saves_replacement_image_using_current_slug(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create());
        $blog = Blog::create([
            'name' => 'Old Title',
            'slug' => 'old-title',
            'user_id' => User::first()->id,
            'status' => false,
        ]);

        $response = $this->put(route('admin.blogs.update', $blog), [
            'name' => 'New Title',
            'slug' => 'new-title',
            'status' => false,
            'image_file' => UploadedFile::fake()->image('cover.jpeg'),
        ]);

        $response->assertRedirect(route('admin.blogs.index'));
        Storage::disk('public')->assertExists('blogs/new-title.jpeg');
        $this->assertDatabaseHas('blogs', [
            'id' => $blog->id,
            'image' => 'storage/blogs/new-title.jpeg',
        ]);
        $this->assertSame(['blogs/new-title.jpeg'], Storage::disk('public')->files('blogs'));
    }
}
