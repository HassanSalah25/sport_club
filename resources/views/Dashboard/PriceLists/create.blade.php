@extends('Dashboard.includes.admin')

@section('content')


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم  قوائم  الاسعار</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">اضافة  قائمه اسعار</li>
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
                                <h4 class="card-title" id="bordered-layout-card-center">اضافة قائمه اسعار جديد</h4>
                                <a href="/sat/courses/create.php" class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form class="form" id="myForm" action="{{route('price-list.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">


                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2">     اسم القائمه  </label>
                                                        <input type="text" class="form-control"  name="name" >

                                                    </div>
                                                </div>
{{--                                                <div class="col-md-4">--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <label for="projectinput2">  الفرع</label>--}}
{{--                                                            <select class="select2-placeholder-multiple form-control" id="branch_id" onclick="getSports()" name="branch_id" >--}}
{{--                                                            <option value="" selected >اختر فرع </option>--}}

{{--                                                            @foreach($branches as $branch)--}}
{{--                                                                <option value="{{$branch->id}}">{{$branch->name}}</option>--}}

{{--                                                            @endforeach--}}
{{--                                                        </select>--}}

{{--                                                    </div>--}}
{{--                                                </div>--}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2">     الالعاب</label>
                                                        <select class="select2-placeholder-multiple form-control" id="sport_id" name="sport_id" >
                                                            <option value="" selected>اختر لعبه </option>
                                                            @foreach($sports as $sport)

                                                                <option value="{{$sport->id}}" >{{$sport->name}} </option>
                                                            @endforeach
                                                        </select>



                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2">     المستويات</label>
                                                        <select class="select2-placeholder-multiple form-control" id="level_id" name="level_id" >
                                                            <option value="" selected>اختر مستوي </option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  سعر اللعبه  </label>
                                                        <input type="number" class="form-control" name="price"  required>

                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> وصف  </label>
                                                        <textarea  class="form-control" name="desc"  required>
                                                        </textarea>
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

        function resetForm() {

            document.getElementById("myForm").reset();

        }
        $('#branch_id').on('change', function () {
            var ids =$("#branch_id").val();
            var  route = "{{route('get-sports')}}";
            $.ajax(route,   // request url
                {
                    type: 'GET',  // http method
                    data: { "branch_id": ids },
                    success: function (data, status, xhr) {// success callback function
                        $("#sport_id").html(data.data);

                    }
                });
        });

        $('#sport_id').on('change', function () {
            var ids =$("#sport_id").select2("val");
            var  route = "{{route('get-levels')}}";
            $.ajax(route,   // request url
                {
                    type: 'GET',  // http method
                    data: { "sport_id": ids },
                    success: function (data, status, xhr) {// success callback function
                        $("#level_id").html(data.data);

                    }
                });
        });

    </script>
@endsection
