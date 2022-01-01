<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Position;
use App\Models\Project;
use App\Models\User;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
Use \Carbon\Carbon;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        return Application::All();
    }
    
     public function positionApplications($var1)
    { 
        return Application::where('position_id' , $var1)->get();
    }

    public function userApplications( $var1)
    {   return Application::where('applicant_id' , $var1)->get();
    }
    
    public function projectApplications($var1)
    {   //only project owner can see the applications to their projects
        $proj_owner=Project::where('id' ,'=', $var1)->get('owner');
        if($proj_owner->isEmpty()) 
             {return  response()->json(['message' => 'No project with this ID exists'], 401);}

        if(($proj_owner->first()->owner) == (Auth::id())){
            $positions=Position::where('project_id' , $var1)->get('id');
            return  Application::whereIn('position_id' , $positions)->get();}
            
            else{return response()->json(['message' => 'Cannot see applications of a project which is not yours'], 401);} 
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
    {
        $request->validate([
            'position_id' => 'required',
            'comment' => 'required|min:10',
             
        ]);
        $application = new Application([
            'position_id' => $request->get('position_id'),
            'applicant_id' => Auth::id(), 
            'applicationDate' => Carbon::today()->toDateString(),
            'comment' => $request->get('comment'),

        ]);
        $application->save();
        return response($application, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {   //only project owner can update the status of applications 
        //only status is updated (can be done in front)

        $proj_id=Position::where('id' ,'=', ($application->position_id))->first()->project_id;
        $proj_owner=Project::where('id' ,'=', $proj_id)->get('owner');

        if($proj_owner->isEmpty()) 
             {return  response()->json(['message' => 'No project with this ID exists'], 401);}
        if(($proj_owner->first()->owner) == (Auth::id())){
                $data=$request->validate([
                    'status' => ['required',Rule::in(['inProcess', 'accepted','rejected'])],      
                ]);
                $application->update($data);
                return $application;}
        else{
            return response()->json(['message' => 'Cannot modify application status of other users project'], 403);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //only application owners can delete their applications
        if(($application->applicant_id)==(auth()->user()->id)){
            $application->delete();
            return response()->json(['message' => 'Application deleted successfully'], 200);
        }
        else{
            return response()->json(['message' => 'Cannot delete another user application'], 401);
        } 
    }
}
