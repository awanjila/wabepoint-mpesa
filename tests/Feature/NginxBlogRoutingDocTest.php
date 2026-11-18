<?php

namespace Tests\Feature;

use Tests\TestCase;

class NginxBlogRoutingDocTest extends TestCase
{
    public function test_snippet_routes_blog_urls_directly_to_laravel(): void
    {
        $doc = file_get_contents(base_path('docs/deployment/nginx-blog-routing.md'));

        $this->assertStringNotContainsString('try_files $uri', $doc);
        $this->assertStringContainsString('rewrite ^ /index.php last;', $doc);
    }
}
