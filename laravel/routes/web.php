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

Route::get('logout', 'Auth\LoginController@logout');
Route::get('admin/home', function () {
	return view('home');
});
Route::get('/', function () {
	return view('welcome');
});

Route::resource('admin/categoria', 'CategoriaController');
Route::resource('admin/publicaciones', 'PublicacionesController');
Route::resource('admin/atributo', 'AtributosController');
Route::resource('admin/usuarios', 'UsuariosController');

Route::get('admin/categoria/{id}/atributos', 'CategoriaController@getAtributos');
Route::post('admin/categoria/{id}/atributos', 'CategoriaController@storeAtributos');
Route::delete('admin/categoria/{id}/atributos/{idatr}', 'CategoriaController@deleteAtributos');
Route::get('admin/categoria/{id}/atributos/{idatr}/edit', 'CategoriaController@editAtributos');
Route::patch('admin/categoria/{id}/atributos/{idatr}', 'CategoriaController@updateAtributos');
Route::post('admin/categoria/{id}/atributos/addAtributos', 'CategoriaController@addAtributos');

Route::get('admin/publicaciones/{id}/imagen', 'PublicacionesController@imagen');
Route::post('admin/publicaciones/{id}/imagen', 'PublicacionesController@guardarImg');
Route::delete('admin/publicaciones/{id}/imagen', 'PublicacionesController@deleteImg');
Route::get('admin/publicaciones/{id}/atributos', 'PublicacionesController@atributos');
Route::get('admin/publicaciones/{id}/atributos/{idcate}', 'PublicacionesController@atributosMostrar');
Route::get('admin/publicaciones/{id}/atributos/valores/{idvalor}', 'PublicacionesController@valoresMostrar');
Route::post('admin/publicaciones/{id}/atributos/addAtr', 'PublicacionesController@agregarAtributos');
Route::get('admin/publicaciones/{id}/atributos/{idAtr}/borrar', 'PublicacionesController@borrarAtributos');

Route::post('admin/publicaciones/{id}/atributos/addAtr2', 'PublicacionesController@agregarAtributos2');
/* Route mensajes */
Route::get('admin/mensajes', 'MensajesController@index');
Route::get('admin/mensajes/{id}', 'MensajesController@show');
Route::get('admin/mensajes/{id}/responder', 'MensajesController@responder');
Route::get('admin/mensajes/{id}/borrar', 'MensajesController@borrar');

Route::get('admin/pruebacontact', 'CrearMensajesController@create');
Route::post('admin/mensajes', 'CrearMensajesController@store');

/*Route::get('/categoria/{cat}','CategoriaController@padre');

Route::get('/categoria/{cat}/{child}','CategoriaController@hijo');

Route::get('/buscar/{src}','SearchController@buscar');

Route::get('/buscar','SearchController@buscar_form');

Route::get('/{author}/{product}-{id_product}','SingleController@singlewithuser');

Route::get('/{product}-{id_product}','SingleController@single');*/


Route::get('/buscar/{src}',function($src){
	return view('results', ['src' => $src]);
});

Route::get('/categoria/{src}',function($src){
	return view('category', ['src' => $src]);
});

Route::get('/publicacion/{nombre}-{id}',function($nombre,$id){
	return view('item', ['id' => $id]);
});

Route::get('/quienes-somos',function(){
	return view('about');
});

Route::get('/buscar','SearchController@buscar_form');

/*API*/
Route::get('/api/features','ProductsController@features');

Route::get('/api/search/{src}','SearchController@buscar');

Route::get('/img/{id}','MediaController@image');

/* API´s Carlos*/
Route::get('api/buscar/{buscar}', 'ApiS@search2');
Route::get('api/buscar/{buscar}/{page}', 'SearchController@buscarApi');

Route::get('api/categorias', 'ApiS@categoriasAll');
Route::get('api/categorias/{id}', 'ApiS@categoriasId');
Route::get('api/recomendados/{id}', 'ApiS@recomendados');
Route::get('api/categoria/{slug}', 'ApiS@productscat');
Route::get('api/publicaciones', 'ApiS@publicacionesAll');
Route::get('api/publicaciones/{id}', 'ApiS@publicacionesId');

Route::get('api/demo/{slug}', 'ApiS@attr2');

Route::post('api/newsleter', 'ApiS@newsleter');
Route::get('api/atributospublic/{id}/{valor}', 'ApiS@atriPublic');
Route::get('api/atributospublic/{id}/{valor}/{slug}', 'ApiS@atriPublic2');
Route::get('api/atributospublic/src/{id}/{valor}/{src}', 'ApiS@atriPublic2src');