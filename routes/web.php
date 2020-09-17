<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/mi-perfil', 'UserController@perfil')->name('perfil');
Route::get('/user/crear', 'UserController@crear')->name('user.crear');
Route::post('/user/create', 'UserController@create')->name('user.create');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/contrasena', 'UserController@contrasena')->name('contrasena');
Route::post('/user/cambiar', 'UserController@cambiar')->name('user.cambiar');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::get('/perfil/{id}', 'UserController@profile')->name('profile');
Route::get('/gentes/{buscar?}', 'UserController@index')->name('user.index');

/* Imagenes */
Route::get('/subir-imagen', 'ImageController@create')->name('image.create');
Route::post('/image/save', 'ImageController@save')->name('image.save');
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');
Route::get('/imagen/{id}', 'ImageController@detail')->name('image.detail');
Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');
Route::get('/imagen/editar/{id}', 'ImageController@edit')->name('image.edit');
Route::post('/image/update', 'ImageController@update')->name('image.update');

/** Likes */
Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('dislike.delete');
Route::get('/likes', 'LikeController@index')->name('likes');


/* Pilotos */
Route::get('/pilotos/{buscar?}', 'PilotController@index')->name('pilotos.index');
Route::get('/pilotos/cambiar-perfil/{id}', 'PilotController@perfil')->name('pilotos.perfil');
Route::get('/pilotos/eliminar/{id}', 'PilotController@eliminar')->name('pilotos.eliminar');
Route::post('/pilotos/actualizar-perfil', 'PilotController@cambiarperfil')->name('pilotos.cambiarperfil');
Route::get('/pilotos/destroy/{id}', 'PilotController@destroy')->name('pilotos.destroy');

/* Convenios */
Route::get('/convenios/{buscar?}', 'AgreementController@index')->name('agreement.index');
Route::get('/convenios/buscar-piloto/{buscarPiloto?}', 'AgreementController@buscarPiloto')->name('agreement.buscar');

/** Comentarios */
Route::post('/comment/save', 'CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');
