@extends('Dashboard.includes.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم عهده الموظف</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/admin')}}">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active"> العهده</li>
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
                                <h4 class="card-title"> اجمالي العهده({{ $custodies->count()}})</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">

                                            <li>
                                                <a type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter"> <i class="ft-plus ft-md"></i> اضافة  مصروف</a>
                                            </li>
                                        <li>
                                            <a type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCustody"> <i class="ft-check-square ft-md"></i> تسويه العهده  </a>
                                        </li>
                                </div>
                            </div>

                            <!-- Button trigger modal -->
{{--                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">--}}
{{--                                Launch demo modal--}}
{{--                            </button>--}}

                            <!-- Modal equation the custody  -->
                            <div class="modal fade" id="exampleModalCustody" tabindex="-1" role="dialog" aria-labelledby="exampleModalCustodyTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">تسويه العهده</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{route('settlement-request.store')}}" id="" method="POST">

                                        <div class="modal-body">
                                                @csrf
                                                <div class="form-body">
                                                    <input type="hidden" name="custody_id"  id="custody_val_id" value="">
                                                    <input type="hidden" name="custody_expenses" id="custody_expenses" value="">

                                                    <div class="form-group">
                                                        <label for="projectinput2">  الي  </label>
                                                        <select class="form-control"  name="to"  >
                                                            @foreach($receiptTypes as $type)
                                                                <option data-type="{{$type->type}}"  value="{{$type->id}}">{{$type->name}}</option>

                                                            @endforeach
                                                        </select>

                                                    </div>

                                                </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button id="" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                            <!-- Modal add expenses  -->

                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">اضافه مصروف من العهده </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" id="myForm">
                                                <input type="hidden" name="custody" id="custody_val">
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label for="complaintinput1"> اسم المصروف</label>
                                                        <input type="text" id="name_expense" class="form-control round" placeholder=" اسم المصروف " name="name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="complaintinput2">المبلغ </label>
                                                        <input type="number" id="price_expense" class="form-control round" placeholder="المبلغ " name="price">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="complaintinput3">تاريخ الصرف</label>
                                                        <input type="date" id="date_expense" class="form-control round" name="date">
                                                    </div>

                                                </div>

                                            </form>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" id="sava_date" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select  class="form-control" name="custody_id" id="custody_id">
                                                <option value=""> اختر عهده </option>
                                            @foreach($custodies as $custody)
                                                <option data-price="{{ $custody->price }}" value="{{$custody->id}}"> {{ $custody->receipt_pay->receiptTypeTO->name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h2 id="custody_price" style="color: #1EC481 ;"> مبلغ العهده <span style="color: #000 ;"> 0</span>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="tablecontents" class="table table-hover table-xl mb-0 sortable">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0">  المصروفات من العهده </th>
                                            <th class="border-top-0">   سعر المصروف من العهده  </th>
                                            <th class="border-top-0"> تاريخ الصرف </th>


                                        </tr>
                                        </thead>
                                        <tbody id="data_html">


                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div>

                        <h2> مبلغ العهده : <strong id="total_custody" style="color: #6B6F82"> </strong> </h2>
                        <h2> اجمالي المصروفات : <strong id="total_expenses" style="color: #6B6F82"></strong>   </h2>
                        <h2>   المتبقي :  <strong id="remain" style="color: #6B6F82"></strong>   </h2>
                        </div>

                    </div>
                </div>
{{--                @if($types->hasPages())--}}
{{--                    {{$types->appends(request()->input())->links('pagination::bootstrap-4')}}--}}
{{--                @endif--}}
                <!--/ Recent Transactions -->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#custody_id").change(function(){
            var price =  parseInt($("#custody_id").find('option:selected').data('price'));
            var custody_id = parseInt($("#custody_id").val());
            $('#custody_price span').text(price);
            $("#custody_val").val(custody_id);
            $("custody_val_id").val(custody_id);
    var total_custody =  parseInt($("#total_custody").text(price));

            getExpenses(custody_id);


        });

        $("#sava_date").click(function (){
          var name = $("#name_expense").val();
          var price = $("#price_expense").val();
          var date_expense = $("#date_expense").val();
            var custody_id = $("#custody_id").val()

            var Route = "{{route('custody-expense-store')}}";
            jQuery.ajax(
                {

                url: Route,
                type: "POST",
                dataType: 'json',
                data: {
                    name: name,
                    price: price,
                    date_expense: date_expense,
                    custody_id : custody_id,


                },
                success: function (data) {
                    resetForm();

                    $("#exampleModalCenter").modal("hide");
                    alert("تم اضافه مصروف من العهده    ");
                    getExpenses(custody_id);


                }

            });
        });
        function resetForm() {

            document.getElementById("myForm").reset();

        }
        function getExpenses(custody_id ){
            var Route = "{{route('custody-expense-get')}}";
            jQuery.ajax(
                {

                    url: Route,
                    type: "get",
                    dataType: 'json',
                    data: {
                        custody_id : custody_id,
                    },
                    success: function (data) {
                        $("#data_html").html(data.html);
                        $("#total_expenses").text(data.total_price);
                        $("#custody_expenses").val(data.total_price);
                        $("#custody_val_id").val(custody_id);
                        var price =  $("#custody_id").find('option:selected').data('price');
                        var  total_custody =data.total_price *1;
                        var remain  = price - total_custody;

                        $("#remain").text(remain);

                    }

                });
        }
    </script>
@endsection

