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

Route::pattern('id', '[0-9]+');
Route::pattern('status', '[0-1]+');
Route::pattern('keyword', '[a-z0-9-]+');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@authLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/dashboard', 'WelcomeController@index');
Route::group(['middleware' => 'auth'], function () {

    Route::any('/', 'IndexController@index');

    //product
    Route::any('/product',                                  array('as'=>'listProducts',             'uses'=>'ProductController@index'));
    Route::any('/product/getProduct',                       array('as'=>'getProducts',              'uses'=>'ProductController@getProduct'));
    Route::post('/product/createProduct',                   array('as'=>'createProduct',            'uses'=>'ProductController@createProduct'));
    Route::any('/product/editProduct/{id}',                 array('as'=>'editProduct',              'uses'=>'ProductController@editProduct'));
    Route::get('/product/removeProduct/{id}',               array('as'=>'removeProduct',            'uses'=>'ProductController@removeProduct'));
    Route::any('/product/uploadImageDescription',           array('as'=>'uploadImageDescription',   'uses'=>'ProductController@uploadImageDescription'));
    Route::any('/product/listTags/',                        array('as'=>'ProductTags',              'uses'=>'ProductController@listTags'));
    Route::get('/product/setStatus/{id}/{status}',          array('as'=>'setStatusProduct',         'uses'=>'ProductController@setStatus'));

    //branch
    Route::any('/product/branch',                           array('as'=>'listBranches',             'uses'=>'BranchController@index'));
    Route::any('/branch/getBranch',                         array('as'=>'getBranches',              'uses'=>'BranchController@getBranch'));
    Route::post('/branch/createBranch',                     array('as'=>'createBranch',             'uses'=>'BranchController@createBranch'));
    Route::get('/branch/showEditFormBranch/{id}',           array('as'=>'showEditFormBranch',       'uses'=>'BranchController@showEditFormBranch'));
    Route::post('/branch/editBranch',                       array('as'=>'editBranch',               'uses'=>'BranchController@editBranch'));
    Route::get('/branch/setStatusBranch/{id}/{status}',     array('as'=>'setStatusBranch',          'uses'=>'BranchController@setStatusBranch'));
    Route::get('/branch/removeBranch/{id}',                 array('as'=>'removeBranch',             'uses'=>'BranchController@removeBranch'));

    //tag
    Route::any('/product/tag',                              array('as'=>'listTags',                 'uses'=>'TagController@index'));
    Route::any('/tag/getTag',                               array('as'=>'getTags',                  'uses'=>'TagController@getTag'));
    Route::any('/tag/showFormCreate/{id}',                  array('as'=>'showCreateFormTag',        'uses'=>'TagController@showFormCreate'));
    Route::post('/tag/createTag',                           array('as'=>'createTag',                'uses'=>'TagController@createTag'));
    Route::get('/tag/showEditFormTag/{id}',                 array('as'=>'showEditFormTag',          'uses'=>'TagController@showEditFormTag'));
    Route::post('/tag/editTag',                             array('as'=>'editTag',                  'uses'=>'TagController@editTag'));
    Route::get('/tag/setStatusTag/{id}/{status}',           array('as'=>'setStatusTag',             'uses'=>'TagController@setStatusTag'));
    Route::get('/tag/removeTag/{id}',                       array('as'=>'removeTag',                'uses'=>'TagController@removeTag'));

    //user
    Route::any('/user',                                     array('as'=>'listUsers',                 'uses'=>'UserController@index'));
    Route::any('/user/getUser',                             array('as'=>'getUsers',                  'uses'=>'UserController@getUser'));
    Route::post('/user/create',                             array('as'=>'createUser',                'uses'=>'UserController@create'));
    Route::any('/user/edit/{id}',                           array('as'=>'editUser',                  'uses'=>'UserController@edit'));
    Route::get('/user/setStatus/{id}/{status}',             array('as'=>'setStatusUser',             'uses'=>'UserController@setStatus'));
    Route::get('/user/remove/{id}',                         array('as'=>'removeUser',                'uses'=>'UserController@destroy'));
    Route::get('/user/showCreateForm',                      array('as'=>'showCreateForm',            'uses'=>'UserController@showCreateForm'));

});
