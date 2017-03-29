<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;

/**
 * BURN THIS CLASS USE App\User
 */
class AcademyUsers extends Eloquent 
{
    protected $fillable = [
        'timezone', 'name','age',
        'weight','height','sex',
        'serial','password','email', 'studio',
        'accounts'
    ];

    protected $table = "user";

    /**
     * Checks if attributes is valid
     * @param  [type]  $attr [description]
     * @return boolean       [description]
     */
    public function hasAttribute($attr)
    {
        return in_array($attr, $this->getFillable());
    }

    /**
     * Return details by id
     * @param  [type] $query [description]
     * @param  [type] $id    [description]
     * @return [type]        [description]
     */
    public function scopefindById($query, $id)
    {
        $model = DB::collection('user')->where('_id', $id)->first();

        if (!$model) 
            return false;
        else 
            return $model;
    }

    /**
     * Handles saving
     * @return [type] [description]
     */
    public function setAttributesAndSave($attributes)
    {
        $errors = [];
        $data = [];
        $success = false;

        foreach ($attributes as $key => $value) {
            if ($this->hasAttribute($key) === FALSE) 
                $errors[] = ['message' => "`{$key}`" . " column does not exist."];
        }

        if (!empty($errors)) {
            return compact('success', 'data', 'errors');
        }

        try {
            $data = self::create($attributes);
            $success = ($data) ? 1 : 0;
            return compact('success', 'data', 'errors');
        } catch (Exception $e) {
            $errors = ['message' => $e->getMessage()];
            return compact('success', 'data', 'errors');
        }
    }

    /**
     * Handles Update record
     * @param [type] $attributes [description]
     */
    public function setAttributesAndUpdate($attributes, $id)
    {
        $errors = [];
        $data = [];
        $success = false;
        
        /*if (!$model) {
            $errors[] = ['message' => "`{id}` does not exist."];
            return compact('success', 'data', 'errors');
        }

        foreach ($attributes as $key => $value) {
            if ($this->hasAttribute($key) === FALSE) 
                $errors[] = ['message' => "`{$key}`" . " column does not exist."];
        }*/

        if (!empty($errors)) {
            return compact('success', 'data', 'errors');
        }

        try {
            // $model->fill($attributes);
            // $success = $model->save();

           $success = DB::collection('user')
                        ->where('_id', $id)
                        ->update($attributes, ['upsert' => true]);

            $data = self::findById($id);

            return compact('success', 'data', 'errors');

        } catch (Exception $e) {
            $errors = ['message' => $e->getMessage()];
            return compact('success', 'data', 'errors');
        }
    }

}
