<?php

namespace App\Http\Controllers;

use App\Models\CustodyExpense;
use App\Http\Requests\StoreCustodyExpenseRequest;
use App\Http\Requests\UpdateCustodyExpenseRequest;
use Illuminate\Http\Request;

class CustodyExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $expenses = CustodyExpense::where('custody_id',$request->custody_id)->get();
$html = "";
$total_price = 0;
        if(!$expenses->isEmpty()){
            foreach ($expenses as $expense){
                $date = $expense->date->format('Y-m-d');
           $html .= "<tr> ";
           $html .= "<td>$expense->name </td> ";
           $html .= "<td> $expense->price</td> ";
           $html .= "<td>$date  </td> ";
            $html .= "</tr> ";
                $total_price +=  $expense->price;
            }
        } else {
            $html = "<tr> <td colspan='4'> لايوجد مصروفات </td></tr>";

        }
        return \Response::json(['html'=>$html,'total_price'=>$total_price]);

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
     * @param  \App\Http\Requests\StoreCustodyExpenseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustodyExpenseRequest $request)
    {
//        dd($request->all());
        CustodyExpense::create([
           'name'=>$request->name,
           'price'=>$request->price,
           'date'=>$request->date_expense,
           'custody_id'=>$request->custody_id,
        ]);
        return \Response::json('success',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustodyExpense  $custodyExpense
     * @return \Illuminate\Http\Response
     */
    public function show(CustodyExpense $custodyExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustodyExpense  $custodyExpense
     * @return \Illuminate\Http\Response
     */
    public function edit(CustodyExpense $custodyExpense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustodyExpenseRequest  $request
     * @param  \App\Models\CustodyExpense  $custodyExpense
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustodyExpenseRequest $request, CustodyExpense $custodyExpense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustodyExpense  $custodyExpense
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustodyExpense $custodyExpense)
    {
        //
    }
}
