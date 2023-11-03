@extends('Dashboard.includes.admin')

@section('content')


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم    المسابقات</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">اضافة   مسابقه</li>
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
                                <h4 class="card-title" id="bordered-layout-card-center">اضافة  مسابقه جديد</h4>
                                <a href="/sat/courses/create.php" class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form class="form" id="myForm" action="{{route('tournament.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">     اسم مسابقه  </label>
                                                        <input type="text" class="form-control"  name="name" >

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  الفرع</label>
                                                        <select class="select2-placeholder-multiple form-control" multiple="multiple" id="multi_placehodler" name="branch_id[]" >
                                                            @foreach($branches as $branch)
                                                                <option value="{{$branch->id}}">{{$branch->name}}</option>

                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>


                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">   تاريخ المسابقه</label>
                                                        <input type="date" class="form-control"  name="date" placeholder="dd-mm-yyyy" value = "{{ Carbon\Carbon::today()->format('Y-m-d') }}" >
                                                    </div>

                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  قيمه الاشتراك</label>
                                                        <input type="number" class="form-control"  name="subscribe_value" >
                                                    </div>

                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> التكلفه  </label>
                                                        <input type="number" class="form-control"  name="cost" >
                                                    </div>

                                                </div>
                                                <div class="form-group col-12 mb-2 contact-repeater">
                                                    <div data-repeater-list="repeater">
                                                        <div class="input-group mb-1" data-repeater-item>
                                                            <input type="text" name="file_name" placeholder="اكتب اسم الملفات المطلوبه" class="form-control" id="example-tel-input">
                                                            <span class="input-group-append" id="button-addon2">
                              <button class="btn btn-danger" type="button" data-repeater-delete><i class="ft-x"></i></button>
                            </span>
                                                        </div>
                                                    </div>
                                                    <button type="button" data-repeater-create class="btn btn-primary">
                                                        <i class="ft-plus"></i> اضافه اسم ملف اخر
                                                    </button>
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

    </script>
@endsection
