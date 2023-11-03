@extends('Dashboard.includes.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم الباكدجات</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">اضافة باكدج</li>
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
                                <h4 class="card-title" id="bordered-layout-card-center">اضافة باكدج جديد</h4>
                                <a href="/sat/courses/create.php" class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form class="form" id="myForm" action="{{route('package.update',$package)}}" method="POST"
                                          enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf

                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label for="projectinput2">اسم باكدج</label>
                                                            <input type="text" class="form-control"
                                                                   name="name" placeholder="اسم الباكدج"
                                                                   value="{{ old('name') ?? $package->name }}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">الالعاب</label>
                                                        <select class="form-control sport_val" name="sport_id"
                                                                id="sport_id" onchange="getPriceList(this)">
                                                            <option value="">حدد اللعبه</option>
                                                            @foreach($sports as $sport)
                                                                <option value="{{ $sport->id }}" {{ old('sport_id') ?? $package->sport_id == $sport->id ? 'selected' : '' }}>{{ $sport->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row targetDiv" id="div0">
                                                <div class="col-md-12">
                                                    <div id="group1" class="fvrduplicate">
                                                        @if (old('price_list_id')??$package->packages_details->pluck('price_list_id')->toArray())
                                                            @foreach (old('price_list_id')??$package->packages_details->pluck('price_list_id')->toArray() as $key => $value)
                                                                <div class="row entry">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="projectinput2">قائمه الاسعار</label>
                                                                            <select class="form-control price_list" name=price_list_id[]" required  onchange="getPrice(this)">
                                                                                <option value="">حدد قائمه السعر</option>
                                                                                <!-- Add your options here -->
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group price_row">
                                                                            <label>سعر اللعبه</label>
                                                                            <input class="form-control form-control-sm price" name="price[]" type="number" placeholder="سعر اللعبه" value="{{ old('price.' . $key)??$package->packages_details[$key]->price }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label>عدد التمرينه</label>
                                                                            <input class="form-control form-control-sm num_of_training" name="number_of_training[]" type="number" onchange="getTotal(this)" placeholder="عدد التمرينات" value="{{ old('number_of_training.' . $key)??$package->packages_details[$key]->number_of_training }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label>اجمالي سعر التمرينه</label>
                                                                            <input class="form-control form-control-sm total_amount" name="total_of_training[]" type="number" placeholder="اجمالي سعر التمرينه" value="{{ old('total_of_training.' . $key)??$package->packages_details[$key]->total_price_of_training }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1 mt-2">
                                                                        @if ($key == count(old('price_list_id')??$package->packages_details->pluck('price_list_id')->toArray()) -1)

                                                                            <button type="button" class="btn btn-success btn-add"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                                        @else
                                                                            <button type="button" class="btn btn-danger btn-remove"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div class="row entry">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="projectinput2">قائمه الاسعار</label>
                                                                        <select class="form-control price_list" name="price_list_id[]" required onchange="getPrice(this)">
                                                                            <option value="">حدد قائمه السعر</option>
                                                                            <!-- Add your options here -->
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group price_row">
                                                                        <label>سعر اللعبه</label>
                                                                        <input class="form-control form-control-sm price" name="price[]" type="number" placeholder="سعر اللعبه">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label>عدد التمرينه</label>
                                                                        <input class="form-control form-control-sm num_of_training" name="number_of_training[]" type="number" onchange="getTotal(this)" placeholder="عدد التمرينات">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label>اجمالي سعر التمرينه</label>
                                                                        <input class="form-control form-control-sm total_amount" name="total_of_training[]" type="number" placeholder="اجمالي سعر التمرينه">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-1 mt-2">
                                                                    <button type="button" class="btn btn-success btn-add"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label> اجمالي الباكدج </label>
                                                        <input class="form-control form-control-sm " readonly
                                                               id="total_price" name="total_price"
                                                               value="{{old('total_price')??$package->total_package }}"
                                                               type="number" placeholder=" اجمالي الباكدج">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label> السعر اليدوي </label>
                                                        <input class="form-control form-control-sm " min="0"
                                                               name="manuel_price"
                                                               type="number"
                                                               value="{{old('manuel_price')??$package->manuel_price}}"
                                                               placeholder="  السعر اليدوي ">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput8">تفاصيل الباكدج </label>
                                                        <textarea id="projectinput8" rows="5" class="form-control"
                                                                  name="desc" placeholder="   ">{{old('desc')??$package->desc}}</textarea>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="form-actions center">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary w-100"><i
                                                            class="la la-check-square-o"></i> حفظ
                                                    </button>

                                                </div>
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-danger   w-100"
                                                            onclick="resetForm();">مسح
                                                    </button>

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
        var old_values  = @json(old('price_list_id')??$package->packages_details->pluck('price_list_id')->toArray());
        var value =$('#sport_id').val();
        var route = "{{route('get-price-list')}}";
        $.ajax(route,   // request url
            {
                type: 'GET',  // http methodprice_
                data: {"sport_id": value},
                success: function (data, status, xhr) {// success callback function
                    // var isSelected = classes.includes(e.id);
                    var options = [];
                    var option = $('<option>', {
                        text: 'اختر قائمة اسعار',
                    });

                    options.push(option);
                    data.forEach(function (e) {
                        console.log(e);
                        var option = $('<option>', {
                            value: e.id,
                            text: e.name,
                        });
                        options.push(option);
                    });
                    $('.price_list').empty().append(options);
                    $('.price_list').each(function(index){
                        $(this).val(old_values[index])
                    })

                }
            });

        $('#sport_id').on('click', function () {
            var value = $(this).val();
            var route = "{{route('get-price-list')}}";
            $.ajax(route,   // request url
                {
                    type: 'GET',  // http method
                    data: {"sport_id": value},
                    success: function (data, status, xhr) {// success callback function
                        console.log(data)
                        var options = [];
                        var option = $('<option>', {
                            text: 'اختر قائمة اسعار',
                        });

                        options.push(option);
                        data.forEach(function (e) {
                            console.log(e);
                            var option = $('<option>', {
                                value: e.id,
                                text: e.name,
                            });
                            options.push(option);
                        });
                        $('.price_list').empty().append(options);

                        $('.price').val(0);
                        $('.num_of_training').val(0);
                        $('.total_amount').val(0);
                        $('#total_price').val(0);
                    }
                });
        })

        function getPrice(selectObject) {
            var value = selectObject.value;
            var route = "{{route('get-price')}}";
            $.ajax(route,   // request url
                {
                    type: 'GET',  // http method
                    data: {"id": value},
                    success: function (data, status, xhr) {// success callback function
                        $(selectObject).parent().parent().parent().find('.price').val(data.price);

                        var total = 0;
                        $('.total_amount').each(function () {
                            var price = $(this).val() * 1;
                            total += price;
                        });
                        $("#total_price").val(total);
                    }

                });
        }

        function getTotal(object) {
            var num = object.value * 1;
            var price = $(object).parent().parent().parent().find('.price').val() * 1;
            var total_price = num * price;
            $(object).parent().parent().parent().find('.total_amount').val(total_price);

            var total = 0;
            $('.total_amount').each(function () {
                var price = $(this).val() * 1;
                total += price;
            });
            $("#total_price").val(total);


        }


        $(function () {
            $(document).on('click', '.btn-add', function (e) {
                e.preventDefault();
                var controlForm = $(this).closest('.fvrduplicate'),
                    currentEntry = $(this).parents('.entry:first'),
                    newEntry = $(currentEntry.clone()).appendTo(controlForm);
                newEntry.find('input').val('');
                controlForm.find('.entry:not(:last) .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .html('<i class="fa fa-minus" aria-hidden="true">-</i>');
            }).on('click', '.btn-remove', function (e) {
                $(this).closest('.entry').remove();
                return false;
            });
        });

        function resetForm() {

            document.getElementById("myForm").reset();

        }
    </script>
@endsection
