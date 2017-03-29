<?php

namespace App\Http\Controllers\v1;
    
use App\Http\Controllers\Controller;
use App\Services\CoursesServices;
use App\Services\ModulesServices;
use App\Services\SectionsServices;


/**
 * Models
 */


/**
 * Helpers
 */
use Illuminate\Support\Facades\Request;

class CoursesV1Controller extends Controller
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
        $courses = (new CoursesServices)->getCourses();
        $modules = (new ModulesServices)->getModules();
        $sections = (new SectionsServices)->getSections();

        if ($courses) {
            foreach ($courses as $course) {
                $data[] = $course;
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

        $data = (new CoursesServices)->getCourseById($id);
        
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

    /**
     * Returns all available courses
     * @return [type] [description]
     */
    public function available_courses()
    {
        $operation = "all";
        $success =true;
        $errors = [];

        $data = (new CoursesServices)->getAllAvailableCourses();

        return compact('operation', 'data', 'success', 'errors');
    }
}