<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogSeoInertiaTest extends TestCase
{
    use RefreshDatabase;

    private function inertiaHeaders(): array
    {
        return [
            'X-Inertia' => 'true',
            'X-Inertia-Version' => md5_file(public_path('build/manifest.json')),
        ];
    }

    public function test_inertia_detail_description_is_plain_text(): void
    {
        $user = User::factory()->create();
        $blog = Blog::create([
            'name' => 'Retail Profits',
            'slug' => 'retail-profits',
            'user_id' => $user->id,
            'meta_description' => '<p data-start="506">Discover why most retail shops lose 5&ndash;15% of profit.</p>',
        ]);

        $this->get('/blogs/'.$blog->slug, $this->inertiaHeaders())
            ->assertOk()
            ->assertHeader('X-Inertia', 'true')
            ->assertJsonPath('component', 'Blogs/Show')
            ->assertJsonPath('props.seo.description', 'Discover why most retail shops lose 5–15% of profit.');
    }

    public function test_inertia_detail_description_falls_back_to_plain_content(): void
    {
        $user = User::factory()->create();
        $blog = Blog::create([
            'name' => 'Fallback Post',
            'slug' => 'fallback-post',
            'user_id' => $user->id,
            'content' => '<p>  Plain   fallback <strong>text</strong>. </p>',
        ]);

        $this->get('/blogs/'.$blog->slug, $this->inertiaHeaders())
            ->assertOk()
            ->assertHeader('X-Inertia', 'true')
            ->assertJsonPath('component', 'Blogs/Show')
            ->assertJsonPath('props.seo.description', 'Plain fallback text.');
    }
}
