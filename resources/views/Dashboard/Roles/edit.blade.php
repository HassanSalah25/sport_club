@extends('Dashboard.includes.admin')

@section('content')

    <div class="app-content content vue-app">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">الادوار</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/admin')}}">لوحة التحكم</a></li>
                                {{--                                <li class="breadcrumb-item"><a > الموظفين</a></li>--}}
                                <li class="breadcrumb-item active">تعديل الادوار</li>
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
                                <h4 class="card-title" id="bordered-layout-card-center">تعديل دور</h4>
                                <a href="/sat/courses/create.php" class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">

                                    <form class="form" action="{{route('role.update',$role)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        @include('Dashboard.includes.alerts.errors')
                                        <input value="{{$role->id}}" type="hidden" id="role_id">
                                        <div class="row m-3">
                                            <div class="form-group">
                                                <label for="projectinput1">اسم الدور</label>
                                                <input type="text" id="projectinput1" class="form-control" required placeholder="ادخل الاسم" name="name" value="{{old('name')??$role->name}}" />
                                            </div>
                                        </div>

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
                                                    <label><input name="permession[]" type="checkbox"  value="sports-read" />عرض</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input name="permession[]" type="checkbox"  value="sports-delete" />حذف</label>
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

                                            <div class="col-md-3 mb-3">
                                                <div class="checkbox">
                                                    <h5 for="">الاستقطاعات</h5>
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
                                            <div class="col-md-3 mb-3">
                                                <div class="checkbox">
                                                    <h5 for="">بنود العقد</h5>
                                                    <label><input name="permession[]" type="checkbox" value="contract_terms-create" />انشاء</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input name="permession[]" type="checkbox" value="contract_terms-update" />تعديل</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input name="permession[]" type="checkbox" value="contract_terms-read" />عرض</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input name="permession[]" type="checkbox" value="contract_terms-delete" />حذف</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <div class="checkbox">
                                                    <h5 for="">الموظفين</h5>
                                                    <label><input name="permession[]" type="checkbox" value="employee-create" />انشاء</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input name="permession[]" type="checkbox" value="employee-update" />تعديل</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input name="permession[]" type="checkbox" value="employee-read" />عرض</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input name="permession[]" type="checkbox" value="employee-delete" />حذف</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <div class="checkbox">
                                                    <h5 for="">المدربين</h5>
                                                    <label><input name="permession[]" type="checkbox" value="trainer-create" />انشاء</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input name="permession[]" type="checkbox" value="trainer-update" />تعديل</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input name="permession[]" type="checkbox" value="trainer-read" />عرض</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input name="permession[]" type="checkbox" value="trainer-delete" />حذف</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
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
                                            <div class="col-md-3 mb-3">
                                                <div class="checkbox">
                                                    <h5 for="">عقود الشركاء</h5>
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
                                            <div class="col-md-3 mb-3">
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
                                            <div class="col-md-3 mb-3">
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
                                            <div class="col-md-3 mb-3">
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
                                            <div class="col-md-3 mb-3">
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
                                            <div class="col-md-3 mb-3">
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
                                            <div class="col-md-3 mb-3">
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
                                            <div class="col-md-3 mb-3">
                                                <div class="checkbox">
                                                    <h5 for="">حضور الاعبين</h5>
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
                                            <div class="col-md-3 mb-3">
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
                                            <div class="col-md-3 mb-3">
                                                <div class="checkbox">
                                                    <h5 for="">ايجار الملاعب و الصالات</h5>
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
                                            <div class="col-md-3 mb-3">
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
                                            <div class="col-md-3 mb-3">
                                                <div class="checkbox">
                                                    <h5 for="">تاريخ الايصال</h5>
                                                    <label><input name="permession[]" type="checkbox" value="date-receipts-create" />انشاء</label>
                                                </div>
                                                {{--                                                    <div class="checkbox">--}}
                                                {{--                                                        <label><input name="permession[]" type="checkbox"   @if($user->hasPermission('package-update')) checked  @endif value="package-update" />تعديل</label>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                    <div class="checkbox">--}}
                                                {{--                                                        <label><input name="permession[]" type="checkbox"  @if($user->hasPermission('package-read')) checked  @endif value="package-read" />عرض</label>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                    <div class="checkbox">--}}
                                                {{--                                                        <label><input name="permession[]" type="checkbox"  @if($user->hasPermission('package-delete')) checked  @endif value="package-delete" />حذف</label>--}}
                                                {{--                                                    </div>--}}
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <div class="checkbox">
                                                    <h5 for="">التقارير</h5>
                                                    <label><input name="permession[]" type="checkbox" value="subscription_reports" />تقارير الاشتراكات</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input name="permession[]" type="checkbox" value="schedules_reports" />تقارير الجداول</label>
                                                </div>
                                                <div class="checkbox">
                                                    <label><input name="permession[]" type="checkbox" value="stadiums_reports" />تقارير الملاعب</label>
                                                </div>
                                            </div>
                                            {{--                                                <div class="col-md-3">--}}
                                            {{--                                                    <div class="checkbox">--}}
                                            {{--                                                        <h5 for="">الطلاب</h5>--}}

                                            {{--                                                        <label><input name="permession[]" type="checkbox" value="students-create" />انشاء</label>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                    <div class="checkbox">--}}
                                            {{--                                                        <label><input name="permession[]" type="checkbox" value="students-update" />تعديل</label>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                    <div class="checkbox">--}}
                                            {{--                                                        <label><input name="permession[]" type="checkbox" value="students-read" />عرض</label>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                    <div class="checkbox">--}}
                                            {{--                                                        <label><input name="permession[]" type="checkbox" value="students-delete" />حذف</label>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                                <div class="col-md-3">--}}
                                            {{--                                                    <div class="checkbox">--}}
                                            {{--                                                        <h5 for="">طلابات الطلابه</h5>--}}
                                            {{--                                                        <label><input name="permession[]" type="checkbox" value="student-requests-create" />انشاء</label>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                    <div class="checkbox">--}}
                                            {{--                                                        <label><input name="permession[]" type="checkbox" value="student-requests-update" />تعديل</label>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                    <div class="checkbox">--}}
                                            {{--                                                        <label><input name="permession[]" type="checkbox" value="student-requests-read" />عرض</label>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                    <div class="checkbox">--}}
                                            {{--                                                        <label><input name="permession[]" type="checkbox" value="student-requests-delete" />حذف</label>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                                <div class="col-md-3">--}}
                                            {{--                                                    <div class="checkbox">--}}
                                            {{--                                                        <h5 for="">الفيزا</h5>--}}
                                            {{--                                                        <label><input name="permession[]" type="checkbox" value="visas-create" />انشاء</label>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                    <div class="checkbox">--}}
                                            {{--                                                        <label><input name="permession[]" type="checkbox" value="visas-update" />تعديل</label>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                    <div class="checkbox">--}}
                                            {{--                                                        <label><input name="permession[]" type="checkbox" value="visas-read" />عرض</label>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                    <div class="checkbox">--}}
                                            {{--                                                        <label><input name="permession[]" type="checkbox" value="visas-delete" />حذف</label>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                        </div>
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
        var id = $('#role_id').val()
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
        showPermissions()
        $(".employee").change(function(){
            showPermissions()
            assginRolesManager();

        });
        function showPermissions(){

            if($(".employee").val() == 'Administrator' || $(".employee").val() == "" ){
                $('#permissionID').hide()
            }else{
                $('#permissionID').show()


            }

        }
        function assginRolesManager(){
            $('#permission').show();
            $("input[type=checkbox]").prop("checked",false);

            if($(".employee").val() == 'Sports_activity_manager'){


                fullPermissions("players");
                fullPermissions("activity");
                fullPermissions("levels");
                fullPermissions("package");
                fullPermissions("price-list");
                fullPermissions("stadiums");
                fullPermissions("Attendance-players");
                fullPermissions("Attendance-trainers");

                $("input[type=checkbox][value=contracts-read]").prop("checked",true);

                $("input[type=checkbox][value=Exchange-receipts-create]").prop("checked",true);
                $("input[type=checkbox][value=Exchange-receipts-read]").prop("checked",true);

                $("input[type=checkbox][value=Incoming-receipts-create]").prop("checked",true);
                $("input[type=checkbox][value=Incoming-receipts-read]").prop("checked",true);


            }
            if($(".employee").val() == 'Managing_Director' || $(".employee").val()=='Branch_Manger') {
                fullPermissions("players");
                $("input[type=checkbox][value=activity-read]").prop("checked",true);
                $("input[type=checkbox][value=levels-read]").prop("checked",true);
                $("input[type=checkbox][value=package-read]").prop("checked",true);
                $("input[type=checkbox][value=price-list-read]").prop("checked",true);

                $("input[type=checkbox][value=Exchange-receipts-create]").prop("checked",true);
                $("input[type=checkbox][value=Exchange-receipts-read]").prop("checked",true);

                $("input[type=checkbox][value=Incoming-receipts-create]").prop("checked",true);
                $("input[type=checkbox][value=Incoming-receipts-read]").prop("checked",true);

                $("input[type=checkbox][value=Attendance-players-create]").prop("checked",true);
                $("input[type=checkbox][value=Attendance-players-read]").prop("checked",true);

                $("input[type=checkbox][value=Attendance-trainers-create]").prop("checked",true);
                $("input[type=checkbox][value=Attendance-trainers-read]").prop("checked",true);
            }
            if( $(".employee").val() == "Technical_Director"  ){
                $("input[type=checkbox][value=activity-read]").prop("checked",true);
                $("input[type=checkbox][value=levels-read]").prop("checked",true);
                $("input[type=checkbox][value=players-read]").prop("checked",true);
                $("input[type=checkbox][value=contracts-read]").prop("checked",true);
                $("input[type=checkbox][value=Attendance-trainers-create]").prop("checked",true);
                $("input[type=checkbox][value=Attendance-players-read]").prop("checked",true);
            }
            if($('.employee').val()== 'Financial_Manager'){
                $("input[type=checkbox][value=players-read]").prop("checked",true);
                $("input[type=checkbox][value=contracts-read]").prop("checked",true);
                fullPermissions("activity");
                fullPermissions("levels");
                fullPermissions("package");
                fullPermissions("price-list");
                fullPermissions("stadiums");
                fullPermissions("stadiums-rent");
                fullPermissions("Incoming-receipts");
                fullPermissions("Exchange-receipts");
                fullPermissions("type-receipts");
                fullPermissions("custody");
                fullPermissions("settlements");
                fullPermissions("deductions");
                fullPermissions("contracts-partners");

            }



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
        document.getElementById('select-all-permissions').addEventListener('change', function () {
            var checkboxes = document.querySelectorAll('input[name="permession[]"]');
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = this.checked;
            }, this);
        });
    </script>
@endsection

