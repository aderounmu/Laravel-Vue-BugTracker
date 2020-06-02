<?php

namespace App\Http\Resources;

use App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Project as ProjectModel;


class Project extends JsonResource
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
        return [
            'Type' => 'Project',
            'id' => $this->id,
            'Title' => $this->Title,
            'Description' => $this->Description,
            'created_at' => $this->created_at,
            'Author' => new UserResource(User::find($this->created_by)),
            //'author' => $this->created_by,
            'assigned_users' => UserResource::collection(
                ProjectModel::find($this->id)->assigned_users
            ),
            'Administrators' => UserResource::collection(
                Project::find($this->id)->assigned_users()->where('admin','=',true)->get()
            )
        ];
    }
}
