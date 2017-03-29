<?php


namespace App\Http\Controllers\v1;
    
use App\Http\Controllers\Controller;
use App\Services\ModulesServices;


class ModulesV1Controller extends Controller 
{
	/**
 	 * Handles listing of tutorials
 	 * @return [type] [description]
 	 */
    public function index()
    {
        $operation = "all";
        $success =true;
        $errors = [];

        $data = [];
    	$modules = (new ModulesServices)->getModules();
        
        if ($modules) {
            foreach ($modules as $module) {
                $data[] = $module;
            }
        }

		return compact('operation', 'data', 'success', 'errors');
    }

    /**
     * Show by details
     * @return [type] [description]
     */
    public function show($id)
    {
        $operation = "get";
        $success =true;
        $errors = [];

		$data = (new ModulesServices)->getModulesById($id);

		return compact('operation', 'data', 'success', 'errors');
    }

    /**
     * Handles Create Object API
     * @return [type] [description]
     */
    public function store()
    {
        
    }

    /**
     * Handles Update Object API 
     * @return [type] [description]
     */
    public function update($id)
    {
        
    }

    /**
     * Load edit page
     * @return [type] [description]
     */
    public function edit()
    {
    	
    }


}