<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for ('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home > Shop
Breadcrumbs::for ('blog', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__("Blog"), route('blog.index'));
});

// Home > Shop > [product]
Breadcrumbs::for ('blog.article', function (BreadcrumbTrail $trail, $title) {
    $trail->parent('blog');
    $trail->push($title);
});



// Home > Shop
Breadcrumbs::for ('shop', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__("Shop"), route('shop.index'));
});

// Home > Shop > [product]
Breadcrumbs::for ('shop.product', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('shop');
    $trail->push($product->title, route('shop.products.show', $product));
});

// Home > Shop > Cart
Breadcrumbs::for ('shop.cart', function (BreadcrumbTrail $trail) {
    $trail->parent('shop');
    $trail->push(__('Cart'), route('shop.cart.index'));
});
// Home > Shop > Checkout
Breadcrumbs::for ('shop.checkout', function (BreadcrumbTrail $trail) {
    $trail->parent('shop');
    $trail->push('Checkout', route('shop.checkout'));
});

// Home > Shop > Checkout
Breadcrumbs::for ('my-account', function (BreadcrumbTrail $trail, $title) {
    $trail->parent('home');
    $trail->push('My Account', route('my-account.index'));
    $trail->push($title);
});