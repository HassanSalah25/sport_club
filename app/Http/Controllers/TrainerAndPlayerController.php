<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrainerAndPlayerRequest;
use App\Http\Requests\UpdateTrainerAndPlayerRequest;
use App\Models\Branchs;
use App\Models\EventTrainerPlayers;
use App\Models\Players;
use App\Models\Receipts;
use App\Models\ReceiptTypes;
use App\Models\Sports;
use App\Models\Stadium;
use App\Models\StadiumsRentTable;
use App\Models\TrainerAndPlayer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainerAndPlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Players::get();
        $users = User::orderBy('created_at','DESC')->where('is_trainer', '1')->get();
        $sports = Sports::get();
        $stadiums = Stadium::get();
        $branches = Branchs::get();
        return view('Dashboard.TrainerAndPlayers.index', compact('players', 'users', 'sports', 'stadiums', 'branches'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if ($request->ajax()) {
            $events = [];
            $data = TrainerAndPlayer::get();
            foreach ($data as $event) {

                $events[] = [
                    "id" => $event->id,
                    'title' => $event->stadiums->name . '. C:' . $event->traniers->name . '. S:' . $event->sports->name,
                    'start' => $event->time_from,
                    'end' => $event->time_to,
                ];

            }
            return response()->json($events);
        }
//        return  view('Dashboard.TrainerAndPlayers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreTrainerAndPlayerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrainerAndPlayerRequest $request)
    {
//        $request->repeated;
//        dd($request->all());
        $data = $request->all();
        $validator = Validator::make($data, [
            'to' => 'required|date_format:H:i|after:from',
            // Add other validation rules here
        ], [
            'to.after' => 'من الساعة يجب ان يكون قبل الي الساعة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->first('to')
            ]);
        }

        $time_from = Carbon::parse($request->day . ' ' . $request->from)->toDateTimeString();
        $time_to = Carbon::parse($request->day . ' ' . $request->to)->toDateTimeString();

        // Check for time conflicts
        $conflictstp = TrainerAndPlayer::where('stadium_id', $request->stadium_id)
            ->where(function ($query) use ($time_from,$time_to) {
                $query->where(function ($q) use ($time_from) {
                    $q->where('time_from', '<=', $time_from)->where('time_to', '>=', $time_from);
                })->orWhere(function ($q) use ($time_to) {
                    $q->where('time_from', '<=', $time_to)->where('time_to', '>=', $time_to);
                });
            })
            ->count();

        $conflictssr = StadiumsRentTable::where('stadium_id', $request->stadium_id)
            ->where(function ($query) use ($time_from,$time_to) {
                $query->where(function ($q) use ($time_from) {
                    $q->where('time_from', '<=', $time_from)->where('time_to', '>=', $time_from);
                })->orWhere(function ($q) use ($time_to) {
                    $q->where('time_from', '<=', $time_to)->where('time_to', '>=', $time_to);
                });
            })
            ->count();

        if ($conflictstp > 0 || $conflictssr > 0) {
            return response()->json([
                'status' => 400,
                'error' => 'يوجد تعارض زمني. ميعاد آخر موجود في نفس الفترة الزمنية.'
            ]);

        }
        if ($request->repeated == "true") {
            $startDate = Carbon::parse($time_from);
            $endDate = Carbon::parse($time_to);
            for ($i = 1; $i <= 30; $i++) {
                $event = TrainerAndPlayer::create([
                    'branch_id' => $request->branch_id,
                    'stadium_id' => $request->stadium_id,
                    'trainer_id' => $request->user_id,
                    'sport_id' => $request->sport_id,
                    'level_id' => $request->level_id,
                    'day' => $startDate->format('l'),
                    'date' => $startDate->toDate(),
                    'time_from' => $startDate,
                    'time_to' => $endDate,
                ]);
                foreach ($request->player_id as $player) {
                    EventTrainerPlayers::create([
                        'player_id' => $player,
                        'event_id' => $event->id,
                    ]);
                }
                $startDate->addDay();
                $endDate->addDay();
            }
        } else {
            $event = TrainerAndPlayer::create([
                'branch_id' => $request->branch_id,
                'stadium_id' => $request->stadium_id,
                'trainer_id' => $request->user_id,
                'sport_id' => $request->sport_id,
                'level_id' => $request->level_id,
                'day' => Carbon::parse($request->day)->format('l'),
                'date' => $request->day,
                'time_from' => $time_from,
                'time_to' => $time_to,
            ]);
            foreach ($request->player_id as $player) {
                EventTrainerPlayers::create([
                    'player_id' => $player,
                    'event_id' => $event->id,
                ]);
            }
        }

      /*  Receipts::create([
            'user_id'=>auth()->user()->id,
            'type_of_from'=>'others',
            'from'=>35,
            'to'=>ReceiptTypes::where('type','Save_money')->where('branch_id',2)->first()->id,
            'amount'=>,
            'paid'=>$request->paid,
            'statement'=>$request->statement,
            'date_receipt'=>$request->date,
            'price_list_id'=>$priceListId,
            'package_id'=>$packageId,
            'payer'=>$request->payer,
            'branch_id'=>$request->branch_id,
        ]);*/
        $data = TrainerAndPlayer::get();
        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\TrainerAndPlayer $trainerAndPlayer
     * @return \Illuminate\Http\Response
     */
    public function show(TrainerAndPlayer $trainerAndPlayer, Request $request)
    {

        if ($request->ajax()) {
            $events = [];
            $data = TrainerAndPlayer::with('stadiums')->with('traniers')
                ->with('EventTrainer.players')
                ->where('id', $request->id)->first();
//            dd($data);
            $players = '';
            $stadium_name = '';
            $trainer_name = '';
            $stadium_name = $data->stadiums->name;
            $trainer_name = $data->traniers->name;
            $name = [];
            foreach ($data->EventTrainer as $ev) {
                array_push($name, $ev->players->id);

            }

            return response()->json(['event' => $data, 'players' => $name, 'stadium_name' => $stadium_name, 'trainer_name' => $trainer_name]);
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TrainerAndPlayer $trainerAndPlayer
     * @return \Illuminate\Http\Response
     */
    public function edit(TrainerAndPlayer $trainerAndPlayer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateTrainerAndPlayerRequest $request
     * @param \App\Models\TrainerAndPlayer $trainerAndPlayer
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreTrainerAndPlayerRequest $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'to' => 'required|date_format:H:i|after:from',
            // Add other validation rules here
        ], [
            'to.after' => 'من الساعة يجب ان يكون قبل الي الساعة',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->first('to')
            ]);
        }
        $time_from = Carbon::parse($request->day . ' ' . $request->from)->toDateTimeString();
        $time_to = Carbon::parse($request->day . ' ' . $request->to)->toDateTimeString();

        $trainerAndPlayer = TrainerAndPlayer::find($request->trainerAndPlayer_id);

        $request->repeated;
        // Check for time conflicts

        if ($request->repeated == "true") {

            for ($i = 0; $i <= 30; $i++)
            {

                $start = Carbon::parse($request->start);
                $end = Carbon::parse($request->end);
                $conflictstp = TrainerAndPlayer::where('stadium_id', $request->stadium_id)
                    ->where(function ($query) use ($start,$end) {
                        $query->where(function ($q) use ($start) {
                            $q->where('time_from', '<=', $start)->where('time_to', '>=', $start);
                        })->orWhere(function ($q) use ($end) {
                            $q->where('time_from', '<=', $end)->where('time_to', '>=', $end);
                        });
                    })
                    ->count();

                $conflictssr = StadiumsRentTable::where('stadium_id', $request->stadium_id)
                    ->where(function ($query) use ($start,$end) {
                        $query->where(function ($q) use ($start) {
                            $q->where('time_from', '<=', $start)->where('time_to', '>=', $start);
                        })->orWhere(function ($q) use ($end) {
                            $q->where('time_from', '<=', $end)->where('time_to', '>=', $end);
                        });
                    })
                    ->count();

                if ($conflictstp > 0 || $conflictssr > 0) {
                    return response()->json([
                        'status' => 400,
                        'error' => 'يوجد تعارض زمني. ميعاد آخر موجود في نفس الفترة الزمنية.'
                    ]);

                }
            }

            $startDate = Carbon::parse($time_from);
            $endDate = Carbon::parse($time_to);

            for ($i = 1; $i <= 30; $i++) {
                $trainerAndPlayer->update([
                    'branch_id' => $request->branch_id,
                    'stadium_id' => $request->stadium_id,
                    'trainer_id' => $request->user_id,
                    'sport_id' => $request->sport_id,
                    'level_id' => $request->level_id,
                    'day' => $startDate->format('l'),
                    'date' => $startDate->toDate(),
                    'time_from' => $startDate,
                    'time_to' => $endDate,
                ]);
                $trainerAndPlayer->event()->delete();
                foreach ($request->player_id as $player) {
                    EventTrainerPlayers::create([
                        'player_id' => $player,
                        'event_id' => $trainerAndPlayer->id,
                    ]);
                }
                $startDate->addDay();
                $endDate->addDay();
            }
        } else {

            $conflictstp = TrainerAndPlayer::where('stadium_id', $request->stadium_id)
                ->where('trainer_id', '!=', $request->trainer_id)
                ->where('sport_id', '!=', $request->sport_id)
                ->where(function ($query) use ($time_from,$time_to) {
                    $query->where(function ($q) use ($time_from) {
                        $q->where('time_from', '<=', $time_from)->where('time_to', '>=', $time_from);
                    })->orWhere(function ($q) use ($time_to) {
                        $q->where('time_from', '<=', $time_to)->where('time_to', '>=', $time_to);
                    });
                })
                ->count();

            $conflictssr = StadiumsRentTable::where('stadium_id', $request->stadium_id)
                ->where(function ($query) use ($time_from,$time_to) {
                    $query->where(function ($q) use ($time_from) {
                        $q->where('time_from', '<=', $time_from)->where('time_to', '>=', $time_from);
                    })->orWhere(function ($q) use ($time_to) {
                        $q->where('time_from', '<=', $time_to)->where('time_to', '>=', $time_to);
                    });
                })
                ->count();

            if ($conflictstp > 0 || $conflictssr > 0) {
                return response()->json([
                    'status' => 400,
                    'error' => 'يوجد تعارض زمني. ميعاد آخر موجود في نفس الفترة الزمنية.'
                ]);

            }
            $trainerAndPlayer->update([
                'stadium_id' => $request->stadium_id,
                'trainer_id' => $request->user_id,
                'sport_id' => $request->sport_id,
                'level_id' => $request->level_id,
                'day' => Carbon::parse($request->day)->format('l'),
                'date' => $request->day,
                'time_from' => $time_from,
                'time_to' => $time_to,
            ]);
            $trainerAndPlayer->event()->delete();
            foreach ($request->player_id as $player) {
                EventTrainerPlayers::create([
                    'player_id' => $player,
                    'event_id' => $trainerAndPlayer->id,
                ]);
            }


        }
        $data = TrainerAndPlayer::get();
        return response()->json($data, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TrainerAndPlayer $trainerAndPlayer
     * @return \Illuminate\Http\Response
     */
    public function destroy(StoreTrainerAndPlayerRequest $request)
    {
        $event = TrainerAndPlayer::find($request->id);
        EventTrainerPlayers::where('event_id', $request->id)->delete();
        $event->delete();

    }
}
