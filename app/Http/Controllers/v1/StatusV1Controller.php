<?php

namespace App\Http\Controllers\v1;
    
use App\Http\Controllers\Controller;

/**
 * Models
 */
use App\Models\Status;
use App\User;

/**
 * Helpers
 */
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class StatusV1Controller extends Controller 
{	
	/**
	 * Handles listing of status
	 * @return [type] [description]
	 */
	public function index()
	{
		$operation = "get";
		$success = true;
		$errors = [];

		$user = Auth::user();

		$data = Status::findByUserId($user->id);

		return compact('operation', 'success', 'data', 'errors');
	}

	/**
	 * Show by details
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	function show($id)
	{
		$operation = "get";
		$success = true;
		$errors = [];

		$data = Status::findById($id);

		return compact('operation', 'success', 'data', 'errors');
	}

	/**
	 * Handles Create Operation
	 * @return [type] [description]
	 */
	public function store()
	{
		$input = Request::all();

		$user = Auth::user();

		$model = new Status;
        $result = $model->setAttributesAndSave($input, $user);
        
        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        return compact('success', 'data', 'errors');
	}

	/**
	 * Handles Update Object API 
	 * @return [type] [description]
	 */
	public function update($id)
	{
		$input = Request::all();
        // $model = Status::findById($id);
        $result = (new Status)->setAttributesAndUpdate($input, $id);

        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        return compact('success', 'data', 'errors');
	}
}