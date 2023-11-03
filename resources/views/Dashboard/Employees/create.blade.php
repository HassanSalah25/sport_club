@extends('Dashboard.includes.admin')

@section('content')

    <div class="app-content content vue-app">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم الموظفين</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/admin')}}">لوحة التحكم</a></li>
{{--                                <li class="breadcrumb-item"><a > الموظفين</a></li>--}}
                                <li class="breadcrumb-item active">اضافة موظف</li>
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
                                <h4 class="card-title" id="bordered-layout-card-center">اضافة موظف جديد</h4>
                                <a href="" class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form class="form" id="myForm" action="{{route('employee.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @include('Dashboard.includes.alerts.errors')


                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">اسم الموظف</label>
                                                        <input type="text" id="projectinput1" class="form-control" required placeholder="ادخل اسم الموظف" name="name" value="{{old('name')}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">قسم الموظف</label>
                                                        <select class="employee form-control text-left" required  name="role" value="{{old('role')}}">
                                                            <option value="" >اختر</option>
                                                            @foreach($roles as $role)
                                                                <option value="{{$role->id}}" >{{$role->display_name}}</option>
                                                            @endforeach
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">البريد الإلكتروني</label>
                                                        <input type="email" id="projectinput1" class="form-control" required placeholder="ادخل البريد الإلكتروني" name="email" value="{{old('email')}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="branch_id">الفرع</label>
                                                        <select class="select2-placeholder-multiple form-control text-left"
                                                                multiple="multiple"
                                                                name="branch_id[]`">
                                                            <option value="" >اختر</option>
                                                            @foreach($branches as $branch)
                                                                <option value="{{$branch->id}}"
                                                                    {{in_array($branch->id,old('branch_id')??[])  ? 'selected' : ''}}>{{$branch->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput3">كلمة السر</label>
                                                        <div class="input-group">
                                                            <input type="password" id="password" class="form-control"
                                                                   required placeholder="كلمة السر" name="password"
                                                                   value="{{ old('password') }}" />
                                                            <div class="input-group-append">
                                                                <button type="button" id="toggle-password" class="btn">
                                                                    <i class="fa fa-eye text-dark"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> تاريخ الميلاد</label>
                                                        <input type="date"  class="form-control"   placeholder="dd-mm-yyyy"
                                                               min="1910-01-01" max="2030-12-31" name="birth_day" value="{{old('birth_day')}}" />
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput3"> الرقم القومي </label>
                                                        <input type="number" class="form-control"  placeholder="الرقم القومي" name="national_id" value="{{old('national_id')}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> شهاده التخرج</label>
                                                        <input type="text" class="form-control"  placeholder="   ادخل شهاده التخرج" name="degree" value="{{old('degree')}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput3"> الحاله العسكريه </label>
                                                        <input type="text"  rows="20" class="form-control"  placeholder="الحاله العسكريه " name="military_status" value="{{old('military_status')}}" />
                                                    </div>
                                                </div>



                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput3">  صوره شخصيه  </label>
                                                        <input type="file"  rows="20" class="form-control"   name="image" value="{{old('image')}}" />
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
                                                    <input class="form-control" type="checkbox" name="personal_image" id="" value="1">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for=""> صورة بطاقة</label>
                                                    <input class="form-control" type="checkbox" name="national_image" id="" value="1">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">شهادة ميلاد</label>
                                                    <input class="form-control" type="checkbox" name="birth_certificate" id="" value="1">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">شهادة المؤهل</label>
                                                    <input class="form-control" type="checkbox" name="degree_certificate" id="" value="1">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for="">شهادة تجنيد</label>
                                                    <input class="form-control" type="checkbox" name="army_certificate" id="" value="1">
                                                </div>
                                                <div class="col-md-2">
                                                    <label for=""> فيش</label>
                                                    <input class="form-control" type="checkbox" name="feish" id="" value="1">
                                                </div>
                                            </div>
                                            <hr class="form-group">

                                            <div class="row" id="permissionID" style="display: none;">
                                                <label>
                                                    <input type="checkbox" id="select-all-permissions" /> تحديد الكل
                                                </label>
                                                <div class="col-md-3 mb-3">
                                                    <div class="checkbox">
                                                        <h5 for="">الفروع</h5>
                                                        <label><input name="permession[]" type="checkbox" value="branches-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="branches-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="branches-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="branches-delete" />حذف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <h5 for="">الالعاب</h5>

                                                        <label><input name="permession[]" type="checkbox" value="sports-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="sports-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="sports-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="sports-delete" />حذف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <h5 for=""> المستويات </h5>
                                                        <label><input name="permession[]" type="checkbox" value="levels-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="levels-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="levels-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="levels-delete" />حذف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <h5 for="">قائمه الاسعار</h5>

                                                        <label><input name="permession[]" type="checkbox" value="price-list-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="price-list-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="price-list-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="price-list-delete" />حذف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <div class="checkbox">
                                                        <h5 for="">الباكدج</h5>
                                                        <label><input name="permession[]" type="checkbox" value="package-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="package-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="package-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="package-delete" />حذف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <h5 for="">العقود</h5>

                                                        <label><input name="permession[]" type="checkbox" value="contracts-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="contracts-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="contracts-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="contracts-delete" />حذف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <h5 for=""> عقود الشركاء</h5>
                                                        <label><input name="permession[]" type="checkbox" value="contracts-partners-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="contracts-partners-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="contracts-partners-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="contracts-partners-delete" />حذف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <h5 for="">الاعبين</h5>
                                                        <label><input name="permession[]" type="checkbox" value="players-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="players-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="players-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="players-delete" />حذف</label>
                                                    </div>
                                                </div>
{{--                                                <div class="col-md-3">--}}
{{--                                                    <div class="checkbox">--}}
{{--                                                        <h5 for="">الاعبين</h5>--}}
{{--                                                        <label><input name="permession[]" type="checkbox" value="trainers-create" />انشاء</label>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="checkbox">--}}
{{--                                                        <label><input name="permession[]" type="checkbox" value="trainers-update" />تعديل</label>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="checkbox">--}}
{{--                                                        <label><input name="permession[]" type="checkbox" value="trainers-read" />عرض</label>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="checkbox">--}}
{{--                                                        <label><input name="permession[]" type="checkbox" value="trainers-delete" />حذف</label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                                <div class="col-md-3 mb-3">
                                                    <div class="checkbox">
                                                        <h5 for="">الانشاطه</h5>
                                                        <label><input name="permession[]" type="checkbox" value="activity-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="activity-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="activity-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="activity-delete" />حذف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <h5 for="">ايصالات التوريد</h5>
                                                        <label><input name="permession[]" type="checkbox" value="Incoming-receipts-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="Incoming-receipts-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="Incoming-receipts-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="Incoming-receipts-delete" />حذف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <h5 for="">ايصالات الصرف</h5>
                                                        <label><input name="permession[]" type="checkbox" value="Exchange-receipts-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="Exchange-receipts-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="Exchange-receipts-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="Exchange-receipts-delete" />حذف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <h5 for="">انواع الايصالات</h5>
                                                        <label><input name="permession[]" type="checkbox" value="type-receipts-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="type-receipts-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="type-receipts-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="type-receipts-delete" />حذف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <div class="checkbox">
                                                        <h5 for="">العهده</h5>
                                                        <label><input name="permession[]" type="checkbox" value="custody-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="custody-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="custody-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="custody-delete" />حذف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <h5 for="">تسويات العهده</h5>
                                                        <label><input name="permession[]" type="checkbox" value="settlements-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="settlements-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="settlements-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="settlements-delete" />حذف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <h5 for="">الخصومات</h5>
                                                        <label><input name="permession[]" type="checkbox" value="deductions-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="deductions-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="deductions-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="deductions-delete" />حذف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <h5 for=""> حضور الاعبين</h5>
                                                        <label><input name="permession[]" type="checkbox" value="Attendance-players-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="Attendance-players-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="Attendance-players-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="Attendance-players-delete" />حذف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <div class="checkbox">
                                                        <h5 for="">حضور المدربين</h5>
                                                        <label><input name="permession[]" type="checkbox" value="Attendance-trainers-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="Attendance-trainers-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="Attendance-trainers-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="Attendance-trainers-delete" />حذف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <h5 for="">الملاعب</h5>
                                                        <label><input name="permession[]" type="checkbox" value="stadiums-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="stadiums-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="stadiums-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="stadiums-delete" />حذف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <h5 for="">ايجار الملاعب و الصالات </h5>
                                                        <label><input name="permession[]" type="checkbox" value="stadiums-rent-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="stadiums-rent-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="stadiums-rent-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="stadiums-rent-delete" />حذف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <h5 for="">المسابقات</h5>
                                                        <label><input name="permession[]" type="checkbox" value="tournament-create" />انشاء</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="tournament-update" />تعديل</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="tournament-read" />عرض</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input name="permession[]" type="checkbox" value="tournament-delete" />حذف</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="checkbox">
                                                        <h5 for="">تاريخ الايصال</h5>
                                                        <label><input name="permession[]" type="checkbox" value="date-receipts-create" />انشاء</label>
                                                    </div>
{{--                                                    <div class="checkbox">--}}
{{--                                                        <label><input name="permession[]" type="checkbox" value="players-update" />تعديل</label>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="checkbox">--}}
{{--                                                        <label><input name="permession[]" type="checkbox" value="players-read" />عرض</label>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="checkbox">--}}
{{--                                                        <label><input name="permession[]" type="checkbox" value="players-delete" />حذف</label>--}}
{{--                                                    </div>--}}
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
        showPermissions()
        $(".employee").change(function(){
            showPermissions()
        });
        function showPermissions(){

            if($(".employee").val() == 'Administrator' || $(".employee").val() == "" ){
                $('#permissionID').hide()
            }else{
                $('#permissionID').show()

            }
            assginRolesManager();

        }
        function assginRolesManager(){
            $('#permission').show();
            $("input[type=checkbox]").prop("checked",false);
            var id = $(".employee").val()
            $.ajax( {
						url: '{{route('get_permissions')}}',
						data: {
							id: id
						},
						type: 'get',
						success: function ( data ) {
							data.data.forEach(function(e){
							console.log(e)
                                $(`input[type=checkbox][value=${e.name}]`).prop("checked",true);
							})

							}
					} );
        }
        function resetForm() {

            document.getElementById("myForm").reset();

        }
        function fullPermissions(value){
            $("input[type=checkbox][value="+value+"-create]").prop("checked",true);
            $("input[type=checkbox][value="+value+"-read]").prop("checked",true);
            $("input[type=checkbox][value="+value+"-update]").prop("checked",true);
            $("input[type=checkbox][value="+value+"-delete]").prop("checked",true);
        }
    </script>
    <script>
        document.getElementById("toggle-password").addEventListener("click", function () {
            var passwordInput = document.getElementById("password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });

    </script>
    <script>
        document.getElementById('select-all-permissions').addEventListener('change', function () {
            var checkboxes = document.querySelectorAll('input[name="permession[]"]');
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = this.checked;
            }, this);
        });
    </script>

@endsection
