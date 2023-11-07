<?php

namespace App\Http\Controllers;

use App\Models\Branchs;
use App\Models\TrainerAndPlayer;
use Illuminate\Http\Request;

class AdminReport extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subscription_reports(Request $request)
    {
        //

        // Retrieve and process filter parameters from the request
        $branch = $request->input('branch_id');
        $startDate = $request->input('fromDate');
        $endDate = $request->input('toDate');
        // Add more filter parameters as needed

        $trainer_players = TrainerAndPlayer::query()->orderBy('id','DESC');

        if ($branch) {
            $trainer_players->where('branch_id', $branch);
        }
        if ($startDate && $endDate) {
            $trainer_players->whereBetween('date', [$startDate, $endDate]);
        }
        // Add more filter conditions for other parameters

        // Fetch the filtered report data
        $reportsData = $trainer_players->paginate(25);
        $branches = Branchs::all();
        // Return the report view with the filtered data
        return view('Dashboard.reports.subscription_reports', compact('reportsData','branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function schedules_reports(Request $request)
    {
        //

        // Retrieve and process filter parameters from the request
        $branch = $request->input('branch_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        // Add more filter parameters as needed

        $trainer_players = TrainerAndPlayer::query()->orderBy('id','DESC');

        if ($branch) {
            $trainer_players->where('branch_id', $branch);
        }
        if ($startDate && $endDate) {
            $trainer_players->whereBetween('date', [$startDate, $endDate]);
        }
        // Add more filter conditions for other parameters

        $branches = Branchs::all();
        // Fetch the filtered report data
        $reportsData = $trainer_players->paginate(25)->groupBy('day');
        return view('Dashboard.reports.schedules_reports', compact('reportsData','branches'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
