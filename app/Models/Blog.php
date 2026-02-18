<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category(){

        return $this->belongsTo(Category::class, 'blog_category_id', 'id' );

    }//end of category method

    protected static function boot()
    {
        parent::boot();

        \DB::listen(function ($query) {
            \Log::info($query->sql);
            \Log::info($query->bindings);
            \Log::info($query->time);
        });


        static::creating(function ($m) {
            $m->slug = Str::slug($m->name); // Generate the slug from the title
        });
    }
}