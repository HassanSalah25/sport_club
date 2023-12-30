@extends('Dashboard.includes.admin')

@section('content')

    <div class="app-content content vue-app">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم المدربين</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/admin')}}">لوحة التحكم</a></li>
{{--                                <li class="breadcrumb-item"><a > المدربين</a></li>--}}
                                <li class="breadcrumb-item active">تعديل مدرب</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Recent Transactions -->
                <div class="row justify-content-md-center">
                    <div class="col-lg-10">
                        <div class="card" style="zoom: 1;">
                            <div class="card-header">
                                <h4 class="card-title" id="bordered-layout-card-center">تعديل مدرب </h4>
                                <a href="/sat/courses/create.php" class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <img src="{{asset($user->image) ?? "----"}}"  style="max-width: 200px; float: left"  class="rounded-circle" alt="">

                                    <form class="form" action="{{route('trainer.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        @include('Dashboard.includes.alerts.errors')


                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">اسم المدرب</label>
                                                        <input type="text" id="projectinput1" class="form-control" required placeholder="ادخل اسم المدرب" name="name" value="{{$user->name}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="branch_id">الفرع</label>
                                                        <select class="select2-placeholder-multiple form-control text-left"
                                                                multiple="multiple"
                                                                name="branch_id[]">
                                                            <option value="" >اختر</option>
                                                            @foreach($branches as $branch)
                                                                <option value="{{$branch->id}}"
                                                                    {{in_array($branch->id,old('branch_id')??$user->branches->pluck('id')->toArray())  ? 'selected' : ''}}>{{$branch->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1">هاتف </label>
                                                        <input type="number" id="projectinput1" class="form-control"  placeholder="ادخل هاتف المدرب" name="phone" value="{{$user->phone}}" maxlength="11" />

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> هاتف اخر </label>
                                                        <input type="number" id="phone2" class="form-control"  placeholder="ادخل هاتف  اخر المدرب" name="phone2" value="{{$user->phone2}}" maxlength="11" />

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">البريد الإلكتروني</label>
                                                        <input type="email" id="projectinput1" class="form-control" required placeholder="ادخل البريد الإلكتروني" name="email" value="{{$user->email}}"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">العنوان </label>
                                                        <input type="text" id="projectinput1" class="form-control"  placeholder="ادخل عنوان المدرب" name="address" value="{{$user->address}}" />
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> تاريخ الميلاد</label>
                                                        <input type="date"  class="form-control"   placeholder="dd-mm-yyyy"
                                                               min="1910-01-01" max="2030-12-31" name="birth_day"  value="{{$user->birth_day ? $user->birth_day->format('Y-m-d') : ''}}" />
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput3"> الرقم القومي </label>
                                                        <input type="number" class="form-control"  placeholder="الرقم القومي" name="national_id"  value="{{$user->national_id}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> شهاده التخرج</label>
                                                        <input type="text" class="form-control"  placeholder="   ادخل شهاده التخرج" name="degree" value="{{$user->degree}}"  />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput3"> الحاله العسكريه </label>
                                                        <input type="text"  rows="20" class="form-control"  placeholder="الحاله العسكريه " name="military_status" value="{{$user->military_status}}"  />
                                                    </div>
                                                </div>



                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput3">  صوره شخصيه  </label>
                                                        <input type="file"  rows="20" class="form-control"   name="image" value="{{old('image')}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput3">   الالعاب  </label>
                                                        <select name="sport_id" id="sport_id" class="form-control">
                                                            <option value="">اختر لعبه </option>
                                                           @php
                                                            $userSportId = $user->sport_and_level_trainer->isEmpty() ? 0  : $user->sport_and_level_trainer[0]->sport_id ;
                                                           @endphp
                                                            @foreach($sports as $sport)
                                                                <option @if( $userSportId  ==$sport->id) selected @endif value="{{$sport->id}}">{{$sport->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput3"> المستويات  </label>
                                                        <select name="level_id[]" id="level_id" class="form-control select2-placeholder-multiple"  multiple="multiple" >
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="form-section">
                                                <i class="ft-clipboard"></i>
                                                الاوراق المطلوبه
                                            </h4>
                                            <div class="row">

                                                <div class="col-md-2">
                                                    <label for=""> 2 صورة شخصية</label>
                                                    <input class="form-control" type="checkbox"  @if($user->personal_image=="1") checked @endif name="personal_image" id="" value="1">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for=""> صورة بطاقة</label>
                                                    <input class="form-control" type="checkbox" name="national_image"  @if($user->national_image=="1") checked @endif id="" value="1">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">شهادة ميلاد</label>
                                                    <input class="form-control" type="checkbox"  @if($user->birth_certificate=="1") checked @endif name="birth_certificate" id="" value="1">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">شهادة المؤهل</label>
                                                    <input class="form-control" type="checkbox"  @if($user->degree_certificate=="1") checked @endif name="degree_certificate" id="" value="1">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">شهادة تجنيد</label>
                                                    <input class="form-control" type="checkbox"  @if($user->army_certificate=="1") checked @endif name="army_certificate" id="" value="1">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for=""> فيش</label>
                                                    <input class="form-control" type="checkbox"  @if($user->feish=="1") checked @endif name="feish" id="" value="1">
                                                </div>
                                            </div>
                                            <hr class="form-group">
                                            <div class="row targetDiv" id="div0">
                                                <div class="col-md-12">
                                                    <div id="group1" class="fvrduplicate">
                                                        <div class="row entry">
                                                            <div class=" col-md-3">
                                                                <div class="form-group">
                                                                    <label for="projectinput2">   تاريخ الانضمام</label>
                                                                    <input type="date" class=" form-control "  name="date_of_join[]"  >

                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group price_row">
                                                                    <label for="projectinput2">   تاريخ المغادره</label>
                                                                    <input type="date" class=" form-control "  name="date_of_leave[]"  >
                                                                </div>
                                                            </div>
                                                            <div class=" col-md-5">
                                                                <div class="form-group">
                                                                    <label>سبب المغادره  </label>
                                                                    <textarea class="form-control form-control-sm  " name="reason_of_leave[]"
                                                                              rows="10" placeholder="سبب المغادره"> </textarea>
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
                                      @forelse($user->joinAndLeave as $data)
                                                <div class="row targetDiv" >
                                                    <div class="col-md-12">
                                                        <div  class="fvrduplicate">
                                                            <div class="row entry">
                                                                <div class=" col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="projectinput2">   تاريخ الانضمام</label>
                                                                        <input type="date" class=" form-control "  name="date_of_join[]"  value="{{ $data->date_of_join ? $data->date_of_join->format('Y-m-d') :   ' '}}" >

                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group price_row">
                                                                        <label for="projectinput2">   تاريخ المغادره</label>
                                                                        <input type="date" class=" form-control "  name="date_of_leave[]"  value="{{ $data->date_of_leave ? $data->date_of_leave->format('Y-m-d'):  ' '}}" >
                                                                    </div>
                                                                </div>
                                                                <div class=" col-md-5">
                                                                    <div class="form-group">
                                                                        <label>سبب المغادره  </label>
                                                                        <textarea class="form-control form-control-sm  " name="reason_of_leave[]"
                                                                                  rows="10" placeholder="سبب المغادره"> {{$data->reason_of_leave}} </textarea>
                                                                    </div>
                                                                </div>

                                                                <div class=" col-md-1 mt-2">

                                                                    <button type="button" class="btn btn-danger .btn-remove" id="remove_{{$data->id}}" onclick="removeElement({{$data->id}})">
                                                                        <i class="fa  fa-minus" aria-hidden="true">-</i>
                                                                    </button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty

                                            @endforelse


                                        </div>
                                        <div class="form-actions center">
                                            <button type="submit" class="btn btn-primary w-100"><i class="la la-check-square-o"></i> حفظ</button>
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

        $('#sport_id').on('change', function () {
            var id =$(this).val();
            var  route = "{{route('get-levels')}}";
            $.ajax(route,   // request url
                {
                    type: 'GET',  // http method
                    data: { "sport_id": id },
                    success: function (data, status, xhr) {// success callback function
                        $("#level_id").html(data.data);

                    }
                });
        });

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
        function removeElement(id){
            var remove_id = "remove_"+id;
                $("#"+remove_id).closest('.entry').remove();
                return false;
        }




        $(".trainer").change(function(){
            if($(this).val() == 'user'){
                $('#permiossn').show()
            }else{
                $('#permiossn').hide()
            }
        });

        var id =$('#sport_id').val();
        var  route = "{{route('get-levels')}}";
        $.ajax(route,   // request url
            {
                type: 'GET',  // http method
                data: { "sport_id": id ,'user_sport_id' : {{  $user->sport_and_level_trainer[0]->level_id }}},
                success: function (data, status, xhr) {// success callback function
                    $("#level_id").html(data.data);
                }
            });
    </script>
@endsection
