<?php

namespace App\Models;

use App\User;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;

class Status extends Eloquent 
{
	protected $fillable = ['user_id', 'course_id', 'answers'];

    protected $table = "status";


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
        $model = DB::collection('status')->where('_id', $id)->first();

        if (!$model) 
            return false;
        else 
            return $model;
    }

    /**
     * Find by UserId and CourseId
     * @param  [type] $query      [description]
     * @param  [type] $attributes [description]
     * @return [type]             [description]
     */
    public function scopefindByUserIdAndCourseId($query, $attributes)
    {
        $model = DB::collection('status')
                    ->where('user_id', $attributes['user_id'])
                    ->where('course_id', $attributes['course_id'])->first();

        return $model;
    }

    /**
     * Return model obj by `user_id`
     * @param  [type] $query  [description]
     * @param  [type] $userId [description]
     * @return [type]         [description]
     */
    public function scopefindByUserId($query, $userId)
    {
        return DB::collection('status')->where('user_id', $userId)->get();
    }

     /**
     * Handles saving will do an upsert
     * @return [type] [description]
     */
    public function setAttributesAndSave($attributes, User $user)
    {
        $errors = [];
        $data = [];
        $success = false;

        // foreach ($attributes as $key => $value) {
        //     if ($this->hasAttribute($key) === FALSE) 
        //         $errors[] = ['message' => "`{$key}`" . " column does not exist."];
        // }

        // if (!empty($errors)) {
        //     return compact('success', 'data', 'errors');
        // }
    
        try {
            
            $success = DB::collection('status')
                    ->where('user_id', $user->id)
                    ->where('course_id', $attributes['course_id'])
                    ->update($attributes, ['upsert' => true]);

            $data = self::findByUserIdAndCourseId(['user_id' => $attributes['user_id'], 'course_id' => $attributes['course_id']]);

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

        // $model_id = $model['_id']->__toString();

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
            
            $success = DB::collection('status')
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