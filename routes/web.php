<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Models\Blog;
use App\Models\Category;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Landing', [
        'seo' => [
            'title' => 'WabePoint - Modern POS & Inventory Management System',
            'description' => 'WabePoint is a powerful cloud-based POS and inventory management system for businesses. Track sales, manage stock, generate invoices, and grow your business with real-time analytics.',
            'keywords' => 'pos system, inventory management, online pos, stock tracking, business management, sales analytics, wabepoint, point of sale kenya, mpesa integration',
            'canonical' => 'https://wabepoint.com',
        ],
    ]);
})->name('landing');

Route::get('/pricing', function () {
    return Inertia::render('Pricing', [
        'seo' => [
            'title' => 'Pricing - WabePoint POS & Inventory System | KES 2,000/mo',
            'description' => 'WabePoint pricing starts at KES 2,000/month with a KES 20,000 one-time setup. Complete POS, inventory, M-Pesa, and KRA eTIMS system for Kenyan businesses. No hidden fees.',
            'keywords' => 'wabepoint pricing, pos system cost kenya, pos monthly fee kenya, pos setup fee, inventory system price, point of sale pricing kenya, etims pos cost',
            'canonical' => 'https://wabepoint.com/pricing',
        ],
    ]);
})->name('pricing');

Route::get('/about', function () {
    return Inertia::render('About', [
        'seo' => [
            'title' => 'About Us - WabePoint POS & Inventory System',
            'description' => 'Learn about WabePoint and our mission to simplify business management for everyone.',
        ],
    ]);
})->name('about');

Route::get('/partners', function () {
    return Inertia::render('Partners', [
        'seo' => [
            'title' => 'Partners - WabePoint POS & Inventory System',
            'description' => 'Join the WabePoint partner network and grow your business together.',
        ],
    ]);
})->name('partners');

Route::get('/resources', function () {
    return Inertia::render('Resources', [
        'seo' => [
            'title' => 'Resources - WabePoint POS & Inventory System',
            'description' => 'Explore WabePoint guides, tutorials, and documentation to get the most out of your POS system.',
        ],
    ]);
})->name('resources');

Route::get('/paintshops', function () {
    return Inertia::render('Landing/PaintShopPOS', [
        'seo' => [
            'title' => 'Paint Shop POS System Kenya - WabePoint | Track Sales, Stock & M-Pesa',
            'description' => 'The #1 POS system built for paint shops in Kenya. Track sales, manage paint stock, handle M-Pesa & cash, and see daily profits. Works offline. Setup in 1 hour.',
            'keywords' => 'paint shop pos, paint shop management system kenya, paint inventory software, pos for paint shops nairobi, mpesa pos paint shop, paint shop stock management, glasurit pos, wabepoint paint shop, pos system mombasa, paint sales tracking',
            'canonical' => 'https://wabepoint.com/paintshops',
            'type' => 'website',
        ],
    ]);
})->name('paintshops');

Route::get('/cosmetics', function () {
    return Inertia::render('Landing/CosmeticsPOS', [
        'seo' => [
            'title' => 'Cosmetics POS System Kenya - WabePoint | Beauty Shop Management',
            'description' => 'POS system built for cosmetics and beauty shops in Kenya. Track products by shade and expiry, manage stock, handle M-Pesa, and see daily profits.',
            'canonical' => 'https://wabepoint.com/cosmetics',
        ],
    ]);
})->name('cosmetics');

Route::get('/hardware', function () {
    return Inertia::render('Landing/HardwarePOS', [
        'seo' => [
            'title' => 'Hardware POS System Kenya - WabePoint | Construction Store Management',
            'description' => 'POS system built for hardware stores in Kenya. Manage bulk stock, variant pricing, track sales, handle M-Pesa, and see daily profits.',
            'canonical' => 'https://wabepoint.com/hardware',
        ],
    ]);
})->name('hardware');

Route::get('/restaurants', function () {
    return Inertia::render('Landing/RestaurantsPOS', [
        'seo' => [
            'title' => 'Restaurant POS System Kenya - WabePoint | Food Service Management',
            'description' => 'POS system built for restaurants in Kenya. Menu management, table orders, kitchen receipts, M-Pesa payments, and daily sales reports.',
            'canonical' => 'https://wabepoint.com/restaurants',
        ],
    ]);
})->name('restaurants');

Route::get('/offices', function () {
    return Inertia::render('Landing/OfficesPOS', [
        'seo' => [
            'title' => 'Office Invoice System Kenya - WabePoint | Business Expense Management',
            'description' => 'Invoicing and expense tracking system for offices in Kenya. Generate professional invoices, track POs, manage expenses, and reconcile payments.',
            'canonical' => 'https://wabepoint.com/offices',
        ],
    ]);
})->name('offices');


Route::get('/point-of-sale-system-kenya', function () {
    return Inertia::render('Services', [
        'seo' => [
            'title' => 'Point of Sale System Kenya - WabePoint POS Services | eTIMS, M-Pesa, Invoicing',
            'description' => 'WabePoint offers KRA eTIMS integration, M-Pesa Paybill, quotation & invoicing, expense tracking, and debtors & creditors management — all in one POS system for Kenyan businesses.',
            'keywords' => 'point of sale system kenya, pos kenya, etims integration, mpesa paybill, invoicing software, expense tracking, debtors tracking, creditors management, pos system nairobi',
            'canonical' => 'https://wabepoint.com/point-of-sale-system-kenya',
        ],
    ]);
})->name('services');

Route::get('/success-stories', function () {
    $category = Category::where('slug', 'customer-stories')->orWhere('category_name', 'Customer Stories')->first();
    $stories = collect();
    if ($category) {
        $stories = Blog::with('category')
            ->where('blog_category_id', $category->id)
            ->latest()
            ->get()
            ->map(fn($blog) => [
                'id' => $blog->id,
                'name' => $blog->name,
                'slug' => $blog->slug,
                'description' => $blog->description,
                'content' => $blog->content,
                'image' => $blog->image,
                'created_at' => $blog->created_at,
            ]);
    }

    return Inertia::render('SuccessStories', [
        'stories' => $stories,
        'seo' => [
            'title' => 'Success Stories - WabePoint POS',
            'description' => 'See how businesses across Kenya are growing with WabePoint POS system.',
        ],
    ]);
})->name('success-stories');

Route::get('/support', function () {
    return Inertia::render('Support', [
        'seo' => [
            'title' => 'Support - WabePoint POS',
            'description' => 'Get help with WabePoint POS system. Contact our support team.',
        ],
    ]);
})->name('support');

Route::controller(BlogController::class)->group(function(){

    ///frontend///
    Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');
    Route::get('news', [BlogController::class, 'index'])->name('blogs.index');

   });

// Admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class);
});

