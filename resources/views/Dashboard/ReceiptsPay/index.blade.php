@extends('Dashboard.includes.admin')
@section('content')

    <!-- modal medium -->
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Filter </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('receipt-pay.index')}}" method="GET">
                    @csrf
                    <input type="hidden" name="filter" value="1">

                    <div class="modal-body">



                        <div class="row">
                            <div class="col-md-12 mt-2" >
                                <div class="form-group">
                                    <label> تاريخ الانشاء</label>
                                    <input class="from_type " type="radio"  checked  id="" name="type_date" value="created_at">
                                    <label> تاريخ الايصال</label>
                                    <input class="from_type " type="radio"    id="" name="type_date" value="date_receipt">
                                    <label>تاريخ التعديل </label>
                                    <input class=" from_type" type="radio" id="" name="type_date" value="updated_at">

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">من التاريخ:</label>
                                    <input   class="form-control" type="date" name="fromDate" >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="" class="control-label mb-1"> الي التاريخ </label>
                                    <input   class="form-control" type="date" name="toDate" >
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="projectinput2">  من   </label>
                                    <select class=" form-control"  name="from"  id="from">
                                        <option selected value=""> اختار </option>

                                        @foreach($receiptTypesFrom as $type)
                                            <option  value="{{$type->id}}">{{$type->name}}</option>

                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-3 mt-2" >
                                <div class="form-group">
                                    <label>الي الاعبين</label>
                                    <input class="from_type " type="radio" id="players" name="to_type" value="players">
                                    <label> الي اخري </label>
                                    <input class=" from_type" type="radio" id="others" checked name="to_type" value="others">

                                </div>
                            </div>
                            <div class="col-md-4"  style="display: none" id="to_players">
                                <div class="form-group">
                                    <label for="projectinput2">  الي  </label>
                                    <select class=" form-control"  name="to_player" >
                                        <option selected value=""> اختار </option>

                                        @foreach($players as $player)
                                            <option value="{{$player->id}}">{{$player->name}}</option>

                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4" style="display: none" id="to_others">
                                <div class="form-group">
                                    <label for="projectinput2">  الي  </label>
                                    <select class="form-control"  name="to_others"  id="others_to">
                                        <option selected value=""> اختار </option>

                                        @foreach($receiptTypes as $type)
                                            <option   value="{{$type->id}}">{{$type->name}}</option>

                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6" style="display: none" id="employees">
                                <div class="form-group">
                                    <label for="projectinput2">  الموظف المسئول عن العهده  </label>
                                    <select class="form-control"  name="employee_id" >
                                        <option selected value=""> اختار </option>

                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->name}}</option>

                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="" class="control-label mb-1"> انواع الايصالات </label>

                                        <select class=" form-control"  id="" name="type" >
                                            <option selected value=""> اختار  </option>
                                            <option value="Save_money"> خزنه </option>
                                            <option value="bank"> بنك </option>
                                            <option value="expenses"> مصروف  </option>
                                            <option value="Custody"> عهده </option>
                                            <option value="Salaries"> مرتبات  </option>
                                        </select>


                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <input type="submit" value="Confirm"  class="btn btn-primary">
                        {{-- <button type="button"  class="btn btn-primary">Confirm</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal medium -->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> قسم  الايصالات الصرف</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/admin')}}">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active"> كل الايصالات الصرف </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            @if(Session::has('message'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{session()->get('message')}}</strong>
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{session()->get('error')}}</strong>
                </div>
            @endif

            <div class="content-body">
                <!-- Recent Transactions -->
                <div class="row">
                    <div id="recent-transactions" class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">الايصالات ({{$receipts->total()}})</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        @if(request('filter') && !$receipts->isEmpty())
                                            <li>
                                                <a class="btn btn-sm btn-primary   pull-right" href="{{route('receipt-pay.index')}}"> <i class="ft-rotate-cw ft-md"></i> </a>
                                            </li>
                                            <li>
                                                <a class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right" href="{{route('receipt-pay.index',['pdf'=>1, request()->fullUrl()])}}" target="_blank"> <i class="ft-pepper ft-md"></i> تحميل  ملف PDF</a>
                                            </li>
                                            <li>
                                                <a class="btn btn-sm btn-success box-shadow-2 round btn-min-width pull-right" href="{{route('receipt-pay.index',['excel'=>1, request()->fullUrl()])}}"> <i class="ft-pepper ft-md"></i> تحميل  ملف Excel</a>
                                            </li>

                                        @endif

                                        <li>

                                            <button type="button" class="btn btn-sm btn-warning  box-shadow-2 round btn-min-width pull-right" data-toggle="modal" data-target="#mediumModal">
                                                <i class="ft-report ft-md"></i>
                                                تقرير
                                            </button>
                                        </li>
                                        <li>
                                            <a class="btn btn-sm btn-success box-shadow-2 round btn-min-width pull-right" href="{{route('receipt-pay.create')}}"> <i class="ft-plus ft-md"></i> اضافة ايصال جديد</a>
                                        </li>


                                </div>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table id="tablecontents" class="table table-hover table-xl mb-0 sortable">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0">   القائم  بالصرف</th>
                                            <th class="border-top-0"> من </th>
                                            <th class="border-top-0"> الي </th>

                                            <th class="border-top-0">   المبلغ</th>
                                            <th class="border-top-0">   تاريخ الايصال</th>
                                            <th class="border-top-0">   تاريخ الانشاء</th>
                                            <th class="border-top-0">   تاريخ التعديل</th>
                                            <th class="border-top-0">التحكم</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($receipts as $receipt )

                                            <tr class="row1" data-id="{{ $receipt->id }}" >
                                                <td>{{$receipt->user->name}}</td>
                                                <td>{{$receipt->receiptType->name}}</td>

                                                @php
                                                    $id =  $receipt->to;
                                                    $name ='';
                                                    if($receipt->type_of_to=='players'){
                                                       $player = \App\models\Players::find($id);
                                                       $name = $player->name;
                                                    }
                                                    if($receipt->type_of_to=='others'){
                                                      $receiptType = \App\Models\ReceiptTypePay::find($id);
                                                       $name = $receiptType->name;

                                                    }

                                                @endphp
                                                <td>{{$name}}</td>

                                                <td>
                                                 {{ $receipt->amount }}
                                                </td>
                                                <td>
                                                    {{ $receipt->date_receipt->format('Y-m-d') }}
                                                </td>
                                                <td>
                                                    {{ $receipt->created_at->format('Y-m-d') }}
                                                </td>
                                                <td>
                                                    {{ $receipt->updated_at->format('Y-m-d') }}
                                                </td>


                                                <td class="text-truncate">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        @if( auth()->user()->hasRole(['administrator','superadministrator']) || auth()->user()->hasPermission('Exchange-receipts-update') )

                                                        <a href="{{route('receipt-pay.edit', $receipt->id)}}" class="btn btn-info btn-sm round"> تعديل</a>
                                                        @endif
                                                            @if( auth()->user()->hasRole(['administrator','superadministrator']) || auth()->user()->hasPermission('Exchange-receipts-delete') )

                                                            <form action="{{route('receipt-pay.destroy' ,$receipt->id)}}" method="POST" class="btn-group">
                                                            @csrf @method('delete')
                                                            <button

                                                                class="btn btn-danger btn-sm round"
                                                                onclick="return confirm('حذف هذا الايصال سيقوم بحذف جميع الفروع و الالعاب المتعلقه به!! هل انت متاكد من الحذف ؟')"
                                                            >
                                                                حذف
                                                            </button>
                                                        </form>
                                                            @endif
                                                    </div>
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                لايوجد ايصالات حاليا
                                            </tr>
                                        @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($receipts->hasPages())
                    {{$receipts->appends(request()->input())->links('pagination::bootstrap-4')}}
                @endif
                <!--/ Recent Transactions -->
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        checkfromType();

    $('.from_type').change(function (){
        checkfromType();
    });
    });
    function checkfromType(){
        if($('input[name="to_type"]:checked').val() =='players'){
            $('#to_players').show();
            $('#to_others').hide();
        }
        if($('input[name="to_type"]:checked').val() =='others'){
            $('#to_others').show();

            $('#to_players').hide();
        }
    }
</script>
@endsection
