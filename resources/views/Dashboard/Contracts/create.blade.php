@extends('Dashboard.includes.admin')

@section('content')


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم العقود</h3>
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
                                    <form class="form" id="myForm" action="{{route('contract.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  الطرف الاول</label>

                                                        <select class=" form-control sport_val"  name="from_employee">
                                                            <option  selected value="">حدد الطرف الاول</option>

                                                            @foreach($employees as $employee)
                                                                <option value="{{$employee->id}}">{{$employee->name}}</option>

                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class=" col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  الطرف التاني</label>
                                                        <select class=" form-control sport_val"  name="to_employee">
                                                            <option  selected value="">حدد الطرف التاني</option>

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
                                                <div class="row targetDiv" id="div0">
                                                    <div class="col-md-12">
                                                        <div id="group1" class="fvrduplicate">
                                                            <div class="row entry">
                                                                <div class=" col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="projectinput2">   البنود</label>
                                                                        <select class=" form-control item_class"  name="item_id[]" id="item_id" onchange="getItemValues(this)">
                                                                            <option  selected value="">حدد البند </option>

                                                                            @foreach($items as $item)
                                                                                <option data-type="{{$item->type}}" data-item_value="{{$item->item_value}}" value="{{$item->id}}">{{$item->item_name}}</option>

                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="form-group price_row">
                                                                        <label> قيمه البند</label>
                                                                        <input class="form-control form-control-sm item_value  " name="item_value[]" type="number" placeholder="قيمه البند ">
                                                                    </div>
                                                                </div>

                                                                <div class=" col-md-1 mt-2">

                                                                        <button type="button" class="btn btn-success btn-add">
                                                                            <i class="fa fa-plus" aria-hidden="true">+</i>
                                                                        </button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>  نوع التعاقد </label>
                                                        <input class="form-control form-control-sm "  name="type_of_contract"
                                                               type="text" placeholder="  نوع التعاقد ">
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
function getItemValues(object){
    var type =   $(object).children(":selected").data("type");

    if(type == "percentage")
    {
        $(object).parent().parent().parent().find('.item_value').attr('type' ,'number');
        var item_value =   $(object).children(":selected").data("item_value");
        $(object).parent().parent().parent().find('.item_value').val(item_value);


    }
    if(type == "text")
    {
        $(object).parent().parent().parent().find('.item_value').attr('type','text');
        var item_value =   $(object).children(":selected").data("item_value");

        $(object).parent().parent().parent().find('.item_value').val(item_value);
    }
    if(type == "number")
    {
        $(object).parent().parent().parent().find('.item_value').attr('type','number');
        var item_value =   $(object).children(":selected").data("item_value");
        $(object).parent().parent().parent().find('.item_value').val(item_value);
    }
}
        $(function() {
            $(document).on('click', '.btn-add', function(e) {
                e.preventDefault();
                var controlForm = $(this).closest('.fvrduplicate'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(controlForm);
                newEntry.find('input').val('');
                controlForm.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<i class="fa fa-minus" aria-hidden="true">-</i>');
            }).on('click', '.btn-remove', function(e) {
                $(this).closest('.entry').remove();
                return false;
            });
        });

function resetForm() {

    document.getElementById("myForm").reset();

}
    </script>
@endsection
