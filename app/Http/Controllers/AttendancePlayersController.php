<?php

namespace App\Http\Controllers;

use App\Models\AttendancePlayers;
use App\Http\Requests\StoreAttendancePlayersRequest;
use App\Http\Requests\UpdateAttendancePlayersRequest;
use App\Models\Players;
use App\Models\TrainerAndPlayer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendancePlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->CanDoAction(['administrator','superadministrator'],'Attendance-players-read');
        $now = Carbon::now()->timezone('Africa/Cairo')->toDateTimeString();

        $players =  TrainerAndPlayer::orderBy('created_at','DESC')
        ->with(['EventTrainer.players'])
            ->where(function ($query) use ($now) {
                $query->where('time_from', '<=', $now)
                    ->where('time_to', '>=', $now);
            })
            ->paginate(10);
//            dd($players);
//        $players = Players::paginate(10);
    return view('Dashboard.Attendance.index',compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAttendancePlayersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $log_time = Carbon::now()->timezone('Africa/Cairo')->format('Y-m-d H:i:s');
        $today = Carbon::today();
      $checkAttend =   AttendancePlayers::where('player_id',$request->player_id)->whereDate('created_at',$today)->get();
//    dd($checkAttend);
      if($checkAttend->isEmpty()){
        if($request->check == 'in'){
            $attendance =  new AttendancePlayers();
            $attendance->player_id=$request->player_id;
            $attendance->check_in = $log_time;
            $attendance->save();
            return redirect()->back()->with('message','تم تسجيل حضور الاعب');
        }

        }
        if($request->check=='out'){
            $attendance_id =   $checkAttend[0]->id;

            $attendance =   AttendancePlayers::find($attendance_id);
            $attendance->player_id=$request->player_id;
            $attendance->check_out = $log_time;

            $attendance->save();
            return redirect()->back()->with('message','تم تسجيل انصراف الاعب');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AttendancePlayers  $attendancePlayers
     * @return \Illuminate\Http\Response
     */
    public function show(AttendancePlayers $attendancePlayers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AttendancePlayers  $attendancePlayers
     * @return \Illuminate\Http\Response
     */
    public function edit(AttendancePlayers $attendancePlayers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAttendancePlayersRequest  $request
     * @param  \App\Models\AttendancePlayers  $attendancePlayers
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttendancePlayersRequest $request, AttendancePlayers $attendancePlayers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttendancePlayers  $attendancePlayers
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttendancePlayers $attendancePlayers)
    {
        //
    }
}
