<?php 


namespace App\Services;

use GuzzleHttp;


class SectionsServices 
{
	/**
	 * Init
	 */
	public function __construct()
	{
		# code...
	}

	/**
	 * Return Sections
	 * @return [type] [description]
	 */
	public function getSections()
	{
		$client = new GuzzleHttp\Client(['base_uri' => env('MATRIX_BASE_URL')  . "v1/" ]);
    	$response = $client->get('sections');
		$body = $response->getBody();
		$data = json_decode($body, true);

		return empty($data['data']) ? false : $data['data'];
	}

	/**
	 * Returns Sections by Id
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getSectionById($id)
	{
		$client = new GuzzleHttp\Client(['base_uri' => env('MATRIX_BASE_URL') . "v1/" ]);
    	$response = $client->get('sections/'.$id);
		$body = $response->getBody();
		$data = json_decode($body, true);

		return $data['data'];
	}


}