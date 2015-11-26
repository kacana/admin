<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\models\Tag;

Route::pattern('id', '\d+');
Route::pattern('pid', '\d+');
Route::pattern('status', '[0-1]+');
Route::pattern('keyword', '[a-z0-9-]+');
Route::pattern('slug', '[a-zA-Z0-9-]+');

Route::pattern('envDomain', '(dev.|staging.|product.|)');
Route::pattern('nameDomain', '(kacana.com)');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@authLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/dashboard', 'WelcomeController@index');

/*********************************************************
 *
 *
 *                  ROUTE FOR ADMIN MODULE
 *
 *
 *
 *********************************************************/

Route::group(['domain'=>'admin.{envDomain}{nameDomain}','middleware' => 'auth'], function () {

    Route::any('/', 'Admin\IndexController@index');

    //product
    Route::any('/product',                                  array('as'=>'listProducts',             'uses'=>'Admin\ProductController@index'));
    Route::any('/product/getProduct',                       array('as'=>'getProducts',              'uses'=>'Admin\ProductController@getProduct'));
    Route::any('/product/createProduct',                    array('as'=>'createProduct',            'uses'=>'Admin\ProductController@createProduct'));
    Route::any('/product/editProduct/{id}',                 array('as'=>'editProduct',              'uses'=>'Admin\ProductController@editProduct'));
    Route::get('/product/removeProduct/{id}',               array('as'=>'removeProduct',            'uses'=>'Admin\ProductController@removeProduct'));
    Route::any('/product/uploadImageDescription',           array('as'=>'uploadImageDescription',   'uses'=>'Admin\ProductController@uploadImageDescription'));
    Route::any('/product/listTags/',                        array('as'=>'ProductTags',              'uses'=>'Admin\ProductController@listTags'));
    Route::get('/product/setStatus/{id}/{status}',          array('as'=>'setStatusProduct',         'uses'=>'Admin\ProductController@setStatus'));

    //branch
    Route::any('/product/branch',                           array('as'=>'listBranches',             'uses'=>'Admin\BranchController@index'));
    Route::any('/branch/getBranch',                         array('as'=>'getBranches',              'uses'=>'Admin\BranchController@getBranch'));
    Route::post('/branch/createBranch',                     array('as'=>'createBranch',             'uses'=>'Admin\BranchController@createBranch'));
    Route::get('/branch/showEditFormBranch/{id}',           array('as'=>'showEditFormBranch',       'uses'=>'Admin\BranchController@showEditFormBranch'));
    Route::post('/branch/editBranch',                       array('as'=>'editBranch',               'uses'=>'Admin\BranchController@editBranch'));
    Route::get('/branch/setStatusBranch/{id}/{status}',     array('as'=>'setStatusBranch',          'uses'=>'Admin\BranchController@setStatusBranch'));
    Route::get('/branch/removeBranch/{id}',                 array('as'=>'removeBranch',             'uses'=>'Admin\BranchController@removeBranch'));

    //tag
    Route::any('/product/tag',                              array('as'=>'listTags',                 'uses'=>'Admin\TagController@index'));
    Route::any('/tag/getTags/{pid}',                        array('as'=>'getTags',                  'uses'=>'Admin\TagController@getTags'));
    Route::any('/tag/getTagById',                           array('as'=>'getTagsById',              'uses'=>'Admin\TagController@getTagById'));
    Route::any('/tag/showFormCreate/{id}',                  array('as'=>'showCreateFormTag',        'uses'=>'Admin\TagController@showFormCreate'));
    Route::post('/tag/createTag',                           array('as'=>'createTag',                'uses'=>'Admin\TagController@createTag'));
    Route::get('/tag/showEditFormTag/{id}',                 array('as'=>'showEditFormTag',          'uses'=>'Admin\TagController@showEditFormTag'));
    Route::post('/tag/editTag',                             array('as'=>'editTag',                  'uses'=>'Admin\TagController@editTag'));
    Route::get('/tag/setStatusTag/{id}/{status}',           array('as'=>'setStatusTag',             'uses'=>'Admin\TagController@setStatusTag'));
    Route::get('/tag/setType/{id}/{type}',                  array('as'=>'setType',                  'uses'=>'Admin\TagController@setType'));
    Route::get('/tag/removeTag/{id}',                       array('as'=>'removeTag',                'uses'=>'Admin\TagController@removeTag'));

    //user
    Route::any('/user',                                     array('as'=>'listUsers',                 'uses'=>'Admin\UserController@index'));
    Route::any('/user/getUser',                             array('as'=>'getUsers',                  'uses'=>'Admin\UserController@getUser'));
    Route::post('/user/create',                             array('as'=>'createUser',                'uses'=>'Admin\UserController@create'));
    Route::any('/user/edit/{pid}',                          array('as'=>'editUser',                  'uses'=>'Admin\UserController@edit'));
    Route::get('/user/setStatus/{id}/{status}',             array('as'=>'setStatusUser',             'uses'=>'Admin\UserController@setStatus'));
    Route::get('/user/remove/{id}',                         array('as'=>'removeUser',                'uses'=>'Admin\UserController@destroy'));
    Route::get('/user/showCreateForm',                      array('as'=>'showCreateForm',            'uses'=>'Admin\UserController@showCreateForm'));
    Route::get('/user/getUserAddress/{id}',                 array('as'=>'listUserAddress',           'uses'=>'Admin\UserController@getUserAddress'));
    Route::get('/user/showFormEditUserAddress/{id}',        array('as'=>'showFormEditUserAddress',   'uses'=>'Admin\UserController@showFormEditUserAddress'));
    Route::post('/user/editUserAddress',                    array('as'=>'editUserAddress',           'uses'=>'Admin\UserController@editUserAddress'));
    Route::get('/user/showListWards/{id}',                  array('as'=>'showListWards',             'uses'=>'Admin\UserController@showListWards'));

    //Info request
    Route::any('/advisory',                                     array('as'=>'index',                 'uses'=>'Admin\AdvisoryController@index'));
    Route::any('/advisory/getAdvisory',                             array('as'=>'getAdvisory',                  'uses'=>'Admin\AdvisoryController@getAdvisory'));

    //Order Request
    Route::any('/order',                                     array('as'=>'listOrder',                 'uses'=>'Admin\OrderController@index'));
    Route::any('/order/getList',                             array('as'=>'getList',                  'uses'=>'Admin\OrderController@getList'));
    Route::any('/order/edit/{id}',                             array('as'=>'edit',                  'uses'=>'Admin\OrderController@edit'));



});

