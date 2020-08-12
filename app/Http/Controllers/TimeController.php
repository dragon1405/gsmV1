<?php

namespace App\Http\Controllers;

use App\Time;
use App\Project;
use App\User;
use DB;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\ExportAlltime;

use Illuminate\Http\Request;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectSel = Project::orderBy('id')->get();
        return view('times.index', compact('projectSel'));
    }
    public function list()
    {
        $timesD ['Time']= Time::all();
        return response()->json($timesD['Time']);
    }

    public function listR(){
        $timesR = Time::orderBy('created_at', 'desc')->get();
        return view('times.report', compact('timesR'));
    }

    public function reportT(){
        $timesR = Time::orderBy('created_at', 'desc')->get();
        return response()->json($timesR);
    }

// Envia los reportes ALL
    public function listAll(){
        $allTimes = Time::orderBy('created_at', 'desc')->paginate(15);
        $allTimesG= Time::orderBy('created_at', 'desc')->get();
        $allUsers = User::get();
        $allProjects = Project::get();
        return view('times.reportAll', compact('allTimes', 'allTimesG', 'allUsers', 'allProjects'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {

        $project_idA =json_decode($req ->item_project);
        $porcentageA =json_decode($req ->item_porcentage);

        foreach ($project_idA as $key => $proyecto) {
            $timeD = new Time ();

            $timeD -> user_id = auth()->user()->id;
            $timeD -> title = $proyecto;
            $timeD -> porcentage = $porcentageA[$key];
            $htm = $timeD -> porcentage * 8;
            $timeD -> hours = $htm / 100;
            $timeD -> date = $req ->date;
            $movies = Project::where('id','=',$proyecto)->value('color');
            $timeD -> color = $movies;
            $timeD -> textColor=$req ->textColor;
            $timeD -> save();
        }
        return;
        dd($timeD);

    }

    //Buscar

    public function search(Request $request)
    {
        $Busuario = $request ->get('Busuario');
        $Bproyecto = $request ->get('Bproyecto');
        $Bfi=$request->get('Bfi');

        $allTimes = Time::orderBy('created_at', 'desc')
        ->name($Busuario)
        ->project($Bproyecto)
        ->Bfecha($Bfi)
        ->paginate(15);

        $allTimesG = Time::orderBy('created_at', 'desc')
        ->name($Busuario)
        ->project($Bproyecto)
        ->Bfecha($Bfi)
        ->get();

          $allUsers = User::get();
        $allProjects = Project::get();
        return view('times.reportAll', compact('allTimes', 'allTimesG', 'allUsers', 'allProjects'));


    }

    public function Rpdf(){

        $alltimeP = Time::orderBy('created_at', 'desc')->get();
        $pdf =PDF::loadView('pdf.alltime', compact('alltimeP'));

        return $pdf->download('ReporteTime.pdf');
    }

    public function Rexcel(){
        return Excel::download(new ExportAlltime, 'ReporteTime.xlsx');
    }

    public function show(Time $time)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function edit(Time $time)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Time $time)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function destroy($ide)
    {
        $time = Time::findOrFail($ide);
        $time->delete();
    }
}
