<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Project;
use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Investment::all();
    }
    
    public function userInvestments($user)
    {   return Investment::where('user_id' , $user)->get();
    }

    public function projectInvestments($project)
    {   return Investment::where('project_id' , $project)->get();
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
            'project_id' => ['required'],
            'amount' => ['required'],
        ]);
        $investment = new Investment([

            'user_id' => Auth::id(), 
            'project_id' => $request->get('project_id'),
            'amount' => $request->get('amount'),
        ]);
        $investment->save();
        //update the achievedFund in the project table
        $project=Project::where('id', $request['project_id']);
        $project->increment('achievedFund', $request['amount']);
        return  response()->json(['message' => 'Invested successfully!'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function show(Investment $investment)
    {
        return $investment;

    }
   
}
