@extends('Dashboard.includes.admin')

@section('content')
    <div id="exampleModal" class="modal fade">
        <div class="modal-dialog">
            <form class="form" id="" action="{{route('partner.store')}}" method="POST"
            >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">×</span> <span class="sr-only">close</span>
                    </button>
                    <h4 id="modalTitle" class="modal-title"></h4>
                </div>
                <div id="modalBody" class="modal-body">


                        @csrf
                        <div class="form-body">

                            <div class="row">

                                <div class="col-md-12"  >
                                    <div class="form-group">
                                        <label for="projectinput2"> اسم الشريك الجديد  </label>
                                        <input id="name" class=" form-control" required  name="name"  >

                                    </div>
                                </div>


                            </div>

                        </div>

                </div>
                <div class="modal-footer">
                    <button type="" class="btn btn-primary"
                    >save
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close
                    </button>
                </div>
            </div>
            </form>

        </div>
    </div>


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">    قسم  العقود الشركاء </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">اضافة عقد</li>
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
                                <h4 class="card-title" id="bordered-layout-card-center">اضافة عقد جديد</h4>
                                <a href="/sat/courses/create.php" class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form class="form" id="myForm" action="{{route('contract-partner.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  الطرف الاول</label>

                                                        <select class=" form-control "  name="from_company" readonly>
                                                            <option  selected value="">حدد الطرف الاول</option>

                                                            @foreach($partners as $partner)
                                                                <option @if($partner->id == 1 ) selected @endif  value="{{$partner->id}}">{{$partner->name}}</option>

                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class=" col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  الطرف التاني</label>
                                                        <select class="select2-placeholder-multiple form-control" multiple="multiple" name="to_company[]">

                                                            @foreach($partners as $partner)
                                                                @if($partner->id > 1 )

                                                                <option   value="{{$partner->id}}">{{$partner->name}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class=" col-md-2 mt-2">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                                          اضاف شريك
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> مده التعاقد  من</label>

                                                        <input type="date" class="form-control" name="from_date" placeholder="dd-mm-yyyy" value = "{{ Carbon\Carbon::today()->format('Y-m-d') }}"
                                                               min="1997-01-01" max="2030-12-31">
                                                    </div>
                                                </div>
                                                <div class=" col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">   مده التعاقد  الي </label>
                                                        <input type="date" class="form-control" name="to_date">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>   النسبه  </label>
                                                        <input class="form-control form-control-sm "  name="percentage"
                                                               type="number" placeholder="  نسبه التعاقد بين الشركاء ">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>  نوع التعاقد </label>
                                                        <input class="form-control form-control-sm "  name="type_of_contract"
                                                               type="text" placeholder="  نوع التعاقد ">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label> اسم العقد   </label>
                                                        <input class="form-control form-control-sm "  name="file_name"
                                                               type="text" placeholder="    ">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>   ملف العقد </label>
                                                        <input class="form-control form-control-sm "  name="file"
                                                               type="file" placeholder="    ">
                                                    </div>
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
