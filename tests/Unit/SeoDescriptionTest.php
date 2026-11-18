<?php

namespace Tests\Unit;

use App\Support\SeoDescription;
use Tests\TestCase;

class SeoDescriptionTest extends TestCase
{
    public function test_it_strips_tags_and_decodes_entities(): void
    {
        $this->assertSame(
            'Discover why most retail shops lose 5–15% of profit',
            SeoDescription::plain('<p data-start="506">Discover why most retail shops lose 5&ndash;15% of profit</p>')
        );
    }

    public function test_it_collapses_whitespace_and_trims(): void
    {
        $this->assertSame('Alpha beta', SeoDescription::plain("  <p>Alpha\n\n   beta </p>  "));
    }

    public function test_it_limits_length_and_handles_null(): void
    {
        $long = str_repeat('word ', 100);
        $this->assertSame('word word word word...', SeoDescription::plain($long, 20));
        $this->assertSame('', SeoDescription::plain(null));
    }
}
