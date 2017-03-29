<?php 

namespace App\Services;

use GuzzleHttp;


class ModulesServices 
{
	protected $client;

	public function __construct()
	{
		# code...
	}

	/**
	 * Return all modules
	 * @return [type] [description]
	 */
	public function getModules()
	{
		$client = new GuzzleHttp\Client(['base_uri' => env('MATRIX_BASE_URL') . "v1/" ]);
    	$response = $client->get('modules');
		$body = $response->getBody();
		$data = json_decode($body, true);

		return empty($data['data']) ? false : $data['data'];
	}

	/**
	 * Show Modules By Id
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getModulesById($id)
	{
		$client = new GuzzleHttp\Client(['base_uri' => env('MATRIX_BASE_URL') . "v1/" ]);
    	$response = $client->get('modules/'.$id);
		$body = $response->getBody();
		$data = json_decode($body, true);

		return $data['data'];
	}	

	/**
	 * Return all modules by course id
	 * @param  [type] $courseId [description]
	 * @return [type]           [description]
	 */
	public function getModulesByCourseId($courseId)
	{
		$client = new GuzzleHttp\Client(['base_uri' => env('MATRIX_BASE_URL') . "v1/" ]);
    	$response = $client->get('academy_modules/'.$courseId.'/courses');
		$body = $response->getBody();
		$data = json_decode($body, true);
	}


}