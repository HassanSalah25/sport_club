<?php

namespace App\Http\Controllers;

use App\Models\Branchs;
use App\Http\Requests\StoreBranchsRequest;
use App\Http\Requests\UpdateBranchsRequest;

class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branchs::query()->orderBy('id','DESC')->paginate(10);
        return view('Dashboard.Branches.index',compact('branches'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.Branches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBranchsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBranchsRequest $request)
    {

         Branchs::create([
             'name'=>$request->name,
             'landline'=>$request->landline,
             'phone'=>$request->phone,
             'address'=>$request->address,
             'city'=>$request->city,
             'location'=>$request->location,

         ]);
        return redirect()-> route('branch.index')->with('message', ' تم اضافه فرع جديد ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branchs  $branchs
     * @return \Illuminate\Http\Response
     */
    public function show(Branchs $branchs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branchs  $branchs
     * @return \Illuminate\Http\Response
     */
    public function edit(Branchs $branchs,$id)
    {

        $branch=Branchs::find($id);
        return view('Dashboard.Branches.edit',compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBranchsRequest  $request
     * @param  \App\Models\Branchs  $branchs
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBranchsRequest $request, Branchs $branchs,$id)
    {

        $branch=Branchs::find($id);
        $branch->name = $request->name;
        $branch->landline = $request->landline;
        $branch->phone = $request->phone;
        $branch->city = $request->city;
        $branch->address = $request->address;
        $branch->location = $request->location;
        $branch->save();
        return redirect()-> route('branch.index')->with('message', 'تم تعديل الفرع');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branchs  $branchs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branchs $branchs,$id)
    {
        $branch=Branchs::find($id);
        $branch->delete();
        return redirect()-> route('branch.index')->with('error', 'تم حذف  الفرع');


    }
}
