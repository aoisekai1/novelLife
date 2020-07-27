<?php

use Illuminate\Http\Request;

/*
* Note: If you import model please execute this command : 
* 1. composer dump or composer dump-autoload
*/

Route::group(['prefix' => 'v1'], function () {
    
    Route::get('members', array('as' => 'members', 'uses' => 'memberControllers@show'));
    Route::get('members/{id}', array('as' => 'members.show', 'uses' => 'memberControllers@show'));
    Route::post('members/create', array('as' => 'members.create', 'uses' => 'memberControllers@create'));
    Route::put('members/update/{id}', array('as' => 'members.update', 'uses' => 'memberControllers@update'));
    Route::delete('members/delete/{id}', array('as' => 'members.delete', 'uses' => 'memberControllers@destroy'));


    Route::get('novel', array('as' => 'novel', 'uses' => 'NovelControllers@show'));
    Route::get('novel/{id}', array('as' => 'novel.show', 'uses' => 'NovelControllers@show'));
    Route::post('novel/create', array('as' => 'novel.create', 'uses' => 'NovelControllers@create'));
    Route::put('novel/update/{id}', array('as' => 'novel.update', 'uses' => 'NovelControllers@update'));
    Route::delete('novel/delete/{id}', array('as' => 'novel.delete', 'uses' => 'NovelControllers@destroy'));

    Route::get('menu', array('as' => 'menu', 'uses' => 'MenuControllers@show'));
    Route::get('menu/{id}', array('as' => 'menu.show', 'uses' => 'MenuControllers@show'));
    Route::post('menu/create', array('as' => 'menu.create', 'uses' => 'MenuControllers@create'));
    Route::put('menu/update/{id}', array('as' => 'menu.update', 'uses' => 'MenuControllers@update'));
    Route::delete('menu/delete/{id}', array('as' => 'menu.delete', 'uses' => 'MenuControllers@destroy'));

    Route::get('rate', array('as' => 'rate', 'uses' => 'RateControllers@show'));
    Route::get('rate/{id}', array('as' => 'rate.show', 'uses' => 'RateControllers@show'));
    Route::post('rate/create', array('as' => 'rate.create', 'uses' => 'RateControllers@create'));
    Route::put('rate/update/{id}', array('as' => 'rate.update', 'uses' => 'RateControllers@update'));
    Route::delete('rate/delete/{id}', array('as' => 'rate.delete', 'uses' => 'RateControllers@destroy'));

    Route::get('type_user', array('as' => 'type_user', 'uses' => 'TypeUserControllers@show'));
    Route::get('type_user/{id}', array('as' => 'type_user.show', 'uses' => 'TypeUserControllers@show'));
    Route::post('type_user/create', array('as' => 'type_user.create', 'uses' => 'TypeUserControllers@create'));
    Route::put('type_user/update/{id}', array('as' => 'type_user.update', 'uses' => 'TypeUserControllers@update'));
    Route::delete('type_user/delete/{id}', array('as' => 'type_user.delete', 'uses' => 'TypeUserControllers@destroy'));

    Route::get('chapter', array('as' => 'chapter', 'uses' => 'ChapterControllers@show'));
    Route::get('chapter/{id}', array('as' => 'chapter.show', 'uses' => 'ChapterControllers@show'));
    Route::post('chapter/create', array('as' => 'chapter.create', 'uses' => 'ChapterControllers@create'));
    Route::put('chapter/update/{id}', array('as' => 'chapter.update', 'uses' => 'ChapterControllers@update'));
    Route::delete('chapter/delete/{id}', array('as' => 'chapter.delete', 'uses' => 'ChapterControllers@destroy'));

    Route::get('permission', array('as' => 'permission', 'uses' => 'PermissionMenuControllers@show'));
    Route::get('permission/{id}', array('as' => 'permission.show', 'uses' => 'PermissionMenuControllers@show'));
    Route::post('permission/create', array('as' => 'permission.create', 'uses' => 'PermissionMenuControllers@create'));
    Route::put('permission/update/{id}', array('as' => 'permission.update', 'uses' => 'PermissionMenuControllers@update'));
    Route::delete('permission/delete/{id}', array('as' => 'permission.delete', 'uses' => 'PermissionMenuControllers@destroy'));

    Route::get('social_media', array('as' => 'social_media', 'uses' => 'SocialMediaControllers@show'));
    Route::get('social_media/{id}', array('as' => 'social_media.show', 'uses' => 'SocialMediaControllers@show'));
    Route::post('social_media/create', array('as' => 'social_media.create', 'uses' => 'SocialMediaControllers@create'));
    Route::put('social_media/update/{id}', array('as' => 'social_media.update', 'uses' => 'SocialMediaControllers@update'));
    Route::delete('social_media/delete/{id}', array('as' => 'social_media.delete', 'uses' => 'SocialMediaControllers@destroy'));

    Route::post('auth/login', array('as' => 'auth.login', 'uses' => 'AuthControllers@show'));


});