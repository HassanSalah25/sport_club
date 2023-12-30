<?php

namespace App\Http\Controllers;

use App\Models\Branchs;
use App\Models\Players;
use App\Models\Stadium;
use App\Models\StadiumsRentTable;
use App\Models\TrainerAndPlayer;
use App\Models\User;
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
        if (\Auth::user()->hasRole('administrator')) {
            $branchIds = Branchs::get()->pluck('id')->toArray();
        } else {
            $branchIds = \Auth::user()->branches->pluck('id')->toArray();
        }
        // Retrieve and process filter parameters from the request
        $branch = $request->input('branch_id');
        $startDate = $request->input('fromDate');
        $endDate = $request->input('toDate');
        $search_keyword = $request->input('search_keyword');
        $player = $request->input('player');
        $trainer = $request->input('trainer');
        // Add more filter parameters as needed

        $trainer_players = TrainerAndPlayer::query()
            ->whereIn('branch_id',$branchIds)
            ->orderBy('id', 'DESC');
        if ($player) {
            $trainer_players->whereHas('players', function ($q) use ($player) {
                $q->where('player_id', $player);
            });
        }
        if ($trainer) {
            $trainer_players->where('trainer_id',$trainer);
        }
        if ($branch) {
            $trainer_players->where('branch_id', $branch);
        }
        if ($startDate && $endDate) {
            $trainer_players->whereBetween('date', [$startDate, $endDate]);
        }
        // Add more filter conditions for other parameters
        $trainers = User::where('is_trainer','1')->get();
        $players = Players::get();
        // Fetch the filtered report data
        $reportsData = $trainer_players->paginate(25);
        if (\Auth::user()->hasRole('administrator'))
            $branches = Branchs::get();
        else
            $branches = \Auth::user()->branches;
        // Return the report view with the filtered data
        return view('Dashboard.reports.subscription_reports',
            compact('reportsData', 'branches',
            'trainers','players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function schedules_reports(Request $request)
    {
        //
        if (\Auth::user()->hasRole('administrator')) {
            $branchIds = Branchs::get()->pluck('id')->toArray();
        } else {
            $branchIds = \Auth::user()->branches->pluck('id')->toArray();
        }
        // Retrieve and process filter parameters from the request
        $branch = $request->input('branch_id');
        $startDate = $request->input('fromDate');
        $endDate = $request->input('toDate');
        $search_keyword = $request->input('search_keyword');
        // Add more filter parameters as needed

        $stadiums_tent_table = StadiumsRentTable::query()
            ->whereHas('stadiums',function ($q) use ($branchIds) {
                $q->whereIn('branch_id',$branchIds);
            })
            ->orderBy('id', 'DESC');

        if ($branch) {
            $stadiums_tent_table->whereHas('stadiums', function ($q) use ($branch) {
                $q->where('branch_id', $branch);
            });
        }
        if ($search_keyword) {
            $stadiums_tent_table->where('name', 'like', "%" . $search_keyword . "%")
                ->orWhereHas('traniers', function ($q) use ($search_keyword) {
                    $q->where('name', 'like', "%" . $search_keyword . "%");
                });
        }
        if ($startDate && $endDate) {
            $stadiums_tent_table->where('date','>=', $startDate)
                ->where('date','<=', $endDate);
        }
        // Add more filter conditions for other parameters
        if (\Auth::user()->hasRole('administrator'))
            $branches = Branchs::get();
        else
            $branches = \Auth::user()->branches;
        // Fetch the filtered report data
        $reportsData = $stadiums_tent_table->paginate(25)->groupBy('day');
        return view('Dashboard.reports.schedules_reports', compact('reportsData', 'branches'));

    }

    public function stadiums_reports(Request $request)
    {
        if (\Auth::user()->hasRole('administrator')) {
            $branchIds = Branchs::get()->pluck('id')->toArray();
        } else {
            $branchIds = \Auth::user()->branches->pluck('id')->toArray();
        }
        $branch = $request->input('branch_id');
        // Get all times for every stadium on every day
        $stadiums = Stadium::get();
        $startDate = $request->input('fromDate');
        $endDate = $request->input('toDate');
        $new = collect([]);
        $reports = StadiumsRentTable::orderBy('stadium_id')
            ->whereHas('stadiums', function ($q) use ($branchIds) {
            $q->whereIn('branch_id', $branchIds);
        });
        $reports2 = TrainerAndPlayer::orderBy('stadium_id')
            ->whereHas('stadiums', function ($q) use ($branchIds) {
                $q->whereIn('branch_id', $branchIds);
            });
        if ($request->stadium) {
            $reports->where('stadium_id', $request->stadium);
            $reports2->where('stadium_id', $request->stadium);
        }
        if ($branch) {
            $reports->whereHas('stadiums', function ($q) use ($branch) {
                $q->where('branch_id', $branch);
            });
            $reports2->whereHas('stadiums', function ($q) use ($branch) {
                $q->where('branch_id', $branch);
            });
        }
        if ($startDate) {
            $reports->whereDate('time_from', $startDate);

            $reports2->whereDate('time_from', $startDate);
        }

        $reports = $new->merge($reports->get())->merge($reports2->get());

        $reports = $reports;
        if (\Auth::user()->hasRole('administrator'))
            $branches = Branchs::get();
        else
            $branches = \Auth::user()->branches;
        return view('Dashboard.reports.stadiums_reports',
            compact('reports', 'branches', 'stadiums'));
    }
}
