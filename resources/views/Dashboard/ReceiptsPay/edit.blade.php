@extends('Dashboard.includes.admin')

@section('content')


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم الايصالات</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">تعديل ايصال</li>
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
                                <h4 class="card-title" id="bordered-layout-card-center">تعديل ايصال </h4>
                                <a href="/sat/courses/create.php" class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form class="form" action="{{route('receipt-pay.update',$receiptsPay->id)}}" method="POST" enctype="multipart/form-data">
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

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  تاريخ الايصال</label>
                                                        <input type="date" name="date" class="form-control" value="{{$receiptsPay->date_receipt->format('Y-m-d')}}">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  من   </label>
                                                        <select class="select2-placeholder-multiple form-control"  name="from" >
                                                            @foreach($receiptTypes as $type)
                                                                <option @if($receiptsPay->from == $type->id) selected @endif value="{{$type->id}}">{{$type->name}}</option>

                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="col-md-3 mt-2" >
                                                    <div class="form-group">
                                                        <label>الي الاعبين</label>
                                                        <input class="from_type " type="radio" id="players"  @if($receiptsPay->type_of_to == 'players') checked @endif  name="to_type" value="players">
                                                        <label> الي اخري </label>
                                                        <input class=" from_type" type="radio" id="others"   @if($receiptsPay->type_of_to == 'others') checked @endif  name="to_type" value="others">

                                                    </div>
                                                </div>
                                                <div class="col-md-4"  style="display: none" id="to_players">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  الي  </label>
                                                        <select class=" form-control"  name="to" >
                                                            @foreach($players as $player)
                                                                <option
                                                                    @if($receiptsPay->to == $player->id &&  $receiptsPay->type_of_to == 'players') selected @endif
                                                                value="{{$player->id}}">{{$player->name}}</option>

                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-4" style="display: none" id="to_others">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  الي  </label>
                                                        <select class="form-control"  name="to" id="others_to" >
                                                            @foreach($receiptTypes as $type)
                                                                <option
                                                                    @if($receiptsPay->to == $type->id &&  $receiptsPay->type_of_to == 'others') selected @endif
                                                                data-type="{{$type->type}}"    value="{{$type->id}}">{{$type->name}}</option>

                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-6" style="display: none" id="employees">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  الموظف المسئول عن العهده  </label>
                                                        <select class="form-control"  name="employee_id" >
                                                            @foreach($employees as $employee)
                                                                <option value="{{$employee->id}}">{{$employee->name}}</option>

                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>



                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">  المبلغ  </label>
                                                        <input type="number" name="amount" id="amount" value="{{$receiptsPay->amount*-1}}" class="form-control">

                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for=""> البيان</label>
                                                        <textarea class="form-control" rows="6" name="statement">
                                                            {{$receiptsPay->statement}}
                                                        </textarea>
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
            showEmployees();



            $('.from_type').change(function (){
                checkfromType();
            });
            $("#others_to").change(function(){
                showEmployees();
            });


        });

        /*+
           function of js to keep code and didn't duplicate
         */
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
        function showEmployees(){
            if($("#others_to").find('option:selected').data('type') == 'Custody' ){
                $('#employees').show();
            } else {
                $('#employees').hide();

            }
        }


    </script>
@endsection
