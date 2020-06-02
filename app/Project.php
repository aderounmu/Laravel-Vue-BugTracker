<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $guarded = [];

    /**
     * One to many relationship
     */

     public function Bugs(){
             
        return $this->hasMany('App\Bug');

     }

    /**
     * This is a one to many relationship 
     * it creates the relationship between the project and user that created it 
     */
    public function author()
     {
         return $this->belongsTo('App\User','created_by');
     }

     /**
     * This is a polymorphic many to many relationship 
     * it creates the relationship between the project and assigned users to it and if they are admins
     */

    public function assigned_users(){
        return $this->morphToMany('App\User','useable');
    }

}

