<?php


@ob_start();
session_start();
?>
    <?php
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


    Route::get('/',[

        'uses'=> 'BlogController@index',
        'as' => 'blog'


    ]);

    Route::get('/all-post',[

        'uses'=> 'BlogListController@index',

        'as' => 'blog.list'
    ]);


    Route::get('/blog/{post}',[

        'uses'=>'BlogController@show',
        'as'=> 'post.show'
    ]);

    route::post('/blog/{post}/comments',[

        'uses' => 'CommentsController@store',

        'as' => 'blog.comments'
    ]);

    Route::get('category/{category}',[

        'uses'=>'BlogController@category',
        'as'=>'category'
    ]);


    Route::get('author/{author}',[
        'uses'=>'BlogController@author',
        'as'=>'author'
    ]);
    Route::get('tag/{tag}',[
        'uses'=>'BlogController@tag',
        'as'=>'tag'
    ]);

    Route::PUT('/adminpanel/blog/restore/{blog}', [
        'uses'=> 'adminpanel\BlogController@restore',
        'as'=> 'blog.restore'
    ]);

    Route::DELETE('/adminpanel/blog/force-destroy/{blog}',[
        'uses'=> 'adminpanel\BlogController@forceDestroy',

        'as'=> 'blog.force-destroy'
    ]);


    Auth::routes();

    Route::get('/admin ', 'adminpanel\HomeController@index')->name('home');

    Route::get('/edit-account','adminpanel\HomeController@edit');
    Route::PUT('/edit-account','adminpanel\HomeController@update');

    Route::namespace('adminpanel')->resource('/adminpanel/blog','adminpanel\BlogController');

    Route::namespace('adminpanel')->resource('/adminpanel/categories', 'adminpanel\CategoriesController');

    Route::get('/adminpanel/users/confirm/{user}', [

        'uses'=> 'adminpanel\UsersController@confirm',
          'as'=> 'users.confirm'
    ]);

    Route::namespace('adminpanel')->resource('/adminpanel/users', 'adminpanel\UsersController');

    Route::get('/about','AboutController@index')


    

?>