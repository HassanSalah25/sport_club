<?php

namespace App\Http\Controllers;

use App\Models\TournamentPlayersDetails;
use App\Http\Requests\StoreTournamentPlayersDetailsRequest;
use App\Http\Requests\UpdateTournamentPlayersDetailsRequest;
use App\Models\Tournaments;
use Illuminate\Http\Request;

class TournamentPlayersDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tournaments = Tournaments::with('tournament_branches.branches')->get();
        return view('Dashboard.TournamentSubscription.TournamentDetails',compact('tournaments'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTournamentPlayersDetailsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTournamentPlayersDetailsRequest $request)
    {

        TournamentPlayersDetails::where('player_id',$request->player_id)->delete();

          TournamentPlayersDetails::create([
              'tournament_id'=>$request->tournament_id,
              'player_id'=>$request->player_id,
              'paid'=>$request->paid,
              'files_data'=>$request->files_data,
              'subscribe'=>$request->subscription,
              'place'=>$request->place,
              'notes'=>$request->notes,

          ]);
          return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TournamentPlayersDetails  $tournamentPlayersDetails
     * @return \Illuminate\Http\Response
     */
    public function show(TournamentPlayersDetails $tournamentPlayersDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TournamentPlayersDetails  $tournamentPlayersDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(TournamentPlayersDetails $tournamentPlayersDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTournamentPlayersDetailsRequest  $request
     * @param  \App\Models\TournamentPlayersDetails  $tournamentPlayersDetails
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTournamentPlayersDetailsRequest $request, TournamentPlayersDetails $tournamentPlayersDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TournamentPlayersDetails  $tournamentPlayersDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(TournamentPlayersDetails $tournamentPlayersDetails)
    {
        //
    }


    /*
     *
     *
     * */

    public function getTournamentInformation(Request $request){
//        dd($request->all());
        $tournament = Tournaments::with('tournament_branches.branches.players')->find($request->tournament_id);
        $html_branches ='';
        $html_players ='<option  value=""> اختار لاعب </option>';
        foreach ($tournament->tournament_branches as $branch){
            $name = $branch->branches->name;
            $html_branches.=<<<line
             <option selected value="$branch->branch_id"> $name </option>
line;

            foreach ($branch->branches->players as $player ){
                $html_players.=<<<line
             <option  value="$player->id"> $player->name </option>

line;

            }
        }
        return     \Response::json(['branches'=>$html_branches,'players'=>$html_players])  ;
    }


    /*
     *
     *
     * */

    public function getPlayerInformation(Request $request)
    {
       $playerInformation = TournamentPlayersDetails::where('player_id',$request->player_id)->get()->first();



       return \Response::json([$playerInformation])  ;
    }
}
