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

Route::pattern('id', '[0-9]+');
Route::pattern('pid', '[0-9]+');
Route::pattern('status', '[0-1]+');
Route::pattern('keyword', '[a-z0-9-]+');

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

});

/*********************************************************
 *
 *
 *                  ROUTE FOR CLIENT MODULE
 *
 *
 *
 *********************************************************/

Route::group(['domain'=>'{envDomain}{nameDomain}'], function () {
    Route::any('/', 'Client\IndexController@index');

});

View::composer('layouts.client.header', function($view){
    $view->with('menu_items', Tag::getTags());
});