/*********************************************************
 *
 *
 *                  ROUTE FOR CLIENT MODULE
 *
 *
 *
 *********************************************************/

Route::group(['domain'=>'{envDomain}{nameDomain}', ], function () {
    Route::any('/', 'Client\IndexController@index');

    Route::group(['prefix' => 'requestInfo'], function() {
        Route::get('showPopupRequest/{id}',                 array('as'=>'showPopupRequest',  'uses'=>'Client\InfoRequestController@showPopupRequest'));
        Route::post('create',                               array('as'=>'createRequestInfo', 'uses'=>'Client\InfoRequestController@createItem'));
    });

    //product
    Route::group(['prefix'=>'san-pham'], function(){
        Route::get('{id}-{slug}.html',                      array('as'=>'productDetail',     'uses'=>'Client\ProductController@productDetail'));
    });
    Route::get('{id}-{slug}.html',                          array('as'=>'listProductByCate', 'uses'=>'Client\ProductController@listProductByCate'));
    Route::post('loadListProducts',                         array('as'=>'loadListProducts',  'uses'=>'Client\ProductController@loadListProducts'));
    Route::post('loadFilter',                               array('as'=>'filterProduct',     'uses'=>'Client\ProductController@filterProduct'));

    //cart
    Route::post('cart/addProductToCart',                    array('as'=>'addProductToCart',  'uses'=>'Client\CartController@addProductToCart'));
    Route::get('cart/showCart',                             array('as'=>'showCart',          'uses'=>'Client\CartController@showCart'));
    Route::get('cart/increaseQty/{pid}',                    array('as'=>'increaseQty',       'uses'=>'Client\CartController@increaseQty'));
    Route::get('cart/decreaseQty/{pid}',                    array('as'=>'decreaseQty',       'uses'=>'Client\CartController@decreaseQty'));
    Route::get('cart/removeCart/{pid}',                     array('as'=>'removeCart',        'uses'=>'Client\CartController@removeCart'));
    Route::get('cart/updateCart/{cid}/{qty}',               array('as'=>'updateCart',        'uses'=>'Client\CartController@updateCart'));
    Route::post('cart/processCart',                         array('as'=>'processCart',       'uses'=>'Client\CartController@processCart'));
    Route::get('cart/don-dat-hang/{id}',                    array('as'=>'orderDetail',       'uses'=>'Client\CartController@orderDetail'));
    Route::post('/cart/showListWards',                      array('as'=>'showListWards',     'uses'=>'Client\CartController@showListWards'));

});

View::composer('layouts.client.header', function($view){
    $view->with('menu_items', Tag::getTags());
});

View::composer('layouts.client.footer', function($view){
    $view->with('menu_items', Tag::getTags());
});

View::composer('client.product.sidebar', function($view){
    $segment = Request::segment(3);

    $view->with('links',Tag::getTags())->with('brands', \App\models\Branch::all())->with('colors', \App\models\Color::all())->with('url_tag',$segment);
});
