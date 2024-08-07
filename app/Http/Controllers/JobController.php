<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class JobController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }   

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Job::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'salary' => 'required',
            'location' => 'required',
            'company' => 'required'
        ]);

        $job = $request->user()->jobs()->create($fields);
        return  $job;
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        return  $job;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        Gate::authorize('modify', $job);

        $fields = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'salary' => 'required',
            'location' => 'required',
            'company' => 'required'
        ]);

        $job->update($fields);
        return  $job;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        Gate::authorize('modify', $job);

        $job->delete();
        return ['message' => 'The post was deleted'];
    }

    public function myJobs(Job $job)
    {
        $job = Job::where('user_id', '=', Auth::user()->id)->get();
        return ['job' => $job];
    }
}
