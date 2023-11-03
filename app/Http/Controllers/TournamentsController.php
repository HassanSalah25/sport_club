<?php

namespace App\Http\Controllers;

use App\Models\Branchs;
use App\Models\TournamentBranches;
use App\Models\Tournamentfiles;
use App\Models\Tournaments;
use App\Http\Requests\StoreTournamentsRequest;
use App\Http\Requests\UpdateTournamentsRequest;

class TournamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tournaments = Tournaments::with('tournament_branches.branches')->with('tournament_files')->get();
//        dd($tournaments);
        return view('Dashboard.Tournament.index',compact('tournaments'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branchs::get();

        return view('Dashboard.Tournament.create',compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTournamentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTournamentsRequest $request)
    {
        $tournament =  Tournaments::create([
            'name'=> $request->name,
            'date'=> $request->date,
            'subscribe_value'=> $request->subscribe_value,
            'cost'=> $request->cost,
        ]);
        for ($x=0; $x < count($request->branch_id); $x++){
              TournamentBranches::create([
                 'tournament_id'=>$tournament->id,
                 'branch_id'=>$request->branch_id[$x],
              ]);
        }
        for ($x=0; $x < count($request->repeater); $x++){
            Tournamentfiles::create([
                'tournament_id'=>$tournament->id,
                'name'=>$request->repeater[$x]['file_name'],
            ]);
        }
        return redirect()->route('tournament.index')->with('message','تم اضافه المسابقه بنجاح ');


//        $tournament->tournament_files()->create($request->repeater);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tournaments  $tournaments
     * @return \Illuminate\Http\Response
     */
    public function show(Tournaments $tournament)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tournaments  $tournaments
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournaments $tournament)
    {
        $branches = Branchs::get();

        return view('Dashboard.Tournament.edit',compact('tournament','branches'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTournamentsRequest  $request
     * @param  \App\Models\Tournaments  $tournaments
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTournamentsRequest $request, Tournaments $tournament)
    {
       $tournament->name=$request->name;
       $tournament->date=$request->date;
       $tournament->cost=$request->cost;
       $tournament->subscribe_value=$request->subscribe_value;
       $tournament->save();
       TournamentBranches::where('tournament_id',$tournament->id)->delete();
       Tournamentfiles::where('tournament_id',$tournament->id)->delete();
        for ($x=0; $x < count($request->branch_id); $x++){
            TournamentBranches::create([
                'tournament_id'=>$tournament->id,
                'branch_id'=>$request->branch_id[$x],
            ]);
        }
        for ($x=0; $x < count($request->repeater); $x++){
            Tournamentfiles::create([
                'tournament_id'=>$tournament->id,
                'name'=>$request->repeater[$x]['file_name'],
            ]);
        }
        return redirect()->route('tournament.index')->with('message','تم تعديل المسابقه بنجاح ');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tournaments  $tournaments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournaments $tournament)
    {
        TournamentBranches::where('tournament_id',$tournament->id)->delete();
        Tournamentfiles::where('tournament_id',$tournament->id)->delete();
        $tournament->delete();
        return redirect()->route('tournament.index')->with('error','تم حذف المسابقه بنجاح ');

    }
}
