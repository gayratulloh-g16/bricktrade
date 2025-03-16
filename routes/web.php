<?php

use Illuminate\Support\Facades\Route;
// admin routes
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\MainController as AdminMainController;
use App\Http\Controllers\Admin\BrickController as AdminBrickController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\ContactInfoController as AdminContactInfoController;
use App\Http\Controllers\Admin\DriverController as AdminDriverController;
use App\Http\Controllers\Admin\PartnerLogoController as AdminPartnerLogoController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;

// driver routes
use App\Http\Controllers\Driver\AuthController as DriverAuthController;
use App\Http\Controllers\Driver\MainController as DriverMainController;
use App\Http\Controllers\Driver\OrderController as DriverOrderController;

// Frontend Routes
use App\Http\Controllers\Frontend\MainController as FrontendMainController;
use App\Http\Controllers\Frontend\AuthController as FrontendAuthController;
use App\Http\Controllers\Frontend\ContactController as FrontendContactController;
use App\Http\Controllers\Frontend\CheckoutController as FrontendCheckoutController;
use App\Http\Controllers\Frontend\FeedbackController as FrontendFeedbackController;
use App\Models\Driver;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/brick/{brick}/review/store', [\App\Http\Controllers\Frontend\ReviewController::class, 'storeReview'])
    ->name('review.store');
Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [\App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::get('/cart', [\App\Http\Controllers\CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/update-single', [\App\Http\Controllers\CartController::class, 'updateSingle'])->name('cart.update.single');


Route::get('/login', [FrontendAuthController::class, 'showLoginForm'])->name('frontend.login');
Route::post('/login', [FrontendAuthController::class, 'login'])->name('frontend.login.submit');
Route::get('/register', [FrontendAuthController::class, 'showRegistrationForm'])->name('frontend.register');
Route::post('/register', [FrontendAuthController::class, 'register'])->name('frontend.register.submit');
Route::post('/logout', [FrontendAuthController::class, 'logout'])->name('frontend.logout');

Route::middleware('auth')->group(function () {
    Route::post('checkout/process', [FrontendCheckoutController::class, 'process'])->name('checkout.process');
    Route::get('order/confirmation/{order}', [FrontendCheckoutController::class, 'confirmation'])->name('order.confirmation');
    Route::get('orders', [FrontendCheckoutController::class, 'orders'])->name('orders');
    Route::get('order/{order}', [FrontendCheckoutController::class, 'orderDetail'])->name('order.detail');
    Route::get('profile', [FrontendAuthController::class, 'profile'])->name('frontend.profile');
    Route::put('profile/update', [FrontendAuthController::class, 'updateProfile'])->name('frontend.profile.update');
    Route::post('feedback', [FrontendFeedbackController::class, 'store'])->name('feedback.store');
});
Route::post('/orders/{id}/cancel', [FrontendCheckoutController::class, 'cancel'])->name('orders.cancel');


// User Routes
Route::get('/', [FrontendMainController::class, 'home'])->name('home');
Route::get('/about', [FrontendMainController::class, 'about'])->name('about');
Route::get('/shop', [FrontendMainController::class, 'shop'])->name('shop');
Route::get('/shop/{id}', [FrontendMainController::class, 'shopDetail'])->name('shop-detail');
Route::get('/blog', [FrontendMainController::class, 'blog'])->name('blog');
Route::get('/blog-detail/{id}', [FrontendMainController::class, 'blogDetail'])->name('blog-detail');
Route::get('/contact', [FrontendMainController::class, 'contact'])->name('contact');
Route::post('/contact/store', [FrontendContactController::class, 'storeContact'])->name('contact.store');
Route::get('/checkout', [FrontendMainController::class, 'checkout'])->name('checkout');



// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('/authenticate', [AdminAuthController::class, 'authenticate'])->name('admin.authenticate');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    // Protected Routes (Only for Admins)
    Route::middleware(['auth', 'admin'])->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminMainController::class, 'index'])->name('dashboard');
        Route::resource('blogs', AdminBlogController::class);
        Route::resource('bricks', AdminBrickController::class);
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('contacts', AdminContactController::class);
        Route::get('admin/contact-info', [AdminContactInfoController::class, 'index'])->name('contact-info.index');
        Route::put('admin/contact-info', [AdminContactInfoController::class, 'update'])->name('contact-info.update');
        Route::resource('drivers', AdminDriverController::class);
        Route::resource('partner-logos', AdminPartnerLogoController::class);
        Route::resource('comments', AdminCommentController::class);
        Route::resource('orders', AdminOrderController::class);
        Route::resource('feedback', AdminFeedbackController::class);
        Route::resource('reviews', AdminReviewController::class);
        Route::get('profile', [AdminMainController::class, 'profile'])->name('profile');
        Route::put('profile/update', [AdminMainController::class, 'updateProfile'])->name('profile.update');
        Route::resource('users', AdminUserController::class);
        Route::resource('companies', AdminCompanyController::class);
    });
});


// driver route 
Route::prefix('driver')->group(function () {
    Route::get('/login', [DriverAuthController::class, 'login'])->name('driver.login');
    Route::post('/authenticate', [DriverAuthController::class, 'authenticate'])->name('driver.authenticate');
    Route::post('/logout', [DriverAuthController::class, 'logout'])->name('driver.logout');
    // Protected Routes (Only for Drivers)
    Route::middleware(['auth', 'driver'])->name('driver.')->group(function () {
        Route::get('/dashboard', [DriverMainController::class, 'index'])->name('dashboard');
        Route::resource('orders', DriverOrderController::class);
        Route::post('orders/update-location', [DriverOrderController::class, 'updateLocation'])
         ->name('orders.updateLocation');

    });
});

Route::get('/sales/data', [AdminMainController::class, 'data'])->name('sales.data');
Route::get('customers/data', [AdminMainController::class, 'customerData'])->name('customers.data');
Route::get('reports/data', [AdminMainController::class, 'reportData'])->name('reports.data');
Route::get('sales/recent', [AdminMainController::class, 'recent'])->name('sales.recent');
Route::get('top-selling', [AdminMainController::class, 'topSelling'])->name('top-selling');
Route::get('news/recent', [AdminMainController::class, 'recentNews'])->name('news.recent');

Route::get('/driver-location/{driver_id}', function ($driver_id) {
    $driver = Driver::find($driver_id);
    return response()->json([
        'latitude' => $driver->latitude,
        'longitude' => $driver->longitude
    ]);
})->name('driver.location');


Route::get('/{lang}', function ($lang) {
    session(['lang' => $lang]);
    return back();
})->where('lang', 'en|ru|uz');
