<?php

namespace App\Http\Controllers\v1;
    
use App\Http\Controllers\Controller;

/**
 * Models
 */
use App\Models\AcademyUsers;
use App\User;


/**
 * Helpers
 */
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserV1Controller extends Controller
{
 	/**
 	 * Handles listing of Users
 	 * @return [type] [description]
 	 */
    public function index()
    {   
        $operation = "get";
        $success = true;
        $data = [];
        $errors = [];

        $data = Auth::user();
        
        return compact('operation', 'success', 'data', 'errors');
    }

    /**
     * Show by details
     * @return [type] [description]
     */
    public function show($id)
    {
        $operation = "get";
        $success = true;
        $errors = [];

        $data = User::findById($id);

        return compact('operation', 'success', 'data', 'errors');
    }

    /**
     * Handles Create Object API
     * @return [type] [description]
     */
    public function store()
    {
        $input = Request::all();

        $user = Auth::user();

        $academy_accounts = [
            'user_id' => $user->id,
            'email' => $user->email,
            'password' => $user->password
        ];

        $model = new User;
        $result = $model->setAttributesAndSave(['academyProfiles' => $input, 'academy' => $academy_accounts ], $user);
        
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
        $model = User::findById($id);
        $result = $model->setAttributesAndUpdate($input, $id);

        $success = $result['success'];
        $data = $result['data'];
        $errors = $result['errors'];

        return compact('success', 'data', 'errors');
    }

    /**
     * Load edit page
     * @return [type] [description]
     */
    public function edit()
    {
    	echo json_encode(['success' => true, 'data' => 'this is for edit page.']);
    }
}