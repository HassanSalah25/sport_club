<?php

namespace App\Http\Controllers;

use App\Models\Branchs;
use App\Models\PartnerContracts;
use App\Http\Requests\StorePartnerContractsRequest;
use App\Http\Requests\UpdatePartnerContractsRequest;

class PartnerContractsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $PartnerContracts = PartnerContracts::get();
       return view('Dashboard.PartnerContract.index',compact('PartnerContracts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branchs::get();
        return view('Dashboard.PartnerContract.create',compact('branches'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePartnerContractsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartnerContractsRequest $request)
    {
      PartnerContracts::create(
          [
          'name'=>$request->name,
          'branch_id'=>$request->branch_id,
          'percentage'=>$request->percentage,
      ]
      );
      return  redirect()->route('partner-contract.index')->with('message','تم الاضافه بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PartnerContracts  $partnerContracts
     * @return \Illuminate\Http\Response
     */
    public function show(PartnerContracts $partnerContracts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PartnerContracts  $partnerContracts
     * @return \Illuminate\Http\Response
     */
    public function edit(PartnerContracts $partnerContract)
    {
        $branches = Branchs::get();
        return view('Dashboard.PartnerContract.edit',compact('branches','partnerContract'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePartnerContractsRequest  $request
     * @param  \App\Models\PartnerContracts  $partnerContracts
     * @return \Illuminate\Http\Response
     */
    public function update(StorePartnerContractsRequest $request, PartnerContracts $partnerContract)
    {
        $partnerContract->name = $request->name;
        $partnerContract->branch_id = $request->branch_id;
        $partnerContract->percentage = $request->percentage;
        $partnerContract->save();
        return  redirect()->route('partner-contract.index')->with('message','تم التعديل بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PartnerContracts  $partnerContracts
     * @return \Illuminate\Http\Response
     */
    public function destroy(PartnerContracts $partnerContract)
    {
        $partnerContract->delete();
        return  redirect()->route('partner-contract.index')->with('error','تم الحذف بنجاح');

    }
}
