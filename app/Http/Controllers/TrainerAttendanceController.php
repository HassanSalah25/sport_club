<?php

namespace App\Http\Controllers;

use App\Models\AttendancePlayers;
use App\Models\TrainerAndPlayer;
use App\Models\TrainerAttendance;
use App\Http\Requests\StoreTrainerAttendanceRequest;
use App\Http\Requests\UpdateTrainerAttendanceRequest;
use Carbon\Carbon;

class   TrainerAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now()->timezone('Africa/Cairo')->toDateTimeString();
        $trainers= TrainerAndPlayer::with('traniers')
            ->where(function ($query) use ($now) {
                $query->where('time_from', '<=', $now)
                    ->where('time_to', '>=', $now);
            })
            ->paginate(10);
//        dd($trainers);
//        $players = Players::paginate(10);
        return view('Dashboard.Attendance.tranierAttendance',compact('trainers'));
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
     * @param  \App\Http\Requests\StoreTrainerAttendanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrainerAttendanceRequest $request)
    {
        $log_time = Carbon::now()->timezone('Africa/Cairo')->format('Y-m-d H:i:s');
        $today = Carbon::today();
        $checkAttend =   TrainerAttendance::where('trainer_id',$request->trainer_id)->whereDate('created_at',$today)->get();

        if($checkAttend->isEmpty()){
            if($request->check == 'in'){
                $attendance =  new TrainerAttendance();
                $attendance->trainer_id=$request->trainer_id;
                $attendance->check_in = $log_time;
                $attendance->save();
                return redirect()->back()->with('message','تم تسجيل حضور المدرب');
            }

        }
        if($request->check=='out'){
            $attendance_id =   $checkAttend[0]->id;

            $attendance =   TrainerAttendance::find($attendance_id);
            $attendance->trainer_id=$request->trainer_id;
            $attendance->check_out = $log_time;

            $attendance->save();
            return redirect()->back()->with('message','تم تسجيل انصراف المدرب');

        }
        if($checkAttend){
            return redirect()->back()->with('error','هذا المدرب سجل حضور بالفعل');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TrainerAttendance  $trainerAttendance
     * @return \Illuminate\Http\Response
     */
    public function show(TrainerAttendance $trainerAttendance)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TrainerAttendance  $trainerAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(TrainerAttendance $trainerAttendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTrainerAttendanceRequest  $request
     * @param  \App\Models\TrainerAttendance  $trainerAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrainerAttendanceRequest $request, TrainerAttendance $trainerAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TrainerAttendance  $trainerAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrainerAttendance $trainerAttendance)
    {
        //
    }
}
