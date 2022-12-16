<?php

// category

uri('admin/category', 'Admin\Category', 'index');
uri('admin/category/create', 'Admin\Category', 'create');
uri('admin/category/store', 'Admin\Category', 'store', 'POST');
uri('admin/category/edit/{id}', 'Admin\Category', 'edit');
uri('admin/category/update/{id}', 'Admin\Category', 'update', 'POST');
uri('admin/category/delete/{id}', 'Admin\Category', 'delete');

// posts

uri('admin/post', 'Admin\Post', 'index');
uri('admin/post/create', 'Admin\Post', 'create');
uri('admin/post/store', 'Admin\Post', 'store', 'POST');
uri('admin/post/edit/{id}', 'Admin\Post', 'edit');
uri('admin/post/update/{id}', 'Admin\Post', 'update', 'POST');
uri('admin/post/delete/{id}', 'Admin\Post', 'delete');
uri('admin/post/selected/{id}', 'Admin\Post', 'selected');
uri('admin/post/breaking-news/{id}', 'Admin\Post', 'breakingNews');

// banners

uri('admin/banner', 'Admin\Banner', 'index');
uri('admin/banner/create', 'Admin\Banner', 'create');
uri('admin/banner/store', 'Admin\Banner', 'store', 'POST');
uri('admin/banner/edit/{id}', 'Admin\Banner', 'edit');
uri('admin/banner/update/{id}', 'Admin\Banner', 'update', 'POST');
uri('admin/banner/delete/{id}', 'Admin\Banner', 'delete');

// users

uri('admin/user', 'Admin\User', 'index');
uri('admin/user/edit/{id}', 'Admin\User', 'edit');
uri('admin/user/update/{id}', 'Admin\User', 'update', 'POST');
uri('admin/user/delete/{id}', 'Admin\User', 'delete');
uri('admin/user/permission/{id}', 'Admin\User', 'permission');

//comments
uri('admin/comment', 'Admin\Comment', 'index');
uri('admin/comment/change-status/{id}', 'Admin\Comment', 'changeStatus');

// menu

uri('admin/menu', 'Admin\Menu', 'index');
uri('admin/menu/create', 'Admin\Menu', 'create');
uri('admin/menu/store', 'Admin\Menu', 'store', 'POST');
uri('admin/menu/edit/{id}', 'Admin\Menu', 'edit');
uri('admin/menu/update/{id}', 'Admin\Menu', 'update', 'POST');
uri('admin/menu/delete/{id}', 'Admin\Menu', 'delete');

//websetting
uri('admin/websetting', 'Admin\Websetting', 'index');
uri('admin/websetting/edit', 'Admin\Websetting', 'edit');
uri('admin/websetting/update', 'Admin\Websetting', 'update', 'POST');

//Auth
uri('register', 'Auth\Auth', 'register');
uri('register/store', 'Auth\Auth', 'registerStore', 'POST');
uri('activation/{verify_token}', 'Auth\Auth', 'activation');
uri('login', 'Auth\Auth', 'login');
uri('check-login', 'Auth\Auth', 'checkLogin', 'POST');
uri('logout', 'Auth\Auth', 'logout');
uri('forgot', 'Auth\Auth', 'forgot');
uri('forgot/request', 'Auth\Auth', 'forgotRequest', 'POST');
uri('reset-password-form/{forgot_token}', 'Auth\Auth', 'resetPasswordView');
uri('reset-password/{forgot_token}', 'Auth\Auth', 'resetPassword', "POST");

//app

uri('/', 'App\Home', 'index');
uri('/home', 'App\Home', 'index');
uri('/show-post/{id}', 'App\Home', 'show');
uri('/show-category/{id}', 'App\Home', 'category');
uri('/comment-store/{post_id}', 'App\Home', 'commentStore', 'POST');

echo '404 - page not found';
