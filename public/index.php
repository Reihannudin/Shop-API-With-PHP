<?php

use Bulletproof\Crud\app\config\Route;
use Bulletproof\Crud\controllers\AddressController;
use Bulletproof\Crud\controllers\CartController;
use Bulletproof\Crud\controllers\CategoryController;
use Bulletproof\Crud\controllers\ImageProductController;
use Bulletproof\Crud\controllers\OrderController;
use Bulletproof\Crud\controllers\ProductController;
use Bulletproof\Crud\controllers\ShopController;
use Bulletproof\Crud\controllers\UserController;
use Bulletproof\Crud\controllers\VoucherController;
use Bulletproof\Crud\controllers\WishlistController;

require_once __DIR__ . '/../app/config/Database.php';
require_once __DIR__ . '/../app/config/Route.php';
require_once __DIR__ . '/../app/controllers/AddressController.php';
require_once __DIR__ . '/../app/controllers/CartController.php';
require_once __DIR__ . '/../app/controllers/CategoryController.php';
require_once __DIR__ . '/../app/controllers/ImageProductController.php';
require_once __DIR__ . '/../app/controllers/OrderController.php';
require_once __DIR__ . '/../app/controllers/ProductController.php';
require_once __DIR__ . '/../app/controllers/ShopController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/controllers/VoucherController.php';
require_once __DIR__ . '/../app/controllers/WishlistController.php';


// LOGIC
//Address
Route::add('GET' , '/api/address' , AddressController::class , 'all');
Route::add('GET' , '/api/address/([0-9a-zA-Z]*)' , AddressController::class , 'show');
Route::add('POST' , '/api/logic/create/address' , AddressController::class , 'create');
Route::add('POST' , '/api/logic/update/address/([0-9a-zA-Z]*)' , AddressController::class , 'update');
Route::add('POST' , '/api/logic/delete/address/([0-9a-zA-Z]*)' , AddressController::class , 'delete');

//Cart
Route::add('GET' , '/api/carts' , CartController::class , 'all');
Route::add('POST' , '/api/logic/add/cart' , CartController::class , 'add');
Route::add('POST' , '/api/logic/update/cart/([0-9a-zA-Z]*)' , CartController::class , 'update');
Route::add('POST' , '/api/logic/delete/cart/([0-9a-zA-Z]*)' , CartController::class , 'delete');

//Category
Route::add('GET' , '/api/categories' , CategoryController::class , 'all');
Route::add('GET' , '/api/category/([0-9a-zA-Z]*)' , CategoryController::class , 'show');
Route::add('POST' , '/api/logic/create/category' , CategoryController::class , 'create');
Route::add('POST' , '/api/logic/update/category/([0-9a-zA-Z]*)' , CategoryController::class , 'update');
Route::add('POST' , '/api/logic/delete/category/([0-9a-zA-Z]*)' , CategoryController::class , 'delete');

//ImageProduct
Route::add('GET' , '/api/image-products' , ImageProductController::class , 'all');
Route::add('GET' , '/api/image-product/([0-9a-zA-Z]*)' , ImageProductController::class , 'show');
Route::add('POST' , '/api/logic/create/image-product' , ImageProductController::class , 'create');
Route::add('POST' , '/api/logic/update/image-product/([0-9a-zA-Z]*)' , ImageProductController::class , 'update');
Route::add('POST' , '/api/logic/delete/image-product/([0-9a-zA-Z]*)' , ImageProductController::class , 'delete');

//Order
Route::add('GET' , '/api/history/orders' , OrderController::class , 'all');
Route::add('GET' , '/api/show/order' , OrderController::class , 'show');
Route::add('POST' , '/api/logic/order' , OrderController::class , 'order');

//Product
Route::add('GET' , '/api/products' , ProductController::class , 'all');
Route::add('GET' , '/api/product/([0-9a-zA-Z]*)' , ProductController::class , 'show');
Route::add('POST' , '/api/logic/create/product' , ProductController::class , 'create');
Route::add('POST' , '/api/logic/update/product/([0-9a-zA-Z]*)' , ProductController::class , 'update');
Route::add('POST' , '/api/logic/delete/product/([0-9a-zA-Z]*)' , ProductController::class , 'delete');

//Shop
Route::add('GET' , '/api/shops' , ShopController::class , 'all');
Route::add('GET' , '/api/shop/([0-9a-zA-Z]*)' , ShopController::class , 'show');
Route::add('GET' , '/api/my-shop' , ShopController::class , 'myShop');
Route::add('POST' , '/api/logic/create/shop' , ShopController::class , 'create');
Route::add('POST' , '/api/logic/update/shop' , ShopController::class , 'update');

//User
Route::add('GET' , '/api/user' , UserController::class , 'show');
Route::add('POST' , '/api/logic/login' , UserController::class , 'login');
Route::add('POST' , '/api/logic/register' , UserController::class , 'register');
Route::add('POST' , '/api/logic/logout' , UserController::class , 'logout');
Route::add('POST' , '/api/logic/user/update' , UserController::class , 'update');
Route::add('POST' , '/api/logic/user/topup' , UserController::class , 'topup');

//Voucher
Route::add('GET' , '/api/vouchers' , VoucherController::class , 'all');
Route::add('GET' , '/api/voucher/([0-9a-zA-Z]*)' , VoucherController::class , 'show');
Route::add('POST' , '/api/logic/create/voucher' , VoucherController::class , 'create');
Route::add('POST' , '/api/logic/update/voucher/([0-9a-zA-Z]*)' , VoucherController::class , 'update');
Route::add('POST' , '/api/logic/delete/voucher/([0-9a-zA-Z]*)' , VoucherController::class , 'delete');

//Wishlist
Route::add('GET' , '/api/wishlists' , WishlistController::class , 'all');
Route::add('POST' , '/api/logic/add/wishlist' , WishlistController::class , 'add');
Route::add('POST' , '/api/logic/delete/wishlist/([0-9a-zA-Z]*)' , WishlistController::class , 'delete');



Route::run();




















//// VIEW
////Address
//Route::add('GET' , '/address/([0-9a-zA-Z]*)' , AddressController::class , 'show');
//Route::add('GET' , '/address' , AddressController::class , 'all');
//
////Cart
//
////Category
//Route::add('GET' , '/category/([0-9a-zA-Z]*)' , CategoryController::class , 'show');
//Route::add('GET' , '/categories' , CategoryController::class , 'all');
//
////ImageProduct
//Route::add('GET' , '/image-product/([0-9a-zA-Z]*)' , ImageProductController::class , 'show');
//Route::add('GET' , '/image-products' , ImageProductController::class , 'all');
//
////Order
////Product
//Route::add('GET' , '/create/product' , ProductController::class , 'create');
//Route::add('GET' , '/update/product/([0-9a-zA-Z]*)' , ProductController::class , 'update');
//Route::add('GET' , '/product/([0-9a-zA-Z]*)' , ProductController::class , 'show');
//Route::add('GET' , '/products' , ProductController::class , 'all');
//
////Shop
////User
//Route::add('GET' , '/login' , UserController::class , 'loginV');
//Route::add('GET' , '/register' , UserController::class , 'registerV');
//Route::add('GET' , '/profile' , UserController::class , 'show');
//
////Voucher
////Wishlist
