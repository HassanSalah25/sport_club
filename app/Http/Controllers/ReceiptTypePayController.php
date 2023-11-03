<?php

namespace App\Http\Controllers;

use App\Models\Branchs;
use App\Models\ReceiptTypePay;
use App\Http\Requests\StoreReceiptTypePayRequest;
use App\Http\Requests\UpdateReceiptTypePayRequest;
use App\Models\ReceiptTypes;

class ReceiptTypePayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = ReceiptTypePay::paginate(10);
        return view('Dashboard.ReceiptTypesPay.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branchs::get();
        return view('Dashboard.ReceiptTypesPay.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReceiptTypePayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReceiptTypePayRequest $request)
    {
        ReceiptTypePay::create([
            'name'=>$request->name,
            'type'=>$request->type,
            'branch_id'=>$request->branch_id,
        ]);
        return redirect()->route('receipt-type-pay.index')->with('message','تم اضافه نوع الايصال بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReceiptTypePay  $receiptTypePay
     * @return \Illuminate\Http\Response
     */
    public function show(ReceiptTypePay $receiptTypePay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReceiptTypePay  $receiptTypePay
     * @return \Illuminate\Http\Response
     */
    public function edit(ReceiptTypePay $receiptTypePay)
    {
        $branches = Branchs::get();
        return view('Dashboard.ReceiptTypesPay.edit', compact('branches','receiptTypePay'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReceiptTypePayRequest  $request
     * @param  \App\Models\ReceiptTypePay  $receiptTypePay
     * @return \Illuminate\Http\Response
     */
    public function update(StoreReceiptTypePayRequest $request, ReceiptTypePay $receiptTypePay)
    {
        $receiptTypePay->name = $request->name;
        $receiptTypePay->type = $request->type;
        $receiptTypePay->branch_id = $request->branch_id;
        $receiptTypePay->save();


        return redirect()->route('receipt-type-pay.index')->with('message','تم تعديل نوع الايصال بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReceiptTypePay  $receiptTypePay
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReceiptTypePay $receiptTypePay)
    {
        $receiptTypePay->delete();
        return redirect()->route('receipt-type-pay.index')->with('error','تم حذف  نوع الايصال بنجاح');
    }
}
