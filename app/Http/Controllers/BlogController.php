<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Storage;
use Illuminate\Support\Str; // Make sure to include this at the top of your file
use Inertia\Inertia;
use Illuminate\Http\Request;

class BlogController extends Controller
{

//frontend

 public function ShowBlog($slug){

    //     $blog=blog::where('slug', $slug)->firstOrFail();
    //     $blog_posts = Blog::where('slug', '!=', $slug)->get();
    //     $blogcats = Category::get();
    // // $blogcategory=blogCategory::where('slug', $slug)->firstOrFail();

    //  // $post = Post::find($id);
    //     $previous = blog::where('slug', '<', $blog->slug)->max('slug');
    //     $next = blog::where('slug', '>', $blog->slug)->min('slug');
    // // return view( 'post', compact( 'post', 'next', 'previous' ));

    $blog = Blog::where('slug', $slug)->firstOrFail();
    $previous = Blog::where('id', '<', $blog->id)->orderBy('id', 'desc')->first();
    $next = Blog::where('id', '>', $blog->id)->orderBy('id', 'asc')->first();
    $blog_posts = Blog::where('id', '!=', $blog->id)->get();

    return view('frontend.blog.blog_details', compact('blog', 'previous', 'next', 'blog_posts'));



        // return view('frontend.blog.blog_details')->with('blog', $blog)->with('blog_posts', $blog_posts)->with('blogcats', $blogcats)->with('previous', $previous)->with('next', $next);

    }//endmethod

    public function IndexOfClientBlogs(){
        $blogs = Blog::with('category')->get();
        return view('frontend.blog.blogs')->with('blogs', $blogs);
    }//endmethod

    public function index()
    {
        $seo = [
            'title' => 'Blog - WabePoint POS & Inventory Management Tips',
            'description' => 'Stay updated with the latest POS and inventory management tips, business insights, and industry news from WabePoint.',
            'keywords' => 'pos blog, inventory tips, business management, retail insights, wabepoint blog',
        ];

        return Inertia::render('Blogs/Index', [ 
            'blogs' => Blog::latest()->get(),
            'seo' => $seo,
        ]);
    }//endmethod

    public function show($slug)
{
    $blog = Blog::with('category', 'user')->where('slug', $slug)->firstOrFail();

    $previous = Blog::where('id', '<', $blog->id)->orderBy('id', 'desc')->first();
    $next = Blog::where('id', '>', $blog->id)->orderBy('id', 'asc')->first();

    $seo = [
        'title' => $blog->title . ' - WabePoint Blog',
        'description' => Str::limit(strip_tags($blog->content), 160),
        'keywords' => $blog->category?->name . ', ' . Str::slug($blog->title),
        'canonical' => url()->current(),
        'type' => 'article',
    ];

    return Inertia::render('Blogs/Show', [
        'blog'       => $blog,
        'previous'   => $previous,
        'next'       => $next,
        'canLogin'   => true,
        'canRegister'=> true,
        'url'        => url()->current(),
        'blogPosts'  => Blog::latest()->take(6)->get(),
        'seo'        => $seo,
    ]);
}//endmethod



}
