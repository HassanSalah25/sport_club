<?php

namespace App\Http\Controllers;

use App\Models\Branchs;
use App\Models\Levels;
use App\Models\PriceList;
use App\Http\Requests\StorePriceListRequest;
use App\Http\Requests\UpdatePriceListRequest;
use App\Models\Sports;
use Illuminate\Http\Request;

class PriceListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $priceLists = PriceList::paginate(10);
        return view('Dashboard.PriceLists.index',compact('priceLists'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branchs::get();
        $sports = Sports::all();
        return view('Dashboard.PriceLists.create',compact('branches','sports'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePriceListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePriceListRequest $request)
    {
//        dd($request->all());
        PriceList::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'branch_id'=>$request->branch_id,
            'sport_id'=>$request->sport_id,
            'level_id'=>$request->level_id,
            'desc'=>$request->desc,
        ]);
        return redirect()->route('price-list.index')->with('message','تم اضافه قائمه سعر بنجاح ');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PriceList  $priceList
     * @return \Illuminate\Http\Response
     */
    public function show(PriceList $priceList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PriceList  $priceList
     * @return \Illuminate\Http\Response
     */
    public function edit(PriceList $priceList)
    {
        $branches = Branchs::get();


        $sports = Sports::all();

        return view('Dashboard.PriceLists.edit',compact('priceList','branches','sports'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePriceListRequest  $request
     * @param  \App\Models\PriceList  $priceList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePriceListRequest $request, PriceList $priceList)
    {
        $priceList->name = $request->name;
        $priceList->price = $request->price;
        $priceList->branch_id = $request->branch_id;
        $priceList->sport_id = $request->sport_id;
        $priceList->level_id = $request->level_id;

        $priceList->desc = $request->desc;
        $priceList->save();
        return redirect()->route('price-list.index')->with('message','تم تعديل قائمه سعر بنجاح ');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PriceList  $priceList
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceList $priceList)
    {
        $priceList->delete();
        return redirect()->route('price-list.index')->with('error','تم حذف قائمه سعر بنجاح ');

    }

    /**
     * Get Price List For Players.
     *
     * @param  \App\Models\PriceList  $priceList
     * @return \Illuminate\Http\Response
     */
       public function getPriceList(Request $request){
          $sport_id = $request->sport_id;
          $level_id = $request->level_id;
          $priceLists = PriceList::where(['sport_id'=> $sport_id,'level_id'=>$level_id])->get();
           $selected = ' ';
           if($priceLists){

               $option  = "
      <option value=0  > حدد قائمه سعر  </option> ";

               foreach ($priceLists as $list){

                   if($request->price_list == $list->id){
                       $selected = "selected";
                   }

                   $option .= "
      <option $selected value=$list->id  > $list->name </option> ";
               }



           } else{
               $option  = "
      <option value=0  > حدد قائمه سعر  </option> ";
           }
           return  Response()->json(['price_list'=>$option]);
       }
}
