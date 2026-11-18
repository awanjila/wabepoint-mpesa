<?php

namespace App\Support;

use Illuminate\Support\Str;

class SeoDescription
{
    public static function plain(?string $value, int $limit = 160): string
    {
        $text = strip_tags((string) $value);
        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
        $text = preg_replace('/\s+/u', ' ', $text);

        return Str::limit(trim($text), $limit);
    }
}
