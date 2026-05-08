<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetReminderController;
use App\Http\Controllers\WishlistController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// HOME
Route::get('/', [HomeController::class, 'index'])->name('home');

// DASHBOARD REDIRECT
Route::get('/dashboard', function () {
    return redirect('/admin');
})->middleware(['auth'])->name('dashboard');

// PROFILE
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

// CART
Route::get('/cart', [CartController::class, 'index']);

Route::post('/add-to-cart/{id}', [CartController::class, 'add']);

Route::post('/remove-from-cart/{id}', [CartController::class, 'remove']);

Route::post('/update-cart/{id}', [CartController::class, 'update']);

// PRODUCTS
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

// STATIC
Route::view('/about', 'about');

// CONTACT
Route::get('/contact', fn () => view('contact'))->name('contact');

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// FEEDBACK
Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');

Route::post('/feedback', [FeedbackController::class, 'submit'])->name('feedback.submit');

// CHECKOUT
Route::middleware('auth')->group(function () {

    Route::get('/checkout', [CheckoutController::class, 'index']);

    Route::post('/checkout', [CheckoutController::class, 'store']);

});

// PAYMENT
Route::get('/payment', [PaymentController::class, 'pay']);

Route::post('/payment/verify', [PaymentController::class, 'verify']);

// ORDER SUCCESS
Route::get('/order-success', function () {

    $order = \App\Models\Order::find(session('order_id'));

    session()->forget('cart');

    return view('order-success', compact('order'));

});

// USER ORDERS
Route::get('/orders', [OrderController::class, 'index'])->middleware('auth');

// TRACK ORDER
Route::get('/track', [OrderController::class, 'trackPage']);

Route::post('/track', [OrderController::class, 'trackOrder']);

// RETRY PAYMENT
Route::get('/retry-payment/{id}', [PaymentController::class, 'retry']);


// ================= USER PET REMINDERS =================
Route::middleware('auth')->group(function () {

    Route::get('/pet-reminders', [PetReminderController::class, 'index']);

    Route::post('/pet-reminders/store', [PetReminderController::class, 'store']);

    Route::get('/pet-reminders/complete/{id}', [PetReminderController::class, 'complete']);

});
// ================= WISHLIST =================
Route::middleware('auth')->group(function () {

    Route::get('/wishlist', [WishlistController::class, 'index']);

    Route::post('/wishlist/add/{id}', [WishlistController::class, 'add']);

    Route::post('/wishlist/remove/{id}', [WishlistController::class, 'remove']);

});

// ================= ADMIN =================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // DASHBOARD
    Route::get('/', [AdminController::class, 'dashboard']);

    // USERS
    Route::get('/users', [AdminController::class, 'users']);

    // PRODUCTS
    Route::get('/products', [AdminController::class, 'products']);

    // CONTACTS
    Route::get('/contacts', [AdminController::class, 'contacts']);

    // FEEDBACKS
    Route::get('/feedbacks', [AdminController::class, 'feedbacks']);

    // ORDERS
    Route::get('/orders', [AdminController::class, 'orders']);

    Route::get('/orders/{id}', [AdminController::class, 'orderDetail']);

    Route::post('/orders/{id}', [AdminController::class, 'updateOrder']);

    // DELIVERY
    Route::get('/delivery', [AdminController::class, 'delivery']);

    Route::post('/delivery/{id}', [AdminController::class, 'updateDelivery']);

    // PRODUCT CRUD
    Route::get('/products/create', [AdminController::class, 'createProduct']);

    Route::post('/products/store', [AdminController::class, 'storeProduct']);

    Route::get('/products/edit/{id}', [AdminController::class, 'editProduct']);

    Route::post('/products/update/{id}', [AdminController::class, 'updateProduct']);

    Route::post('/products/delete/{id}', [AdminController::class, 'deleteProduct']);

    

    // VIEW ORDER
    Route::get('/order/view/{id}', [AdminController::class, 'viewOrder']);

    // NOTIFICATIONS
    Route::get('/notifications', [AdminController::class, 'notifications']);

    // 🐾 ADMIN PET REMINDERS
    Route::get('/pet-reminders', [AdminController::class, 'petReminders']);

});

require __DIR__.'/auth.php';