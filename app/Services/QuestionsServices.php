<?php

namespace App\Services;

use GuzzleHttp;


class QuestionsServices 
{	
	/**
	 * Init
	 */
	public function __construct()
	{
		# code...
	}

	/**
	 * Return All Questions
	 * @return [type] [description]
	 */
	public function getQuestions()
	{
		$client = new GuzzleHttp\Client(['base_uri' => env('MATRIX_BASE_URL') . "v1/" ]);
    	$response = $client->get('questions');
		$body = $response->getBody();
		$data = json_decode($body, true);

		return empty($data['data']) ? false : $data['data'];
	}

	/**
	 * Return Questions by Id
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getQuestionById($id)
	{
		$client = new GuzzleHttp\Client(['base_uri' => env('MATRIX_BASE_URL') . "v1/" ]);
    	$response = $client->get('questions/'.$id);
		$body = $response->getBody();
		$data = json_decode($body, true);

		return $data['data'];
	}

}