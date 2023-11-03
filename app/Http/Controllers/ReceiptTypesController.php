<?php

namespace App\Http\Controllers;

use App\Models\Branchs;
use App\Models\ReceiptTypes;
use App\Http\Requests\StoreReceiptTypesRequest;
use App\Http\Requests\UpdateReceiptTypesRequest;

class ReceiptTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = ReceiptTypes::paginate(10);
        return view('Dashboard.ReceiptTypes.index', compact('types'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branchs::get();
        return view('Dashboard.ReceiptTypes.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReceiptTypesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReceiptTypesRequest $request)
    {
         ReceiptTypes::create([
            'name'=>$request->name,
            'type'=>$request->type,
            'branch_id'=>$request->branch_id,
         ]);
         return redirect()->route('receipt-type.index')->with('message','تم اضافه نوع الايصال بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReceiptTypes  $receiptTypes
     * @return \Illuminate\Http\Response
     */
    public function show(ReceiptTypes $receiptTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReceiptTypes  $receiptTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(ReceiptTypes $receiptType)
    {
        $branches = Branchs::get();
        return view('Dashboard.ReceiptTypes.edit', compact('branches','receiptType'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReceiptTypesRequest  $request
     * @param  \App\Models\ReceiptTypes  $receiptTypes
     * @return \Illuminate\Http\Response
     */
    public function update(StoreReceiptTypesRequest $request, ReceiptTypes $receiptType)
    {
        $receiptType->name = $request->name;
        $receiptType->type = $request->type;
        $receiptType->branch_id = $request->branch_id;
        $receiptType->save();


        return redirect()->route('receipt-type.index')->with('message','تم تعديل نوع الايصال بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReceiptTypes  $receiptTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReceiptTypes $receiptType)
    {
        //
        $receiptType->delete();
        return redirect()->route('receipt-type.index')->with('error','تم حذف  نوع الايصال بنجاح');

    }
}
