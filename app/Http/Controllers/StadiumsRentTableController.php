<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStadiumsRentTableRequest;
use App\Models\Branchs;
use App\Models\Players;
use App\Models\Receipts;
use App\Models\ReceiptTypes;
use App\Models\Sports;
use App\Models\Stadium;
use App\Models\StadiumRentCancellations;
use App\Models\StadiumsRentTable;
use App\Models\TrainerAndPlayer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class StadiumsRentTableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Players::get();
        $users = User::where('is_trainer', '1')->get();
        $sports = Sports::get();
        $stadiums = Stadium::get();
        $branches = Branchs::get();
        return view('Dashboard.StadiumsRentTables.index', compact('players', 'users', 'sports', 'stadiums', 'branches'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(StoreStadiumsRentTableRequest $request)
    {
        if ($request->ajax()) {
            $events = [];
            $data = StadiumsRentTable::get();
            $type = '';
            foreach ($data as $event) {
                if ($event->type == 'trainer') {
                    $type = 'C:';
                } else {
                    $type = 'MR:';

                }
                $events[] = [
                    "id" => $event->id,
                    'title' => $event->stadiums->name . $type . $event->name . '. P:' . $event->price,
                    'start' => $event->time_from,
                    'end' => $event->time_to,
                ];

            }
            return response()->json($events);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreStadiumsRentTableRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStadiumsRentTableRequest $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'to' => 'date_format:H:i|after:from',
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

        $from = $request->day . " " . $request->from;
        $to = $request->day . " " . $request->to;
        $name = $request->name;
        $type = 'strange';

        if ($request->user_id) {
            $user = User::find($request->user_id);
            $name = $user->name;
            $type = 'trainer';

        }



        $stadium = Stadium::find($request->stadium_id);
        if ($request->repeated == "true") {

            for ($i = 0; $i <= 30; $i++)
            {

                $start = Carbon::parse($from);
                $end = Carbon::parse($to);
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


            $startDate = Carbon::parse($from);
            $endDate = Carbon::parse($to);
            $total = 0;
            for ($i = 1; $i <= 30; $i++) {
                $event = StadiumsRentTable::create([
                    'stadium_id' => $request->stadium_id,
                    'user_id' => $request->user_id,
                    'name' => $name,
                    'type' => $type,
                    'date' => $request->day,
                    'price' => $stadium ->hour_fixed_rate,
                    'time_from' => $startDate,
                    'time_to' => $endDate,
                ]);
                $total += $event->price;
                $startDate->addDay();
                $endDate->addDay();
            }

            Receipts::create([
                'user_id'=>auth()->user()->id,
                'type_of_from'=>'others',
                'from'=>35,
                'to'=>ReceiptTypes::where('type','Save_money')->where('branch_id',$stadium->branch_id)->first()->id,
                'amount'=>$total,
                'date_receipt'=>Carbon::today(),
                'payer'=>   $type == 'trainer' ? $request->user_id : $name,
                'branch_id'=>$stadium->branch_id,
            ]);
        } else {

            $conflictstp = TrainerAndPlayer::where('stadium_id', $request->stadium_id)
                ->where(function ($query) use ($from,$to) {
                    $query->where(function ($q) use ($from) {
                        $q->where('time_from', '<=', $from)->where('time_to', '>=', $from);
                    })->orWhere(function ($q) use ($to) {
                        $q->where('time_from', '<=', $to)->where('time_to', '>=', $to);
                    });
                })
                ->count();

            $conflictssr = StadiumsRentTable::where('stadium_id', $request->stadium_id)
                ->where(function ($query) use ($from,$to) {
                    $query->where(function ($q) use ($from) {
                        $q->where('time_from', '<', $from)->where('time_to', '>', $from);
                    })->orWhere(function ($q) use ($to) {
                        $q->where('time_from', '<', $to)->where('time_to', '>', $to);
                    });
                })
                ->count();
            if ($conflictstp > 0 || $conflictssr > 0) {
                return response()->json([
                    'status' => 400,
                    'error' => 'يوجد تعارض زمني. ميعاد آخر موجود في نفس الفترة الزمنية.'
                ]);

            }
            $event = StadiumsRentTable::create([
                'stadium_id'=>$request->stadium_id,
                'user_id'=>$request->user_id,
                'name'=>$name,
                'type'=>$type,
                'date'=>$request->day,
                'price'=>$stadium ->hour_rate,
                'time_from'=>$from,
                'time_to'=>$to,
            ]);
            Receipts::create([
                'user_id'=>auth()->user()->id,
                'type_of_from'=>'others',
                'from'=>35,
                'to'=>ReceiptTypes::where('type','Save_money')->where('branch_id',$stadium->branch_id)->first()->id,
                'amount'=>$event->price,
                'date_receipt'=>Carbon::today(),
                'payer'=>   $type ? $request->user_id : $name,
                'branch_id'=>$stadium->branch_id,
            ]);
        }


        $data = StadiumsRentTable::get();
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\StadiumsRentTable $stadiumsRentTable
     * @return \Illuminate\Http\Response
     */
    public function show(StadiumsRentTable $stadiumsRentTable, StoreStadiumsRentTableRequest $request)
    {

        if ($request->ajax()) {
            $events = [];
            $data = StadiumsRentTable::with('stadiums')
                ->where('id', $request->id)->get();
            $type = '';

            if ($data[0]->type == 'trainer') {
                $type = 'كابتن';
            } else {
                $type = 'مستاحر';

            }
            $stadium = $data[0]->stadiums->name;
            $name = $data[0]->name;
            $price = $data[0]->price;


            $html = <<<line
     <tr>
                                                    <th class="text-nowrap" scope="row">الملعب</th>
                                                    <td colspan="5">$stadium</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-nowrap" scope="row">السعر</th>
                                                    <td colspan="5">$price</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-nowrap" scope="row">اسم صاحب الحجز </th>
                                                    <td colspan="5">$name</td>
                                                </tr>
                                                <tr>
                                                    <th class="text-nowrap" scope="row">كابتن او مستاجر</th>
                                                    <td colspan="5">$type</td>
                                                </tr>
line;

            return response()->json(["html" => $html]);

//            return response()->json(['players'=>$players,'stadium_name'=>$stadium_name,'trainer_name'=>$trainer_name]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\StadiumsRentTable $stadiumsRentTable
     * @return \Illuminate\Http\Response
     */
    public function edit(StadiumsRentTable $stadiumsRentTable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateStadiumsRentTableRequest $request
     * @param \App\Models\StadiumsRentTable $stadiumsRentTable
     * @return \Illuminate\Http\Response
     */
    public function update(StoreStadiumsRentTableRequest $request, StadiumsRentTable $stadiumsRentTable)
    {
        $conflictstp = TrainerAndPlayer::where('stadium_id', $request->stadium_id)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('time_from', '<=', $request->start)->where('time_to', '>=', $request->start);
                })->orWhere(function ($q) use ($request) {
                    $q->where('time_from', '<=', $request->end)->where('time_to', '>=', $request->end);
                });
            })
            ->count();

        $conflictssr = StadiumsRentTable::where('stadium_id', $request->stadium_id)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('time_from', '<=', $request->start)->where('time_to', '>=', $request->start);
                })->orWhere(function ($q) use ($request) {
                    $q->where('time_from', '<=', $request->end)->where('time_to', '>=', $request->end);
                });
            })
            ->count();

        if ($conflictstp > 0 || $conflictssr > 0) {
            return response()->json([
                'status' => 400,
                'error' => 'يوجد تعارض زمني. ميعاد آخر موجود في نفس الفترة الزمنية.'
            ]);

        }
        $event = StadiumsRentTable::find($request->id);
        $event->time_from = $request->start;
        $event->time_to = $request->end;
        $event->save();
        return response()->json($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\StadiumsRentTable $stadiumsRentTable
     * @return \Illuminate\Http\Response
     */
    public function destroy(StadiumsRentTable $stadiumsRentTable, StoreStadiumsRentTableRequest $request)
    {
//        dd($request->all());
        $StadiumRentCancellations = new StadiumRentCancellations();

        $event = StadiumsRentTable::find($request->id);

        $StadiumRentCancellations->stadium_id = $event->stadium_id;
        $StadiumRentCancellations->user_id = $event->user_id;
        $StadiumRentCancellations->name = $event->name;
        $StadiumRentCancellations->type = $event->type;
        $StadiumRentCancellations->price = $event->price;
        $StadiumRentCancellations->date = $event->date;
        $StadiumRentCancellations->time_from = $event->time_from;
        $StadiumRentCancellations->time_to = $event->time_to;

        $StadiumRentCancellations->from_who = $request->from_who;
        $StadiumRentCancellations->reason = $request->reason;

        $StadiumRentCancellations->save();


        $event->delete();
    }
}
