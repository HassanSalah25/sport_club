<?php

namespace App\Http\Controllers;

use App\Models\Custody;
use App\Models\SettlementRequest;
use App\Http\Requests\StoreSettlementRequestRequest;
use App\Http\Requests\UpdateSettlementRequestRequest;

class SettlementRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settlements = SettlementRequest::paginate(10);
        return view('Dashboard.SettlementRequests.index',compact('settlements'));
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
     * @param  \App\Http\Requests\StoreSettlementRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettlementRequestRequest $request)
    {

       SettlementRequest::create([
           'custody_id'=>$request->custody_id,
           'custody_expenses'=>$request->custody_expenses,
           'to'=>$request->to,
       ]);

        $Custody=   Custody::find($request->custody_id);
        $Custody->requested = 1;
        $Custody->save();
       return redirect()->route('custody.index')->with('message','لقد تم تقديم طلبك . انتظار موافقه التسويه من قبل المدير');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SettlementRequest  $settlementRequest
     * @return \Illuminate\Http\Response
     */
    public function show(SettlementRequest $settlementRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettlementRequest  $settlementRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(SettlementRequest $settlementRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSettlementRequestRequest  $request
     * @param  \App\Models\SettlementRequest  $settlementRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettlementRequestRequest $request, SettlementRequest $settlementRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettlementRequest  $settlementRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(SettlementRequest $settlementRequest)
    {
        //
    }
}
