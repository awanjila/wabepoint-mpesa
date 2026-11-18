<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendBlogToSubscribers;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category', 'user')->latest()->paginate(15);

        return Inertia::render('Admin/Blogs/Index', [
            'blogs' => $blogs,
        ]);
    }

    public function create()
    {
        $categories = Category::all();

        return Inertia::render('Admin/Blogs/Create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'keywords' => 'nullable|string|max:500',
            'blog_category_id' => 'nullable|exists:categories,id',
            'status' => 'boolean',
            'send_to_subscribers' => 'nullable|boolean',
        ]);

        $validated['slug'] = ($validated['slug'] ?? null) ?: Str::slug($validated['name']);

        if ($request->hasFile('image_file')) {
            $path = Storage::disk('public')->putFileAs(
                'blogs',
                $request->file('image_file'),
                $this->imageFilename(
                    $validated['slug'],
                    $validated['name'],
                    $request->file('image_file')->getClientOriginalExtension()
                )
            );
            $validated['image'] = 'storage/' . $path;
        }

        unset($validated['image_file']);

        $validated['user_id'] = auth()->id();

        $blog = Blog::create($validated);

        if ($blog->status && $request->boolean('send_to_subscribers')) {
            SendBlogToSubscribers::dispatch($blog);
        }

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();

        return Inertia::render('Admin/Blogs/Edit', [
            'blog' => $blog->load('category'),
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug,' . $blog->id,
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'keywords' => 'nullable|string|max:500',
            'blog_category_id' => 'nullable|exists:categories,id',
            'status' => 'boolean',
            'send_to_subscribers' => 'nullable|boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($request->hasFile('image_file')) {
            $path = Storage::disk('public')->putFileAs(
                'blogs',
                $request->file('image_file'),
                $this->imageFilename(
                    $validated['slug'],
                    $validated['name'],
                    $request->file('image_file')->getClientOriginalExtension()
                )
            );
            $validated['image'] = 'storage/' . $path;
        }

        unset($validated['image_file']);

        $blog->update($validated);

        if ($blog->status && $request->boolean('send_to_subscribers')) {
            SendBlogToSubscribers::dispatch($blog);
        }

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post deleted successfully.');
    }

    private function imageFilename(string $slug, string $name, string $extension): string
    {
        $safeSlug = trim(preg_replace('/[^A-Za-z0-9_-]/', '-', $slug), '-');

        return ($safeSlug ?: Str::slug($name)) . '.' . $extension;
    }
}
