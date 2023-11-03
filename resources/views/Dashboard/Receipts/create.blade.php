@extends('Dashboard.includes.admin')

@section('content')


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم الايصالات التوريد</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">   اضافة ايصال توريد</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                @include('Dashboard.includes.alerts.errors')

                <div class="row justify-content-md-center">
                    <div class="col-lg-10">
                        <div class="card" style="zoom: 1;">
                            <div class="card-header">
                                <h4 class="card-title" id="bordered-layout-card-center">اضافة ايصال توريد جديد</h4>
                                <a href="/sat/courses/create.php" class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form class="form" id="myForm" action="{{route('receipt.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  اسم محرر الايصال </label>
                                                        <input type="text" class="form-control" disabled name="name" value="{{ auth()->user()->name }}" required>

                                                    </div>
                                                </div>
                                                <div class="col-md-0">

                                                    <div class="form-group">
                                                        <label for="projectinput2">   جزئي </label>
                                                        <input type="checkbox" class="form-control"  id="type_of_amount" name="type_of_amount"  value="part" >

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  تاريخ الايصال</label>
                                                        <input type="date" name="date"
                                                               class="form-control"
                                                               @if(auth()->user()->hasPermission('date-receipts-create') || auth()->user()->hasRole(['administrator','superadministrator']))   @else disabled  @endif
                                                               placeholder="dd-mm-yyyy" value = "{{ Carbon\Carbon::today()->format('Y-m-d') }}"
                                                               min="1997-01-01" max="2030-12-31">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-2 mt-2" >
                                                    <div class="form-group">
                                                    <label>من الاعبين</label>
                                                        <input class="from_type " type="radio"  checked  id="players" name="from_type" value="players">
                                                        <label>اخري </label>
                                                        <input class=" from_type" type="radio" id="others" name="from_type" value="others">

                                                    </div>
                                                </div>
                                                <div class="col-md-4"  style="display: none" id="from_players">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  من  </label>
                                                        <select class=" form-control"  name="from" id="player_id" >
                                                            <option value="" selected>اختر لاعب
                                                            </option>
                                                            @foreach($players as $player)
                                                                <option  data-price="{{ $player->PlayerSportPrice }}"  value="{{$player->id}}">{{$player->name}}</option>

                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="display: none" id="from_others">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  من  </label>
                                                        <select class="form-control"  name="from" >
                                                            @foreach($receiptTypes as $type)
                                                                <option value="{{$type->id}}">{{$type->name}}</option>

                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  الي   </label>
                                                        <select class="select2-placeholder-multiple form-control"  name="to" >
                                                            @foreach($receiptTypes as $type)
                                                                <option value="{{$type->id}}">{{$type->name}}</option>

                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                            <label for="projectinput2">  تصنيف الادخال</label>
                                                            <select class=" form-control"  id="price_list" name="price_list" >
                                                                <option value="" selected>اختر  تصنيف الادخال
                                                                </option>
                                                            </select>
                                                        <input type="hidden" name="typePrice" id="type_price">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="projectinput2">  الفرع</label>
                                                        <select class="select2-placeholder-multiple form-control" id="branch_id"  name="branch_id" >
                                                            <option value="" selected >اختر فرع </option>

                                                            @foreach($branches as $branch)
                                                                <option value="{{$branch->id}}">{{$branch->name}}</option>

                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="payer">  اسم القائم بالدفع </label>
                                                        <input type="text" name="payer" id="payer" value="{{old('payer')}}" class="form-control">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">  المبلغ </label>
                                                        <input type="number" name="amount" id="amount" class="form-control">

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">  المدفوع </label>
                                                        <input type="number"  disabled name="paid" id="paid" class="form-control part">

                                                    </div>
                                                </div>
                                                <div class="ol-md-3">

                                                <div class="form-group">
                                                        <label for="">  المتبقي </label>
                                                        <input type="number" name="remain" id="remain" readonly class="form-control part">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for=""> البيان</label>
                                                        <textarea class="form-control" rows="6" name="statement"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions center">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-primary w-100"><i class="la la-check-square-o"></i> حفظ</button>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="button"  class="btn btn-danger   w-100" onclick="resetForm();">مسح  </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Recent Transactions -->
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script>
        $(document).ready(function(){
            checkfromType();
            typeOfAmount();
            calcPaidAndRemain();



            $('.from_type').change(function (){
                checkfromType();
            });
            $('#type_of_amount').click(function (){
                typeOfAmount();
            });

            $("#paid").change(function(){
                calcPaidAndRemain();
            });
            $("#amount").change(function(){
                var amount = $(this).val()*1;

                $('#paid').val(amount);
            });

        });

        $('#player_id').change(function (){

            getPlayersData();

        });
       $("#price_list").change(function(){

           get_price();
       });

        /*+
           function of js to keep code and didn't duplicate
         */

        function resetForm() {
            document.getElementById("myForm").reset();
            typeOfAmount();
        }

        function checkfromType(){
            if($('input[name="from_type"]:checked').val() =='players'){
                $('#from_players').show();
                $('#from_others').hide();
                $("#price_list").removeAttr('disabled');

            }
            if($('input[name="from_type"]:checked').val() =='others'){
                $('#from_others').show();
                $("#price_list").attr('disabled','disabled');

                $('#from_players').hide();
            }
        }
        function typeOfAmount(){
            if($('input[name="type_of_amount"]:checked').val()){
                $('#paid').removeAttr("disabled")
            } else {
                $('#paid').attr("disabled",'disabled');
                var amount = $("#amount").val()*1;

                $('#paid').val(amount);
                $('#remain').val('');
            }
        }
        function calcPaidAndRemain(){
            var amount = $("#amount").val()*1;
            var paid = $("#paid").val()*1;
            if(paid){
                var remain = amount - paid;
                $('#remain').val(remain);
            }

        }
        function get_price(){
          var player_id =$("#player_id").val();
          var id =$("#price_list").val();
          var route = "{{route('get-players-sports-price')}}";
           var typePrice =  $("#price_list").find(':selected').attr('data-typeprice');
           $("#type_price").val(typePrice);
          $.ajax(route,{
              type: 'GET',  // http method
             data:{"player_id":player_id, "id":id,"typePrice":typePrice},
              success: function(data){
                  $('#amount').val(data.price)
              }
          });
        }
        function  getPlayersData(){
            var player_id =$("#player_id").val();
            var route = "{{route('get-players-data')}}";
            $.ajax(route,{
                type: 'GET',  // http method
                data:{"player_id":player_id},
                success: function(data){
                    console.log(data);
                    $('#price_list').html(data.optionPriceList)
                    $('#package_id').html(data.optionPackage)
                }
            });
        }

    </script>
@endsection
