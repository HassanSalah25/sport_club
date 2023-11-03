<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLevelsRequest;
use App\Http\Requests\UpdateLevelsRequest;
use App\Models\Branches_sports;
use App\Models\Branchs;
use App\Models\Levels;
use App\Models\Sports;
use App\Models\SportsAndLevelTrainer;
use Illuminate\Http\Request;

class LevelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Levels::with('sports.branches')->paginate(10);
//        dd($levels);
        return view('Dashboard.Levels.index', compact('levels'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branchs::get();
        return view('Dashboard.Levels.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreLevelsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLevelsRequest $request)
    {
//        dd($request->all());
        $level = Levels::create([
            "name" => $request->name
        ]);
        $sports = $request->sport_id;

        $level->sports()->sync($sports);
        return redirect()->route('level.index')->with('message', 'تم اضافه المستوي بنجاح ');


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Levels $levels
     * @return \Illuminate\Http\Response
     */
    public function show(Levels $levels)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Levels $levels
     * @return \Illuminate\Http\Response
     */
    public function edit(Levels $level)
    {
        $branches = Branchs::get();

        return view('Dashboard.Levels.edit', compact('branches', 'level'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateLevelsRequest $request
     * @param \App\Models\Levels $levels
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLevelsRequest $request, Levels $level)
    {
//        dd($level);
        $level->name = $request->name;
        $level->save();
        $sports = $request->sport_id;
        $level->sports()->sync($sports);
        return redirect()->route('level.index')->with('message', 'تم تعديل المستوي بنجاح ');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Levels $levels
     * @return \Illuminate\Http\Response
     */
    public function destroy(Levels $level)
    {
        $level->sports()->detach();
        $level->delete();
        return redirect()->route('level.index')->with('error', 'تم حذف المستوي بنجاح ');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Levels $levels
     * @return \Illuminate\Http\Response
     */
    public function getSports(Request $request)
    {
//    dd($request->all());
        $branches_request = $request->branch_id;
        $stadium_request = $request->stadium_id;
        if($branches_request){
            $levels = Sports::whereHas('branches', function ($query) use ($branches_request) {
                if (is_array($branches_request)) {
                    $query->whereIn('branch_id', $branches_request);

                } else {
                    $query->where('branch_id', $branches_request);

                }

            })->get();

        }
        if($stadium_request){
            $levels = Sports::whereHas('stadium', function ($query) use ($stadium_request) {

                    $query->where('stadium.id', $stadium_request);


            })->get();

        }

        if ($request->level_id) {
            $level = Levels::with('sports')->find($request->level_id);
        }
        $selected = '';
        $option = '';
        $option .= "
      <option value='' >اختر لعبة </option> ";
        foreach ($levels as $sport) {
            if ($request->level_id) {

                foreach ($level->sports as $lv) {
                    if ($lv->id == $sport->id)
                        $selected = 'selected';
                }
            }
            if ($request->sport_id) {
                if ($request->sport_id == $sport->id)
                        $selected = 'selected';

            }
            $option .= "
      <option value=$sport->id $selected > $sport->name </option> ";
            $selected = ' ';
        }

        return \Response::json(['data' => $option]);

    }

    public function getLevels(Request $request)
    {
        $levels = Levels::whereHas('sports', function ($query) use ($request) {
            $query->where('sports.id', $request->sport_id);
        })->get();

        $selected = '';
        $option = ' <option value="" >اختر مستوي </option>    ';

        foreach ($levels as $level) {
                if ($request->level_id == $level->id) {
                    $selected = 'selected';
                }
            $option .= "
      <option $selected value=$level->id > $level->name </option> ";
            $selected = '';

        }

        return \Response::json(['data' => $option]);


    }


}
