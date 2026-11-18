<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DynamicBlogPagesTest extends TestCase
{
    use RefreshDatabase;

    private function makeBlogs(User $user, int $count): void
    {
        for ($i = 1; $i <= $count; $i++) {
            Blog::create([
                'name' => "Post $i",
                'slug' => "post-$i",
                'user_id' => $user->id,
                'description' => "<p>Body for Post $i</p>",
                'created_at' => now()->subDays($count - $i),
            ]);
        }
    }

    private function inertiaHeaders(): array
    {
        return [
            'X-Inertia' => 'true',
            'X-Inertia-Version' => md5_file(public_path('build/manifest.json')),
        ];
    }

    public function test_normal_index_renders_six_newest_posts_as_html(): void
    {
        $this->makeBlogs(User::factory()->create(), 7);
        $this->get('/pos-systems-in-kenya-news')
            ->assertOk()
            ->assertViewIs('blogs.index')
            ->assertSee('Post 7')
            ->assertSee('Post 2')
            ->assertDontSee('Post 1');
    }

    public function test_index_pagination_uses_page_query(): void
    {
        $this->makeBlogs(User::factory()->create(), 7);
        $this->get('/pos-systems-in-kenya-news?page=2')
            ->assertOk()
            ->assertSee('Post 1')
            ->assertDontSee('Post 7');
        $this->get('/pos-systems-in-kenya-news?page=999')->assertOk();
        $this->get('/pos-systems-in-kenya-news?page=abc')->assertOk();
    }

    public function test_normal_detail_renders_trusted_body_html_and_plain_meta(): void
    {
        $user = User::factory()->create();
        $blog = Blog::create([
            'name' => 'Retail Profits',
            'slug' => 'retail-profits',
            'user_id' => $user->id,
            'description' => '<p>Unique body sentence with <strong>markup</strong>.</p>',
            'meta_description' => '<p data-start="506">Discover 5&ndash;15% &amp; more.</p>',
        ]);

        $this->get('/blogs/'.$blog->slug)
            ->assertOk()
            ->assertViewIs('blogs.show')
            ->assertSee('<p>Unique body sentence with <strong>markup</strong>.</p>', false)
            ->assertSee('content="Discover 5–15% &amp; more."', false)
            ->assertDontSee('<p data-start', false);
    }

    public function test_new_clothing_store_slug_renders_and_unknown_slug_404s(): void
    {
        $user = User::factory()->create();
        Blog::create([
            'name' => 'POS Software for Clothing Stores in Kenya',
            'slug' => 'pos-software-for-clothing-stores-in-kenya',
            'user_id' => $user->id,
            'description' => '<p>Clothing store content.</p>',
        ]);

        $this->get('/blogs/pos-software-for-clothing-stores-in-kenya')
            ->assertOk()
            ->assertSee('POS Software for Clothing Stores in Kenya');
        $this->get('/blogs/this-slug-does-not-exist-test-12345')->assertNotFound();
    }

    public function test_blade_pages_keep_header_footer_links_and_load_only_built_css(): void
    {
        $user = User::factory()->create();
        $blog = Blog::create([
            'name' => 'Header Check',
            'slug' => 'header-check',
            'user_id' => $user->id,
        ]);
        $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        $css = '/build/'.$manifest['resources/js/app.js']['css'][0];

        $this->get('/blogs/'.$blog->slug)
            ->assertOk()
            ->assertSee('tel:+254781312070')
            ->assertSee('+254 781 312 070')
            ->assertSee('/pos-systems-in-kenya-news')
            ->assertSee($css, false)
            ->assertDontSee('src="/build/assets/', false);
    }

    public function test_mobile_menu_panel_is_positioned_against_the_nav_not_the_hamburger(): void
    {
        $this->get('/pos-systems-in-kenya-news')
            ->assertOk()
            ->assertDontSee('<details class="md:hidden relative">', false)
            ->assertSee('class="absolute top-full left-0 right-0 bg-white border-t border-gray-200 shadow-lg"', false);
    }

    public function test_blog_pages_render_header_and_footer_when_industries_config_is_null(): void
    {
        $user = User::factory()->create();
        $blog = Blog::create([
            'name' => 'Cached Config Post',
            'slug' => 'cached-config-post',
            'user_id' => $user->id,
            'description' => '<p>Cached config body.</p>',
        ]);

        config(['industries' => null]);

        foreach (['/pos-systems-in-kenya-news', '/blogs/'.$blog->slug] as $path) {
            $this->get($path)
                ->assertOk()
                ->assertSee('ALL-IN-ONE POS SYSTEM')
                ->assertSee('/pos-system-cosmetics-kenya', false)
                ->assertSee('/pos-system-lpg-gas-kenya', false)
                ->assertSee('/pos-system-boutique-fashion-kenya', false)
                ->assertSee('<footer', false)
                ->assertSee('All rights reserved.');
        }
    }

    public function test_no_stale_blog_snapshots_in_public_and_all_static_html_assets_exist(): void
    {
        $this->assertDirectoryDoesNotExist(public_path('pos-systems-in-kenya-news'));
        $this->assertDirectoryDoesNotExist(public_path('blogs'));

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(public_path(), \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if ($file->getFilename() !== 'index.html') {
                continue;
            }

            $html = file_get_contents($file->getPathname());
            preg_match_all('#(?:href|src)="(/build/assets/[^"]+)"#', $html, $matches);
            $this->assertNotEmpty($matches[1], "Expected build asset references in {$file->getPathname()}");

            foreach ($matches[1] as $assetUrl) {
                $this->assertFileExists(
                    public_path(ltrim($assetUrl, '/')),
                    "Missing asset {$assetUrl} referenced by {$file->getPathname()}"
                );
            }
        }
    }

    public function test_blog_detail_includes_unscoped_blog_content_and_quill_list_css(): void
    {
        $user = User::factory()->create();
        $blog = Blog::create([
            'name' => 'Styled Blog Post',
            'slug' => 'styled-blog-post',
            'user_id' => $user->id,
            'description' => '<h2>Heading</h2><ol><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span>Bullet item</li></ol>',
        ]);

        $this->get('/blogs/'.$blog->slug)
            ->assertOk()
            ->assertSee('.blog-content li[data-list="bullet"]', false)
            ->assertSee('.blog-content h2', false)
            ->assertSee('<nav', false)
            ->assertSee('<footer', false);
    }

    public function test_inertia_visits_still_return_vue_pages(): void
    {
        $user = User::factory()->create();
        $blog = Blog::create([
            'name' => 'Inertia Post',
            'slug' => 'inertia-post',
            'user_id' => $user->id,
        ]);

        $this->get('/pos-systems-in-kenya-news', $this->inertiaHeaders())
            ->assertOk()
            ->assertHeader('X-Inertia', 'true')
            ->assertJsonPath('component', 'Blogs/Index');
        $this->get('/blogs/'.$blog->slug, $this->inertiaHeaders())
            ->assertOk()
            ->assertHeader('X-Inertia', 'true')
            ->assertJsonPath('component', 'Blogs/Show');
    }
}
