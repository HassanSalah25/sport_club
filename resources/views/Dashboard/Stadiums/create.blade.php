@extends('Dashboard.includes.admin')

@section('content')


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم الملاعب</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">اضافة ملعب</li>
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
                                <h4 class="card-title" id="bordered-layout-card-center">اضافة ملعب جديد</h4>
                                <a href="/sat/courses/create.php" class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form class="form" id="myForm" action="{{route('stadium.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  اسم الملعب </label>
                                                        <input type="text" class="form-control"  name="name" value="" required>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> الفرع </label>
                                                        <select class="select2-placeholder-multiple form-control"  id="branch_id" name="branch_id" >
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
                                                        <label for="projectinput2">   اللعبه </label>
                                                        <select class="select2-placeholder-multiple form-control"  id="sport_id" name="sport_id" >
                                                            @foreach($sports as $sport)
                                                                <option value="{{$sport->id}}">{{$sport->name}}</option>

                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label>قابل لايجار </label>
                                                        <div class="input-group">
                                                            <div class="d-inline-block custom-control custom-radio mr-1">
                                                                <input type="radio" name="type" class="custom-control-input" id="yes" value=1>
                                                                <label class="custom-control-label" for="yes">نعم</label>
                                                            </div>
                                                            <div class="d-inline-block custom-control custom-radio">
                                                                <input type="radio" name="type" class="custom-control-input" id="no" value=0>
                                                                <label class="custom-control-label" for="no">لا</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label> سعر ساعه الايجار  </label>
                                                        <input type="number"  class="form-control hour_rate"  disabled name="hour_rate">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label> سعر ساعه الايجار المثبت</label>
                                                        <input type="number"  class="form-control hour_rate" disabled name="hour_fixed_rate">
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
        $(document).ready(function (){
            AbleForRenet();

            $('#branch_id').on('change', function () {
                var ids =$("#branch_id").select2("val");
                var  route = "{{route('get-sports')}}";
                $.ajax(route,   // request url
                    {
                        type: 'GET',  // http method
                        data: { "branch_id[]": ids },
                        success: function (data, status, xhr) {// success callback function
                            $("#sport_id").html(data.data);

                        }
                    });
            });


        $('.custom-control').change(function (){
            AbleForRenet();
        });

        function resetForm() {

            document.getElementById("myForm").reset();

        }
        function AbleForRenet(){
            if($('input[name="type"]:checked').val() == 1){
                $('.hour_rate').removeAttr("disabled")
            } else {
                $('.hour_rate').attr("disabled",'disabled');

                $('.hour_rate').val('');
            }
        }
        });

    </script>
@endsection
