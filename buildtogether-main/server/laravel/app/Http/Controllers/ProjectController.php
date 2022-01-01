<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Project::all();
    }

    public function searchByString(String $search)
    {
        $projects = Project::where(strtoupper('name'), 'like', '%'.strtoupper($search).'%')->get();
        return response($projects, 200);

    }


    public function myProjects()
    {
        $projects=Project::where('owner' ,'=', (Auth::id()))->get();
        return $projects;
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
            'name'=> 'required|min:3',
            'summary' => 'required|min:50',
            'ptype'=>['required',Rule::in(['longTerm', 'hackathon'])],
            'category'=>['required',Rule::in(['technology', 'marketing','education','finance','business'])],
            'totalFund' => 'nullable',
            'achievedFund' => 'nullable',
            'startDate' => 'required_if:ptype,==,hackathon',
            'endDate' => 'required_if:ptype,==,hackathon',
            'photo' => 'nullable|image',

        ]);


//data: append
        $project = new Project([
            'name'=> $request->get('name'),
            'summary' => $request->get('summary'),
            'ptype'=>$request->get('ptype'),
            'category'=>$request->get('category'),
            'totalFund' => $request->get('totalFund'),
            'achievedFund' =>$request->get('achievedFund'),
            'startDate' => $request->get('startDate'),
            'endDate' => $request->get('endDate'),
            'photo'=> $request->get('photo'),
            'owner' => auth()->user()->id, 
        ]);
        $project->save();
        return response($project, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return $project;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        if(($project->owner) == (Auth::id())){
            $data = $request->validated();
            $project->update($data);
            return $project;
        }
        else{
            return response()->json(['message' => 'Cannot modify another user project'], 401);
        } 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {  
        if(($project->owner)==(auth()->user()->id)){
            $project->delete();
            return response()->json(['message' => 'Project deleted successfully'], 200);
        }
        else{
            return response()->json(['message' => 'Cannot delete another user project'], 401);
        } 
    }


}
