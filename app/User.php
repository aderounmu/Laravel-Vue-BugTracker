<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens; 

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',


    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   /**
     * This is a many to one relationship 
     * it creates the relationship between the bug and user that created it 
     */
    public function bugs()
    {
        return $this->hasMany('App\Bug','created_by');
    }


    /**
     * This is a many to one relationship 
     * it creates the relationship between the project and user that created it 
     */
    public function projects()
    {
        return $this->hasMany('App\Project','created_by');
    }

    /**
     * This is a polymorphic many to many relationship 
     * it creates the relationship between the users and assigned bugs to it 
     */

    public function assigned_bugs(){
        return $this->morphedByMany('App\Bug','useable');
    }

    /**
     * This is a polymorphic many to many relationship 
     * it creates the relationship between the users  and assigned projects to it 
     */

    public function assigned_projects(){
        return $this->morphedByMany('App\Project','useable');
    }

    
}
