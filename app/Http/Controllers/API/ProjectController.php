<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use App\Bug;
use App\Http\Resources\Project as ProjectResource;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //this displays a list of the projects

        $projects = Project::all();
        return ProjectResource::collection($projects);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $project = new Project ;
       // $project->id = $request->input('id');
        $project->Title = $request->input('Title');
        $project->Description = $request->input('Description');
        $project->created_by = $request->input('created_by');

        if($project->save()){
        $project->assigned_users()->attach(
            $request->input('created_by'),
            [
                'Admin' => true
            ]
        );

        return ['message' => 'project successfully added'];
        }else{
             return response()->json([
               "message" => "no project was added" 
             ], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $project = Project::findOrFail($id);
        return new ProjectResource($project);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $project = Project::findOrFail($id);
        $project->Title = $request->input('Title');
        $project->Description = $request->input('Description');
        $project->created_by = $request->input('created_by');

        if($project->save()){
            return ['message' => 'project successfully added'];
        }else{
             return response()->json([
               "message" => "no project was added" 
             ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete
        $project = Project::findOrFail($id);
        //delete all bugs assigned users
        $bugs = $project->bugs;
        for ($i=0; $i < count($bugs); $i++) { 
            Bug::find($bugs[$i]['id'])->assigned_users()->detach();          
        }
        //delete all assigned bugs
        $project->bugs()->delete();
        //delete all assigned users relationship
        $project->assigned_users()->detach();
        //delete project 
        $project->delete();

        return response()->json([
            "message" => "Project has been deleted" 
        ], 200);

    }

    public function test($id){
        $project = Project::findOrFail($id);
        $bugs = $project->bugs;
        $bugs_assigned_user = [];
        return $bugs_assigned_user;//response()->json($bugs_assigned_user, 200);
    }

    /**
     * Adds a specified user to a project.
     *
     * @param  int  $project_id
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function assignUser($project_id , $user_id){
        $project = Project::findOrFail($project_id);
        if(
            $project->assigned_users()->where('id','=',$user_id)->count() < 1
        ){
            $project->assigned_users()->attach($user_id,['Admin' => false]);
            return response()->json([
                "message" => "user has been assigned to this project" 
            ], 200);

        }else{
            return response()->json([
                "message" => "user has been assigned to this project already " 
              ], 400);
        }
    }
     /**
     * remove a specified user to a project.
     *
     * @param  int  $project_id
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */

    public function unassignUser($project_id , $user_id){
        $project = Project::findOrFail($project_id);
        if(
            $project->assigned_users()->where('id','=',$user_id)->count() < 1
        ){
            $project->assigned_users()->detach($user_id);
            return response()->json([
                "message" => "user has been assigned to this project" 
            ], 200);

        }else{
            return response()->json([
                "message" => "user has been assigned to this project already " 
              ], 400);
        }
    }

    /**
     * add a specified user as admin of a project.
     *
     * @param  int  $project_id
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */


    public function assignAdmin($project_id , $user_id){

        $project = Project::findOrFail($project_id);
        if(
            $project->assigned_users()->where('id','=',$user_id)->count() > 1
        ){
            $project->assigned_users()->updatExistingPivot($user_id,['Admin' => true]);
            return response()->json([
                "message" => "user has been assigned admin to this project" 
            ], 200);

        }else{
            return response()->json([
                "message" => "user has been not been assigned to this project  " 
              ], 400);
        }
    }
    /**
     * remove a specified user from being admin of a project.
     *
     * @param  int  $project_id
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */

    public function unassignAdmin($project_id , $user_id){

        $project = Project::findOrFail($project_id);
        if(
            $project->assigned_users()->where('id','=',$user_id)->count() > 1
        ){
            $project->assigned_users()->updatExistingPivot($user_id,['Admin' => false]);
            return response()->json([
                "message" => "user has been unassigned as admin to this project" 
            ], 200);

        }else{
            return response()->json([
                "message" => "user has been not been assigned to this project " 
              ], 400);
        }
    }


}
