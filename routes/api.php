<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DriverController as AdminDriverController;
use App\Http\Controllers\Admin\PartnerLogoController as AdminPartnerLogoController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\BrickController as AdminBrickController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CompanyController as AdminCompanyController;


use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\ContactController as FrontendContactController;
use App\Http\Controllers\Telegram\TelegramController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('admin/categories/filter', [AdminCategoryController::class, 'filter'])->name('admin.categories.filter');
Route::get('admin/blogs/filter', [AdminBlogController::class, 'filter'])->name('admin.blogs.filter');
Route::get('admin/contacts/filter', [AdminContactController::class, 'filter'])->name('admin.contacts.filter');
Route::get('admin/drivers/filter', [AdminDriverController::class, 'filter'])->name('admin.drivers.filter');
Route::get('admin/partner-logos/filter', [AdminPartnerLogoController::class, 'filter'])->name('admin.partner-logos.filter');
Route::get('admin/comments/filter', [AdminCommentController::class, 'filter'])->name('admin.comments.filter');
Route::get('admin/bricks/filter', [AdminBrickController::class, 'filter'])->name('admin.bricks.filter');
Route::get('admin/orders/filter', [AdminOrderController::class, 'filter'])->name('admin.orders.filter');
Route::get('admin/feedback/filter', [AdminFeedbackController::class, 'filter'])->name('admin.feedback.filter');
Route::get('admin/reviews/filter', [AdminReviewController::class, 'filter'])->name('admin.reviews.filter');
Route::get('admin/users/filter', [AdminUserController::class, 'filter'])->name('admin.users.filter');
Route::get('admin/companies/filter', [AdminCompanyController::class, 'filter'])->name('admin.companies.filter');

Route::post('/blog/comment/store', [FrontendBlogController::class, 'storeComment'])->name('blog.comment.store');

// Telegram routes 
Route::post('/telegram/webhook', [TelegramController::class, 'handleCallback']);
