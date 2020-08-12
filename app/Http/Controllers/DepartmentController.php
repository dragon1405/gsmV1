<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function index()
    {
        $departments = Department::orderBy('created_at', 'desc')->get();
        return view('departments.index', compact('departments'));
    }

    public function list()
    {
        $departments = Department::orderBy('created_at', 'desc')->get();
        return response()->json($departments);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $department = new Department();
        $department -> name = $request -> name;
        $department -> manager = $request -> manager;
        $department -> save();
        return;
    }


    public function show(Department $department)
    {
        //
    }


    public function edit(Department $department)
    {
        //
    }


    public function update(Request $request, Department $department)
    {
        //
    }


    public function destroy($id)
    {
        $department = Department::find($id);
        $department -> delete();
    }
}
