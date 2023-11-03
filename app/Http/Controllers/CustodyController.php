<?php

namespace App\Http\Controllers;

use App\Models\Custody;
use App\Http\Requests\StoreCustodyRequest;
use App\Http\Requests\UpdateCustodyRequest;
use App\Models\CustodyExpense;
use App\Models\ReceiptTypePay;

class CustodyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $custodies=Custody::where('user_id', auth()->user()->id )->where('requested','0')->with('receipt_pay.receiptTypeTO')->get();
        $receiptTypes= ReceiptTypePay::whereIn('type',['Save_money','bank'])->get();
//        dd($custodies);
        return view("Dashboard.Custody.index",compact('custodies','receiptTypes'));
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
     * @param  \App\Http\Requests\StoreCustodyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustodyRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Custody  $custody
     * @return \Illuminate\Http\Response
     */
    public function show(Custody $custody)
    {
//       dd($custody);
        $expenses = CustodyExpense::where('custody_id',$custody->id)->get();


        return view("Dashboard.Custody.show",compact('custody','expenses'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Custody  $custody
     * @return \Illuminate\Http\Response
     */
    public function edit(Custody $custody)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustodyRequest  $request
     * @param  \App\Models\Custody  $custody
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustodyRequest $request, Custody $custody)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Custody  $custody
     * @return \Illuminate\Http\Response
     */
    public function destroy(Custody $custody)
    {
        //
    }
}
