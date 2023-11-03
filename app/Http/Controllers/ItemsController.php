<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Http\Requests\StoreItemsRequest;
use App\Http\Requests\UpdateItemsRequest;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Items::paginate(10);
        return  view('Dashboard.Items.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Items::get();
        return view('Dashboard.Items.create',compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemsRequest $request)
    {
        Items::create([
            'type'=>$request->type,
            'item_name'=>$request->item_name,
            'item_value'=>$request->item_value,
            'way_of_pay'=>$request->way_of_pay,
        ]);
        return redirect()->route('item.index')->with('message','تم اضافه البند بنجاح ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function show(Items $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function edit(Items $item)
    {
        $items = Items::get();
        return view('Dashboard.Items.edit',compact('item','items'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemsRequest  $request
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemsRequest $request, Items $item)
    {

        $item->type=$request->type;
        $item->item_name=$request->item_name;
        $item->item_value=$request->item_value;
        $item->way_of_pay=$request->way_of_pay;
        $item->save();
        return redirect()->route('item.index')->with('message','تم تعديل البند بنجاح ');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Items  $items
     * @return \Illuminate\Http\Response
     */
    public function destroy(Items $item)
    {
        $item->delete();
        return redirect()->route('item.index')->with('error','تم حذف البند بنجاح ');

    }
}
