<?php

namespace App\Http\Controllers;

use App\Models\Players;
use App\Models\Tournaments;
use App\Models\TournamentSubscriptions;
use App\Http\Requests\StoreTournamentSubscriptionsRequest;
use App\Http\Requests\UpdateTournamentSubscriptionsRequest;
use Illuminate\Http\Request;

class TournamentSubscriptionsController extends Controller
{
//TournamentSubscription
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tournaments_subscriptions = TournamentSubscriptions::with('players')->get();
        $tournaments = Tournaments::with('tournament_branches.branches')->with('tournament_subscriptions.players')->get();

//        dd($tournaments);
        return view('Dashboard.TournamentSubscription.index',compact('tournaments'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tournaments = Tournaments::with('tournament_branches.branches')->get();
//        dd($tournaments);
        return view('Dashboard.TournamentSubscription.create',compact('tournaments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTournamentSubscriptionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTournamentSubscriptionsRequest $request)
    {
       $players_id = count($request->player_id);
       for($x=0; $x < $players_id; $x++){
          TournamentSubscriptions::create([
              'tournament_id'=>$request->tournament_id,
              'player_id'=>$request->player_id[$x],
          ]);

       }
        return redirect()->route('tournament-subscription.index')->with('message','تم اضافه اشتراك  المسابقه بنجاح ');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TournamentSubscriptions  $tournamentSubscriptions
     * @return \Illuminate\Http\Response
     */
    public function show(TournamentSubscriptions $tournamentSubscriptions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TournamentSubscriptions  $tournamentSubscriptions
     * @return \Illuminate\Http\Response
     */
    public function edit(TournamentSubscriptions $tournamentSubscriptions, $id)
    {
//        dd($id);
        $tournament_edit = Tournaments::find($id);
//        $players = Players::where('branch_id', $tournament_edit->branch_id)->get();
        $tournaments = Tournaments::with('tournament_branches.branches')->get();

        return view('Dashboard.TournamentSubscription.edit',compact('tournaments','tournament_edit'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTournamentSubscriptionsRequest  $request
     * @param  \App\Models\TournamentSubscriptions  $tournamentSubscriptions
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTournamentSubscriptionsRequest $request, TournamentSubscriptions $tournamentSubscriptions)
    {
        TournamentSubscriptions::where('tournament_id',$request->tournament_id)->delete();
        $players_id = count($request->player_id);
        for($x=0; $x < $players_id; $x++){
            TournamentSubscriptions::create([
                'tournament_id'=>$request->tournament_id,
                'player_id'=>$request->player_id[$x],
            ]);

        }
        return redirect()->route('tournament-subscription.index')->with('message','تم تعديل اشتراك  المسابقه بنجاح ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TournamentSubscriptions  $tournamentSubscriptions
     * @return \Illuminate\Http\Response
     */
    public function destroy(TournamentSubscriptions $tournamentSubscriptions,$id)
    {
        TournamentSubscriptions::where('tournament_id',$id)->delete();
        return redirect()->route('tournament-subscription.index')->with('error','تم حذف اشتراك  المسابقه بنجاح ');


    }

    /*
     *
     * */
    public function getTournamentInformation(Request $request){
//        dd($request->all());
        $tournament = Tournaments::with('tournament_branches.branches.players')->find($request->tournament_id);
         $html_branches ='';
         $html_players ='';
           foreach ($tournament->tournament_branches as $branch){
               $name = $branch->branches->name;
               $html_branches.=<<<line
             <option selected value="$branch->branch_id"> $name </option>
line;
//               dd($branch);
              foreach ($branch->branches->players as $player ){
                  $selected =  $this->getSelectedPlayers($player->id);
                  $html_players.=<<<line
             <option $selected value="$player->id"> $player->name </option>

line;

              }
           }
        return     \Response::json(['branches'=>$html_branches,'players'=>$html_players])  ;
    }

    /*
     *
     * */
    public function getSelectedPlayers($player_id){
        $playerInTournament = TournamentSubscriptions::where('player_id',$player_id)->get();
        if(!$playerInTournament->isEmpty()){
            return "selected";
        }
        return ' ';


    }
}
