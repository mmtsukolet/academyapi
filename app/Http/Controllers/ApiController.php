<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class ApiController extends Controller
{
    
    /**
     * Handles GET method
     * @param  [type] $controller [description]
     * @param  string $action     [description]
     * @return [type]             [description]
     */
    public function get($version, $controller, $action = "index")
    {   
        $controller_ = ucfirst($controller).strtoupper($version)."Controller";
        switch ($action) {
            case 'create':
                return app('App\Http\Controllers\\'. strtolower($version) . '\\' . $controller_)->create();
                break;
            case 'index':
                return app('App\Http\Controllers\\'. strtolower($version) . '\\' . $controller_)->index();
                break;
            default:
                return app('App\Http\Controllers\\'.strtolower($version) . '\\' . $controller_)->show($action);
                break;
        }
    }

    /**
     * Handles POST method
     * @param  [type] $controller [description]
     * @param  string $action     [description]
     * @return [type]             [description]
     */
    public function post($version, $controller, $action = "create")
    {
        $controller_ = ucfirst($controller).strtoupper($version)."Controller";
        if ($action == 'create') {
            return app('App\Http\Controllers\\'. strtolower($version) . '\\' . $controller_)->store();
        }
    }

    /**
     * Handles PUT method
     * @param  [type] $version    [description]
     * @param  [type] $controller [description]
     * @return [type]             [description]
     */
    public function put($version, $controller, $id)
    {
       $controller_ = ucfirst($controller).strtoupper($version)."Controller";
       return app('App\Http\Controllers\\'. strtolower($version) . '\\' . $controller_)->update($id);
    }

    /**
     * Load update page
     * @param  [type] $controller [description]
     * @param  string $action     [description]
     * @return [type]             [description]
     */
    public function edit($version, $controller, $id =null, $action = "edit")
    {
        $controller_ = ucfirst($controller).strtoupper($version)."Controller";
        switch ($action) {
            case 'edit':
                if ($id)
                    return app('App\Http\Controllers\$version\\'. strtolower($version) . '\\' .$controller_)->edit($id);
                else
                    return app('App\Http\Controllers\$version\\'. strtolower($version) . '\\' .$controller_)->index();
            case 'delete':
                if ($id)
                    return app('App\Http\Controllers\$version\\'. strtolower($version) . '\\' .$controller_)->destroy($id);
                else
                    return app('App\Http\Controllers\$version\\'. strtolower($version) . '\\' .$controller_)->index();
                break;
            default:
                echo "<h1>Error 404. Page not found.</h1>";
        }
    }
}