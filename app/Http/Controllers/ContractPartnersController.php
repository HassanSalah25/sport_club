<?php

namespace App\Http\Controllers;

use App\Models\ContractPartners;
use App\Http\Requests\StoreContractPartnersRequest;
use App\Http\Requests\UpdateContractPartnersRequest;
use App\Models\ContractPartnersRelation;
use App\Models\Partners;

class ContractPartnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contractPartners = ContractPartners::with(['Partners',"ContractPartners"])->get();
//      dd($contractPartners);
        return view("Dashboard.ContractsPartners.index",compact('contractPartners'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $partners = Partners::get();
       return view("Dashboard.ContractsPartners.create",compact('partners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContractPartnersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContractPartnersRequest $request)
    {
//dd($request->all());
        if($request->file){
                $media_name=$request->file_name;
                $objfile =$request->file;
                $fileName = time() . $objfile->getClientOriginalName();
                $pathFile = public_path("storage/ContractPartners");
                $objfile->move($pathFile, $fileName);
                $fileNamePath = "storage/ContractPartners" . '/' . $fileName;
            $contarct =   ContractPartners::create([
                    'from_company'=> $request->from_company,
                    'from'=> $request->from_date,
                    'to'=> $request->to_date,
                    'percentage'=> $request->percentage,
                    'type_of_contract'=> $request->type_of_contract,
                    'file_name'=>$media_name,
                    'file'=> $fileNamePath,
                ]);

        }
        $counter = count($request->to_company);
        for($x=0;  $x  < $counter; $x++ ){
            ContractPartnersRelation::create([
                'contract_id'=> $contarct->id,
                'partner_id'=>$request->to_company[$x]
            ]);

        }

        return redirect()->route('contract-partner.index')->with('message','تم اضافه العقد  بنجاح ');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContractPartners  $contractPartners
     * @return \Illuminate\Http\Response
     */
    public function show(ContractPartners $contractPartners)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContractPartners  $contractPartners
     * @return \Illuminate\Http\Response
     */
    public function edit(ContractPartners $contractPartner)
    {
        $partners = Partners::get();
//        dd($contractPartner->ContractPartners());
        return view("Dashboard.ContractsPartners.edit",compact('partners','contractPartner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContractPartnersRequest  $request
     * @param  \App\Models\ContractPartners  $contractPartners
     * @return \Illuminate\Http\Response
     */
    public function update(StoreContractPartnersRequest $request, ContractPartners $contractPartner)
    {
//     dd($contractPartner);
        $contractPartner->from_company= $request->from_company;
        $contractPartner->from= $request->from_date;
        $contractPartner->to= $request->to_date;
        $contractPartner->percentage= $request->percentage;
        $contractPartner->file_name= $request->file_name;
        if($request->file){
            unlink($contractPartner->file);

            $objfile =$request->file;
            $fileName = time() . $objfile->getClientOriginalName();
            $pathFile = public_path("storage/ContractPartners");
            $objfile->move($pathFile, $fileName);
            $fileNamePath = "storage/ContractPartners" . '/' . $fileName;

            $contractPartner->file= $fileNamePath;

        }
        ContractPartnersRelation::where('contract_id',$contractPartner->id)->delete();
        $counter = count($request->to_company);
        for($x=0;  $x  < $counter; $x++ ){
            ContractPartnersRelation::create([
                'contract_id'=> $contractPartner->id,
                'partner_id'=>$request->to_company[$x]
            ]);

        }
        $contractPartner->save();
        return redirect()->route('contract-partner.index')->with('message','تم تعديل العقد  بنجاح ');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContractPartners  $contractPartners
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContractPartners $contractPartner)
    {
        ContractPartnersRelation::where('contract_id',$contractPartner->id)->delete();
        unlink($contractPartner->file);

       $contractPartner->delete();
        return redirect()->route('contract-partner.index')->with('error','تم حذف العقد  بنجاح ');

    }
}
