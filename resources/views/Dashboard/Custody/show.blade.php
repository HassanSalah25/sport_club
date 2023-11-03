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
                                <h4 class="card-title"> عدد المصاريف({{ $expenses->count()}})</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">

                                        <li>
{{--                                            <a type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter"> <i class="ft-plus ft-md"></i> اضافة  مصروف</a>--}}
                                        </li>
                                        <li>
                                            <a type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCustody"> <i class="ft-check-square ft-md"></i> تسويه العهده  </a>
                                        </li>
                                </div>
                            </div>






                            <div class="card-content">
                                <div class="row">

                                    <div class="col-md-3 ml-5">
                                        <div class="form-group">
                                            <h2 id="custody_price" style="color: #1EC481 ;">   <span style="color: #000 ;"> {{$custody->receipt_pay->receiptTypeTO->name}}</span>
                                            </h2>
                                        </div>
                                    </div>     <div class="col-md-3">
                                        <div class="form-group">
                                            <h2 id="custody_price" style="color: #1EC481 ;"> مبلغ العهده <span style="color: #000 ;"> {{$custody->price}}</span>
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
                                        <tbody >
                                        @php
                                            $total_price =0;
                                        @endphp
                                        @forelse($expenses as $expense)
                                            @php
                                                $total_price +=  $expense->price;
                                            @endphp
                                            <tr>
                                                <td>{{$expense->name}}</td>
                                                <td>{{$expense->price}}</td>
                                                <td>{{$expense->date->format('Y-m-d')}}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">

                                                </td>
                                            </tr>
                                        @endforelse


                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div>

                            <h2> مبلغ العهده : <strong id="total_custody" style="color: #6B6F82"> {{$custody->price}} </strong> </h2>
                            <h2> اجمالي المصروفات : <strong id="total_expenses" style="color: #6B6F82"> {{     $total_price }}</strong>   </h2>
                            <h2>   المتبقي :  <strong id="remain" style="color: #6B6F82"> {{ $custody->price -  $total_price }}</strong>   </h2>
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

