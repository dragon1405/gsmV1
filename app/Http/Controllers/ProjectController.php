<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;

use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();
        return view('projects.index', compact('projects'));
    }


    public function list()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();
        return response()->json($projects);
    }

    public function listnameM()
    {
        $nameM = User::ordenBy('name', 'dec')->get();
        return response()->json($nameM);


    }


    public function store(Request $request)
    {
        $project = new  Project();
        $project ->id = $request -> id;
        $project ->description = $request -> description;
        $project ->project_manager = $request -> project_manager;
        $project ->address = $request -> address;
        $project ->cost = $request -> cost;
        $project ->color = $request -> color;
        $project -> save();
        return;
    }


    public function show(Project $project)
    {
        //
    }


    public function edit(Project $project)
    {
        //
    }


    public function update(Request $request, Project $project)
    {
        //
    }


    public function destroy($id)
    {
        $project = Project::find($id);
        $project -> delete();

    }
}
