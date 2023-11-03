<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\ContractDetails;
use App\Models\Items;
use App\Models\User;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts =Contract::with('contract_details')->paginate(10);
        return view("Dashboard.Contracts.index",compact('contracts'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = User::get();
        $items = Items::get();
        return view("Dashboard.Contracts.create",compact('employees','items'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContractRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContractRequest $request)
    {
//    dd($request->all());
    $contract =  Contract::create([
        'from_employee'=>$request->from_employee,
        'to_employee'=>$request->to_employee,
        'from'=>$request->from_date,
        'to'=>$request->to_date,
        'type_of_contract'=>$request->type_of_contract,
    ]);
        for($x=0; $x < count($request->item_id); $x++)
        {
            ContractDetails::create([
                'contract_id'=>$contract->id,
                'item_id'=>$request->item_id[$x],
                'item_value'=>$request->item_value[$x],
            ]);
        }

        return redirect()->route('contract.index')->with('message','تم اضافه العقد  بنجاح ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {

        $employees = User::get();
        $items = Items::get();
        return view("Dashboard.Contracts.edit",compact('employees','items','contract'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContractRequest  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $contract->from_employee= $request->from_employee;
        $contract->to_employee= $request->to_employee;
        $contract->from= $request->from;
        $contract->to= $request->to;
        $contract->type_of_contract= $request->type_of_contract;

        foreach($contract->contract_details() as $key =>  $details){
            $details->update([
                'item'=> $request->item_id[$key],
                'item_value'=> $request->item_value[$key]
            ]);
        }

        $contract->save();
        return redirect()->route('contract.index')->with('message','تم تعديل العقد  بنجاح ');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        $contract->contract_details()->delete();
        $contract->delete();
        return redirect()->route('contract.index')->with('error','تم حذف العقد  بنجاح ');

    }
}
