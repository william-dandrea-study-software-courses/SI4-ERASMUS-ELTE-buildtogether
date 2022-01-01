<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Project;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Position::All();

    }

    public function projectPositions( $project)
    {
        return Position::where('project_id' , $project)->get();

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   //only the project owner can add position to the project
        
        $proj_owner = Project::where('id' ,'=',$request->get('project_id') )->get("owner");     
        if($proj_owner->isEmpty()) 
             {return  response()->json(['message' => 'No project with this ID exists'], 401);}

        if(($proj_owner->first()->owner) == (Auth::id())){
            $request->validate([
                'title' => ['required', 'string', 'max:30'],
                'project_id' => ['required'],
            ]);
            $position = new Position([
                'title' => $request->get('title'),
                'project_id' => $request->get('project_id'),
                'status' => $request->get('status'),

                
            ]);
            $position->save();
            return response($position, 201);
        }
        else{
            return response()->json(['message' => 'Cannot add a position to another user project'], 401);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        //only the project owner can delete positions
        $proj_id=Position::where('id' ,'=',$position->id)->get("project_id")->first()->project_id;        
        $proj_owner = Project::where('id' ,'=',$proj_id )->get("owner");     
        
        if($proj_owner->isEmpty()) 
             {return  response()->json(['message' => 'No project with this ID exists'], 401);}

        if(($proj_owner->first()->owner) == (Auth::id())){
            $position->delete();
            return response()->json(['message' => 'Position deleted successfully'], 200);
        }
        else{
            return response()->json(['message' => 'Cannot delete a position from another user project'], 401);
        } 
    }
}
