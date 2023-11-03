@extends('Dashboard.includes.admin')

@section('content')


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> قسم الايصالات التوريد</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">تعديل ايصال توريد</li>
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
                                <h4 class="card-title" id="bordered-layout-card-center">تعديل ايصال التوريد </h4>
                                <a href="/sat/courses/create.php" class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form class="form" action="{{route('receipt.update',$receipt->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')

                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  اسم المستلم </label>
                                                        <input type="text" class="form-control" disabled name="name" value="{{ auth()->user()->name }}" required>

                                                    </div>
                                                </div>
                                                <div class="col-md-0">

                                                    <div class="form-group">
                                                        <label for="projectinput2">   جزئي </label>
                                                        <input type="checkbox" class="form-control" @if($receipt->type_of_amount == 'part') checked @endif  id="type_of_amount" name="type_of_amount"  value="part" >

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  تاريخ الايصال</label>
                                                        <input type="date" name="date" class="form-control"  value="{{ $receipt->date_receipt->format('Y-m-d') }}">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-2 mt-2" >
                                                    <div class="form-group">
                                                        <label>من الاعبين</label>
                                                        <input class="from_type " type="radio" id="players"  @if($receipt->type_of_from == 'players') checked @endif  name="from_type" value="players">
                                                        <label>اخري </label>
                                                        <input class=" from_type" type="radio" id="others" name="from_type"  @if($receipt->type_of_from == 'others') checked @endif value="others">

                                                    </div>
                                                </div>
                                                <div class="col-md-4"  style="display: none" id="from_players">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  من  </label>
                                                        <select class=" form-control"  name="from" >
                                                            @foreach($players as $player)
                                                                <option
                                                                    @if($receipt->from == $player->id &&  $receipt->type_of_from == 'players') selected @endif
                                                                value="{{$player->id}}">{{$player->name}}</option>

                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="display: none" id="from_others">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  من  </label>
                                                        <select class="form-control"  name="from" >
                                                            @foreach($receiptTypes as $type)
                                                                <option
                                                                    @if($receipt->from == $type->id &&  $receipt->type_of_from == 'others') selected @endif
                                                                    value="{{$type->id}}">{{$type->name}}</option>

                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  الي   </label>
                                                        <select class="select2-placeholder-multiple form-control"  name="to" >
                                                            @foreach($receiptTypes as $type)
                                                                <option
                                                                    @if($receipt->to == $type->id ) selected @endif
                                                                    value="{{$type->id}}">{{$type->name}}</option>

                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">  المبلغ </label>
                                                        <input type="number" name="amount" id="amount" value="{{$receipt->amount}}" class="form-control">

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="">  المدفوع </label>
                                                        <input type="number"  disabled name="paid" id="paid"  value="{{$receipt->paid}}" class="form-control part">

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
                                                        <textarea class="form-control" rows="6" name="statement"> {{$receipt->statement}}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions center">
                                                <button type="submit" class="btn btn-primary w-100"><i class="la la-check-square-o"></i> حفظ</button>
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

        });

        /*+
           function of js to keep code and didn't duplicate
         */
        function checkfromType(){
            if($('input[name="from_type"]:checked').val() =='players'){
                $('#from_players').show();
                $('#from_others').hide();
            }
            if($('input[name="from_type"]:checked').val() =='others'){
                $('#from_others').show();

                $('#from_players').hide();
            }
        }
        function typeOfAmount(){
            if($('input[name="type_of_amount"]:checked').val()){
                $('#paid').removeAttr("disabled")
            } else {
                $('#paid').attr("disabled",'disabled');
                $('#paid').val('');
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

    </script>
@endsection
