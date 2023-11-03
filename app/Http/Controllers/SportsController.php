<?php

namespace App\Http\Controllers;

use App\Models\Sports;
use App\Http\Requests\StoreSportsRequest;
use App\Http\Requests\UpdateSportsRequest;
use App\Models\Branchs;
use App\Models\Branches_sports;

class SportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sports = Sports::with('branches')->paginate(10);
        return view('Dashboard.Sports.index',compact('sports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branchs::get();

        return view('Dashboard.Sports.create',compact('branches'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSportsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSportsRequest $request)
    {

        $sport = Sports::create(['name'=>$request->name]);
        $branches = $request->branch_id;

        $sport->branches()->attach($branches);

        return redirect()->route('sport.index')->with('message','تم اضافه اللعبه بنجاح ');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sports  $levels
     * @return \Illuminate\Http\Response
     */
    public function show(Sports $levels)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sports  $levels
     * @return \Illuminate\Http\Response
     */
    public function edit(Sports $sport)
    {
//        dd($sport->branches);
//        $sport =Sports::find($id);
        $branches = Branchs::get();

        return view('Dashboard.Sports.edit',compact('branches','sport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSportsRequest  $request
     * @param  \App\Models\Sports  $levels
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSportsRequest $request, Sports $levels,$id)
    {
        $sport =Sports::find($id);
        $sport->name = $request->name;
        $sport->save();
        $branches = $request->branch_id;
        $sport->branches()->sync($branches);

        return redirect()->route('sport.index')->with('message','تم تعديل اللعبه بنجاح ');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sports  $levels
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sports $sport)
    {
        $sport->delete();
        $sport->branches()->detach();
        return redirect()->route('sport.index')->with('error','تم الحذف اللعبه بنجاح ');


    }
}
