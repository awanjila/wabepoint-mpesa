<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'blog_category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($m) {
            if ($m->name && !$m->slug) {
                $m->slug = Str::slug($m->name);
            }
            if ($m->name && !$m->title) {
                $m->title = $m->name;
            }
        });

        static::updating(function ($m) {
            if ($m->isDirty('name') && !$m->isDirty('slug')) {
                $m->slug = Str::slug($m->name);
            }
        });
    }
}
