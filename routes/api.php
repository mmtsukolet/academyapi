<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\Hash;

$app->get('/', function () use ($app) {
    return "Welcome to F45 Academy Web " . $app->version();
});

/**
 * Mobile will fetch on what version to be used
 */
$app->get('/version/current', function () use ($app) {
    return env('APP_VERSION');
});

$app->post('/auth/authorize', 'Auth\AuthController@loginPost');

/**
 * @todo 
 * Route for POST /authorize
 * Route for PUT /user
 */

/**
 * Handles default api routes
 */
$app->group(['prefix' => '{version}', 'middleware' => 'auth'], function ($app) {

	  $app->get('/available_courses', env('APP_VERSION'). '\Courses'.ucwords(env('APP_VERSION')).'Controller@available_courses');
   	
    $app->get('/{controller}', 'ApiController@get');
    $app->get('/{controller}/{action}', 'ApiController@get');
    $app->post('/{controller}', 'ApiController@post');
    $app->put('/{controller}/{id}', 'ApiController@put');
    $app->get('/{controller}/{id}/edit', 'ApiController@edit');	//@Mark: For view pages

});

/**
 * If routes not found
 */
$app->get('/{any:.*}', function ($any) use ($app) {
   return response()->json(['status' => 404, 'message' => 'Unable to access this route.']);
});
