@extends('Dashboard.includes.admin')

@section('content')


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم انواع الايصالات الصرف</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">تعديل ايصال الصرف</li>
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
                                <h4 class="card-title" id="bordered-layout-card-center">اضافة نوع ايصال صرف  جديد</h4>
                                <a href="/sat/courses/create.php" class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form class="form" action="{{route('receipt-type-pay.update',$receiptTypePay->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  نوع الايصال </label>
                                                        <input type="text" class="form-control" name="name" value="{{ $receiptTypePay->name }}" required>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  النوع</label>
                                                        <select class=" form-control"  id="multi_placehodler" name="type" >
                                                            <option @if($receiptTypePay->type=="Save_money") selected @endif value="Save_money"> خزنه </option>
                                                            <option @if($receiptTypePay->type=="bank") selected @endif value="bank"> بنك </option>
                                                            <option @if($receiptTypePay->type=="expenses") selected @endif value="expenses">  مصروف </option>
                                                            <option @if($receiptTypePay->type=="Custody") selected @endif value="Custody"> عهده </option>
                                                            <option  @if($receiptTypePay->type=="Salaries") selected @endif value="Salaries"> مرتبات  </option>

                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  الفرع</label>
                                                        <select class="form-control"  id="multi_placehodler" name="branch_id" >
                                                            @foreach($branches as $branch)
                                                                <option value="{{$branch->id}}"


                                                                @if($receiptTypePay->branch_id == $branch->id)
                                                                    selected="selected"
                                                                    @endif
                                                                >{{$branch->name}}</option>

                                                            @endforeach
                                                        </select>

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
