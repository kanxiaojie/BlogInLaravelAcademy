<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function(){
        return redirect('/blog');
    });

    Route::get('blog', 'BlogController@index');
    Route::get('blog/{slug}', 'BlogController@showPost');

    Route::get('admin', function(){
       return redirect('/admin/post');
    });

    Route::group(['namespace' => 'Admin', 'middleware' => 'auth'], function(){
       Route::resource('admin/post', 'PostController', ['except' => 'show']);
       Route::resource('admin/tag', 'TagController', ['except' => 'show']);
        Route::get('admin/upload', "UploadController@index");

        //文件上传路由
        Route::post('admin/upload/file', 'UploadController@uploadFile');
        Route::delete('admin/upload/file', 'UploadController@deleteFile');
        Route::post('admin/upload/folder', 'UploadController@createFolder');
        Route::delete('admin/upload/folder', 'UploadController@deleteFolder');
    });

    Route::auth();
});