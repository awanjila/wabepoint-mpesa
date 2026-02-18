<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;


    
    class Category extends Model
{
    use HasFactory;
    // use NodeTrait;

    protected $table = 'categories';
    protected $fillable = [
        'category_name',
        'meta_title',
        'category_description',
        'slug',
        'category_image',
        'parent_id'
    ];

    protected $appends = ['image'];

    protected $hidden = []; // Remove any hidden attributes

    public function getImageAttribute()
    {
        if (!$this->category_image) {
            return asset('images/default-category.jpg');
        }
        return asset($this->category_image);
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class)->with(['attributes', 'products']);
    }//endmethod

    

    public function attributes()
    {
        return $this->hasManyThrough(Attribute::class, Subcategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // public function getRouteKeyName(){
    //     return 'slug';
    // }

    
    

    

}
