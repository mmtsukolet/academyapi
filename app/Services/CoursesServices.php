<?php

namespace App\Services;

use GuzzleHttp;


class CoursesServices 
{
	protected $client;

	/**
	 * Init
	 */
	public function __construct()
	{
		# code...
	}

	/**
	 * Return Courses 
	 * @return [type] [description]
	 */
	public function getCourses()
	{
    	$client = new GuzzleHttp\Client(['base_uri' => env('MATRIX_BASE_URL') . "v1/" ]);
    	$response = $client->get('courses');
		$body = $response->getBody();
		$data = json_decode($body, true);

		return empty($data['data']) ? false : $data['data'];
	}

	/**
	 * Show Course By Id
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getCourseById($id)
	{
		$client = new GuzzleHttp\Client(['base_uri' => env('MATRIX_BASE_URL') . "v1/" ]);
    	$response = $client->get('courses/'.$id);
		$body = $response->getBody();
		$data = json_decode($body, true);

		return $data['data'];
	}

	/**
	 * Returns available courses
	 * @return [type] [description]
	 */
	public function getAllAvailableCourses()
	{
		$client = new GuzzleHttp\Client(['base_uri' => env('MATRIX_BASE_URL') . "v1/" ]);
    	$response = $client->get('academy_courses/available_courses');
		$body = $response->getBody();
		$data = json_decode($body, true);

		return $data['data'];
	}

}