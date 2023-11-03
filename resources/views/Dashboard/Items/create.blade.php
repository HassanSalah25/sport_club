@extends('Dashboard.includes.admin')

@section('content')


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم البنود</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">اضافة بند</li>
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
                                <h4 class="card-title" id="bordered-layout-card-center">اضافة بند جديد</h4>
                                <a href="/sat/courses/create.php" class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form class="form" id="myForm" action="{{route('item.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  نوع البند  </label>
                                                        <select name="type" class="form-control" id="type_id" >
                                                            <option value="">اختر نوع</option>
                                                            <option value="percentage">نسبه</option>
                                                            <option value="number">رقم</option>
                                                            <option value="text">نص</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  اسم البند </label>
                                                        <input type="text" class="form-control"  id="" name="item_name"  required>

                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput2">   البند </label>
                                                        <input type="text" class="form-control"  id="item_id" name="item_value"  required>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">   طريقه الحساب </label>
                                                        <select class="select2-placeholder-multiple form-control"  name="way_of_pay" >
                                                            <option value="0">حدد طريقه الحساب</option>

                                                        @forelse($items as $item)
                                                                <option value="{{$item->id}}">{{$item->item_name}}</option>
                                                            @empty

                                                            @endforelse
                                                        </select>

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
        $('#type_id').on('change', function () {
           var type =  $(this).val();
           if(type == "percentage")
           {
               $("#item_id").attr('type' ,'number');
           }
            if(type == "text")
            {
                $("#item_id").attr('type','text');
            }
            if(type == "number")
            {
                $("#item_id").attr('type','number');
            }

        });
        function resetForm() {

            document.getElementById("myForm").reset();

        }

    </script>
@endsection
