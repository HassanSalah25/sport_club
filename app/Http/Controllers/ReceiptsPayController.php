<?php

namespace App\Http\Controllers;

use App\Exports\ExportToExcelSheet;
use App\Models\Custody;
use App\Models\Players;
use App\Models\Receipts;
use App\Models\ReceiptsPay;
use App\Http\Requests\StoreReceiptsPayRequest;
use App\Http\Requests\UpdateReceiptsPayRequest;
use App\Models\ReceiptTypePay;
use App\Models\ReceiptTypes;
use App\Models\User;
use App\Services\PDF\ConvertDataToPDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ReceiptsPayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filter){
            $receipts =      $this->filter($request);
            if($request->pdf){
                $FilePdf = new ConvertDataToPDF("Dashboard.ReceiptsPay.pdf",$receipts,"ايصالات الصرف");
            }
            if($request->excel){
                $ExportToExcelSheet  = new ExportToExcelSheet($receipts ,'Dashboard.ReceiptsPay.pdf');
                return Excel::download($ExportToExcelSheet , 'ايصالات الصرف.xlsx');
            }
        } else  {
            $receipts = ReceiptsPay::paginate(10);

        }
        $players =Players::get();
        $receiptTypesFrom= ReceiptTypePay::whereIn('type',['Save_money','bank'])->get();
        $receiptTypes= ReceiptTypePay::get();
        $employees = User::get();
        return view('Dashboard.ReceiptsPay.index',compact('receipts','players','receiptTypes','receiptTypesFrom','employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $players =Players::get();
        $receiptTypesFrom= ReceiptTypePay::whereIn('type',['Save_money','bank'])->get();
        $receiptTypes= ReceiptTypePay::get();
        $employees = User::get();
        return view('Dashboard.ReceiptsPay.create',compact('employees','players','receiptTypes','receiptTypesFrom'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReceiptsPayRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReceiptsPayRequest $request)
    {
     $receipt_pay =    ReceiptsPay::create([
            'user_id'=>auth()->user()->id,

            'type_of_to'=>$request->to_type,
            'from'=>$request->from,
            'to'=>$request->to,
            'amount'=> -$request->amount,
            'statement'=>$request->statement,
            'date_receipt'=>$request->date,
        ]);

     if($request->employee_id){
         Custody::create([
             'receipt_pay_id'=>$receipt_pay->id,
             'price'=>$request->amount,
             'user_id'=> $request->employee_id
         ]);
     }

        return redirect()->route('receipt-pay.index')->with('message','تم اضافه الايصال بنجاح ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReceiptsPay  $receiptsPay
     * @return \Illuminate\Http\Response
     */
    public function show(ReceiptsPay $receiptsPay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReceiptsPay  $receiptsPay
     * @return \Illuminate\Http\Response
     */
    public function edit(ReceiptsPay $receiptsPay,$id)
    {
        $receiptsPay = ReceiptsPay::find($id);
        $receiptTypes= ReceiptTypePay::get();
        $players =Players::get();
        $employees = User::get();

        return view('Dashboard.ReceiptsPay.edit',compact('players','receiptsPay','receiptTypes','employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReceiptsPayRequest  $request
     * @param  \App\Models\ReceiptsPay  $receiptsPay
     * @return \Illuminate\Http\Response
     */
    public function update(StoreReceiptsPayRequest $request, ReceiptsPay $receiptsPay,$id)
    {
        $receiptsPay = ReceiptsPay::find($id);

        $receiptsPay->user_id=auth()->user()->id;
        $receiptsPay->from=$request->from;
        $receiptsPay->to=$request->to;
        $receiptsPay->type_of_to=$request->to_type;
        $receiptsPay->amount= (-$request->amount);
        $receiptsPay->date_receipt=$request->date;
        $receiptsPay->save();

        if($request->employee_id){
            Custody::where('receipt_pay_id', $receiptsPay->id)->delete();
            Custody::create([
                'receipt_pay_id'=>$receiptsPay->id,
                'price'=>$request->amount,
                'user_id'=> $request->employee_id
            ]);
        }
        return redirect()->route('receipt-pay.index')->with('message','تم تعديل الايصال بنجاح ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReceiptsPay  $receiptsPay
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReceiptsPay $receiptsPay,$id)
    {
        $receiptsPay = ReceiptsPay::find($id);

        $receiptsPay->delete();
        return redirect()->route('receipt-pay.index')->with('error','تم حذف الايصال بنجاح ');
    }

    public function filter($request){
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;
        $type = $request->type;
        $ReceiptsPay = new ReceiptsPay();
//dd($request->all());
        if($fromDate && $toDate && $fromDate <  $toDate){

            $ReceiptsPay = $ReceiptsPay->whereBetween("$request->type_date", [$fromDate, $toDate]);

        }


        if($type){
            $ReceiptsPay = $ReceiptsPay->where('type_of_to','others')->whereHas('receiptTypeTO' , function($query) use ($type){
                $query->where('type',$type);
            });
        }
        if($request->from){
            $ReceiptsPay = $ReceiptsPay->where("from", $request->from);
        }
        if($request->to_others){
            $ReceiptsPay = $ReceiptsPay->where("to", $request->to_others)->where('type_of_to',"others");
        }
        if($request->to_player){
            $ReceiptsPay = $ReceiptsPay->where("to", $request->to_player)->where('type_of_to',"players");
        }

        $ReceiptsPay =$ReceiptsPay->paginate(10);
        return $ReceiptsPay;


    }
}
