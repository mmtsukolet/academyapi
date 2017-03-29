<?php


namespace App\Http\Controllers\v1;
    
use App\Http\Controllers\Controller;
use App\Services\SectionsServices;


class SectionsV1Controller extends Controller 
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
        $sections = (new SectionsServices)->getSections();
        if ($sections) {
            foreach ($sections as $section) {
                $data[] = $section;
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

		$data = (new SectionsServices)->getSectionById($id);

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