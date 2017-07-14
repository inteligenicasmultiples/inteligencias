<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['middleware' => 'web'], function () {
    Route::auth();
});


Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/mi-perfil', ['as' => 'user.profile', 'uses' => 'UserController@profile']);
        Route::post('/mi-perfil', ['as' => 'user.update', 'uses' => 'UserController@update']);
    });

    Route::get('/', ['as' => 'intelligence.index', 'uses' => 'IntelligenceController@index']);
    Route::get('/actividades-familiares', ['as' => 'family.activities', 'uses' => 'IntelligenceController@familyActivities']);
    Route::group(['prefix' => '/{intelligenceSlug}'], function () {
        Route::get('/', ['as' => 'intelligence.show', 'uses' => 'IntelligenceController@show']);
        Route::group(['prefix' => '/tutorial'], function () {
            Route::get('/', ['as' => 'tutorial.index', 'uses' => 'TutorialController@index']);
            Route::get('/create',
                ['as' => 'tutorial.create', 'middleware' => ['auth'], 'uses' => 'TutorialController@create']);
            Route::post('/store',
                ['as' => 'tutorial.store', 'middleware' => ['auth'], 'uses' => 'TutorialController@store']);
            Route::group(['prefix' => '/{tutorialId}'], function () {
                Route::get('/', ['as' => 'tutorial.show', 'uses' => 'TutorialController@show']);
                Route::post('/comment',
                    ['as' => 'comment.store', 'middleware' => ['auth'], 'uses' => 'CommentController@store']);
                    Route::post('/like', ['as' => 'post.like', 'uses' => 'LikeController@likePost']);
                    Route::post('/unlike', ['as' => 'post.unlike', 'uses' => 'LikeController@unlikePost']);
                    Route::get('/like/who', ['as' => 'post.like.who', 'uses' => 'LikeController@whoLikePost']);
            });
        });
    });

});
