<?php

namespace App\Http\Controllers;

use App\Models\CutsEmployee;
use App\Http\Requests\StoreCutsEmployeeRequest;
use App\Http\Requests\UpdateCutsEmployeeRequest;
use App\Models\User;

class CutsEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuts = CutsEmployee::paginate(10);
        return view('Dashboard.CutsEmployees.index',compact('cuts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = User::get();
        return view('Dashboard.CutsEmployees.create',compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCutsEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCutsEmployeeRequest $request)
    {
       CutsEmployee::create([
          'user_id'=>$request->employee_id,
          'price'=>$request->price,
          'date'=>$request->date,
          'reason'=>$request->reason,
       ]);
        return redirect()->route('cuts-employee.index')->with('message','تم اضافه الاستقطاع  بنجاح ');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CutsEmployee  $cutsEmployee
     * @return \Illuminate\Http\Response
     */
    public function show(CutsEmployee $cutsEmployee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CutsEmployee  $cutsEmployee
     * @return \Illuminate\Http\Response
     */
    public function edit(CutsEmployee $cutsEmployee)
    {
        $employees = User::get();
        return view('Dashboard.CutsEmployees.edit',compact('employees','cutsEmployee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCutsEmployeeRequest  $request
     * @param  \App\Models\CutsEmployee  $cutsEmployee
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCutsEmployeeRequest $request, CutsEmployee $cutsEmployee)
    {
        $cutsEmployee->user_id = $request->employee_id;
        $cutsEmployee->price = $request->price;
        $cutsEmployee->date = $request->date;
        $cutsEmployee->reason = $request->reason;
        $cutsEmployee->save();

        return redirect()->route('cuts-employee.index')->with('message','تم تعديل الاستقطاع  بنجاح ');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CutsEmployee  $cutsEmployee
     * @return \Illuminate\Http\Response
     */
    public function destroy(CutsEmployee $cutsEmployee)
    {
        $cutsEmployee->delete();
        return redirect()->route('cuts-employee.index')->with('error','تم حذف الاستقطاع  بنجاح ');

    }
}
