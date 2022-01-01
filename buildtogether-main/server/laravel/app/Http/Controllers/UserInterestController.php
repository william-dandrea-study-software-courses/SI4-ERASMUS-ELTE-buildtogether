<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use App\Models\User;
use Illuminate\Http\Request;

class UserInterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return $user->interests;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,User $user)
    {
        $InterestController = new InterestController;
        $interest= $InterestController->store($request);
        $interest['used_times'] +=1;
        $interest->save();
        $interest->users()->syncWithoutDetaching($user);
        return $interest;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Interest $interest)
    {
        $interest['used_times'] -=1;
        $interest->save();
        $interest->users()->detach($user);
        return response()->json(null, 204);
    }
}