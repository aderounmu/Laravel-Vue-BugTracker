<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Bug;
use App\Http\Resources\Bug as BugResource;

class BugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $bugs = Bug::all()->where('project_id','=',$id);
        return BugResource::collection($bugs);

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
        $bug = new Bug;
        
            $bug->Title = $request->input('Title');
            //$bug->created_at =  $request->input('created_at') ;
        //$bug->updated_at =  $request->input('updated_at');
            $bug->Description =  $request->input('Description');
            $bug->Category = $request->input('Category');
            $bug->Priority = $request->input('Priority');
            $bug->Sprint = $request->input('Sprint');
            $bug->Version = $request->input('Version');
            $bug->Environment = $request->input('Environment') ;
            $bug->Components = $request->input('Components');
            $bug->Labels= $request->input('Labels');
            $bug->project_id = $request->input('project_id');
            $bug->created_by = $request->input('created_by');
        
        if($bug->save()){
            return ['message' => 'bug successfully added'];
        }else{
            return response()->json([
                "message" => "no bug was added" 
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
        $bug = Bug::findOrFail($id);
        return new BugResource($bug);
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
        $bug = Bug::findOrFail($id);

            $bug->Title = $request->input('Title');
            //$bug->created_at =  $request->input('created_at') ;
            $bug->updated_at = $request->input('updated_at');
            $bug->Description =  $request->input('Description');
            $bug->Category = $request->input('Category');
            $bug->Priority = $request->input('Priority');
            $bug->Sprint = $request->input('Sprint');
            $bug->Version = $request->input('Version');
            $bug->Environment = $request->input('Environment') ;
            $bug->Components = $request->input('Components');
            $bug->Labels= $request->input('Labels');
            //$bug->project_id = $request->input('project_id');
            //$bug->created_by = $request->input('created_by');
        
        if($bug->save()){
            return ['message' => 'bug successfully added'];
        }else{
            return response()->json([
                "message" => "no bug was added" 
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
        //
        $bug = Bug::findOrFail($id);
        //deleting all asigned users to a bug 
        $bug->assigned_users()->detach();
        //delete bug 
        $bug->delete();
        return ['message' => 'bug successfully been deleted'];
    }

     /**
     * Adds a specified user to a bug.
     *
     * @param  int  $bug_id
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function assignUser($bug_id , $user_id){
        $bug = Bug::findOrFail($bug_id);
        if(
            $bug->assigned_users()->where('id','=',$user_id)->count() < 1
        ){
            $bug->assigned_users()->attach($user_id,['Admin' => false]);
            return response()->json([
                "message" => "user has been assigned to this bug" 
            ], 200);

        }else{
            return response()->json([
                "message" => "user has been assigned to this bug already " 
              ], 400);
        }
    }
     /**
     * remove a specified user to a bug.
     *
     * @param  int  $bug_id
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */

    public function unassignUser($bug_id , $user_id){
        $bug = Bug::findOrFail($bug_id);
        if(
            $bug->assigned_users()->where('id','=',$user_id)->count() < 1
        ){
            $bug->assigned_users()->detach($user_id);
            return response()->json([
                "message" => "user has been assigned to this bug" 
            ], 200);

        }else{
            return response()->json([
                "message" => "user has been assigned to this bug already " 
              ], 400);
        }
    }
}
