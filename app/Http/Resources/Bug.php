<?php

namespace App\Http\Resources;

use App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Bug as BugModel;

class Bug extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return[
            'Type' => 'Bug',
            'id'=> $this->id,
            'Title'=>$this->Title,
            'created_at' => $this->created_at ,
            'updated_at' => $this->update_at,
            'Description'=> $this->Description,
            'Category' =>$this->Category,
            'Priority' =>$this->Priority,
            'Sprint' =>$this->Sprint,
            'Version' =>$this->Version,
           'Environment'=>$this->Environment ,
            'Components' =>$this->Components,
            'Labels'=>$this->Labels ,
            'project_id' => $this->project_id,
            'created_by' => new UserResource(User::find($this->created_by)),
            'assigned_user'=> UserResource::collection(
                BugModel::find($this->id)->assigned_users
            ),
        ];
    }
}
