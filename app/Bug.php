<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    //
    protected $guarded= [];
    
    /**
     * one to many relationship 
     * this relationship shows that a project has many bugs
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
    /**
     * This is a one to many relationship 
     * it creates the relationship between the bug and user that created it 
     */
    public function author()
     {
        return $this->belongsTo('App\User','created_by');
     }

     /**
     * This is a polymorphic many to many relationship 
     * it creates the relationship between the bug and assigned users to it  
     */

    public function assigned_users(){
        return $this->morphToMany('App\User','useable');
    }


}
