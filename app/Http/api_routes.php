<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

	$api->post('auth/login', 'App\Api\V1\Controllers\AuthController@login');
	$api->post('auth/signup', 'App\Api\V1\Controllers\AuthController@signup');
	$api->post('auth/recovery', 'App\Api\V1\Controllers\AuthController@recovery');
	$api->post('auth/reset', 'App\Api\V1\Controllers\AuthController@reset');

	$api->group(['middleware' => 'api.auth'], function($api) {
		$api->resource('regions', 'App\Api\V1\Controllers\RegionController');
		$api->get('regions/{id}/teams', 'App\Api\V1\Controllers\RegionController@showTeams');

		$api->resource('teams', 'App\Api\V1\Controllers\TeamController');
		$api->resource('champions', 'App\Api\V1\Controllers\ChampionController');
		$api->resource('games', 'App\Api\V1\Controllers\GameController');
	});

	// example of protected route
	$api->get('protected', ['middleware' => ['api.auth'], function () {
		return \App\User::all();
	}]);

	// example of free route
	$api->get('free', function() {
		return \App\User::all();
	});

});
