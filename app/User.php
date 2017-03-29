<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\DB;

class User extends Eloquent implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;

    protected $collection = 'user';
    protected $primaryKey = '_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'timezone', 'name','age',
        'weight','height','sex',
        'serial','password','email', 'studio',
        'accounts'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

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
     * Return model instance by id
     * @param  [type] $query [description]
     * @param  [type] $id    [description]
     * @return [type]        [description]
     */
    public function scopefindById($query, $id)
    {
        $model = self::where('_id', $id)->first();
        if (!$model) 
            return false;  

        return $model;
    }

    /**
     * Handles saving
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

            // @TODO: Mandatory values for `academyProfiles` add Validations    

            $success = DB::collection('user')
                            ->where('email', $user->email)
                            ->where('_id', $user->id)
                            ->update($attributes, ['upsert' => true]);

            $data = self::findById($user->id);
            
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

    /**
     * Pass an array type key value pair
     * key as json label key
     * value as model attribute value
     * @param  [array] $expected_output [description]
     * @return [type]                  [description]
     */
    public function format($expected_output)
    {
        if (empty($expected_output)) 
            return false;

        $data = [];
        foreach ($expected_output as $k => $v) {
            $data = [$k => $this->{$v}];
        }

        return $data;

    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    
}
