@extends('Dashboard.includes.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم الباكدج</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/admin')}}">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">كل الباكدجات</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            @if(Session::has('message'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{session()->get('message')}}</strong>
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{session()->get('error')}}</strong>
                </div>
            @endif

            <div class="content-body">
                <!-- Recent Transactions -->
                <div class="row">
                    <div id="recent-transactions" class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">الباكدجات ({{$packages->total()}})</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">

                                        <li>
                                            <a class="btn btn-sm btn-success box-shadow-2 round btn-min-width pull-right" href="{{route('package.create')}}"> <i class="ft-plus ft-md"></i> اضافة باكدج جديد</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table id="tablecontents" class="table table-hover table-xl mb-0 sortable">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0">  اسم الباكدج</th>
                                            <th class="border-top-0">   اللعبه</th>
                                            <th class="border-top-0">  وصف الباكدج</th>
                                            <th>
                                                تفاصيل الباكدج

                                            </th>

                                            <th class="border-top-0">  اجمالي الباكدج </th>


                                            <th class="border-top-0">التحكم</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($packages as $package )

                                            <tr class="row1" data-id="{{ $package->id }}" >
                                                <td>{{$package->name}}</td>
                                                <td>{{$package->sports->name}}</td>
                                                <td>{{$package->desc}}</td>





                                                        <div class="modal fade" id="smallmodal-{{$package->id}}" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="smallmodalLabel">تفاصيل الباكدج</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">


                                                                        @forelse($package->packages_details as $details)
                                                                                {{-- {{dump( $comm) }} --}}

                                                                                <div class="d-flex flex-column">
                                                                                    <div class="row justify-content-between mx-5">
                                                                                        <p style="color:#1E9FF2;">  قائمه السعر: </p>
                                                                                        <strong class="text-center"> {{$details->price_list?->name}}</strong>
                                                                                    </div>

                                                                                    <div class="row justify-content-between mx-5">
                                                                                    <p style="color:#1E9FF2;" > سعر اللعبه : </p>
                                                                                        <strong> {{$details->price}}</strong>
                                                                                    </div>

                                                                                    <div class="row justify-content-between mx-5">
                                                                                    <p style="color:#1E9FF2;"> عدد المرات :</p>
                                                                                        <strong> {{$details->number_of_training}}</strong>
                                                                                    </div>

                                                                                    <div class="row justify-content-between mx-5">
                                                                                    <p style="color:#1E9FF2;"    >اجمالي  سعر اللعبه : </p>
                                                                                        <strong>     {{$details->total_price_of_training}}</strong>
                                                                                    </div>
                                                                                </div> <hr>
                                                                        @empty
                                                                            <p>
                                                                               لايوجد تفاصيل للباكدج
                                                                            </p>
                                                                        @endforelse


                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-warning  "  data-toggle="modal" data-target="#smallmodal-{{$package->id}}">

                                                        <i class="la la-eye"></i>
                                                    </button>
                                                <td>{{$package->total_package}}</td>


                                                <td class="text-truncate">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{route('package.edit', $package->id)}}" class="btn btn-info btn-sm round"> تعديل</a>
                                                        @if( auth()->user()->hasRole(['administrator','superadministrator']) || auth()->user()->hasPermission('package-delete')  )

                                                        <form action="{{route('package.destroy' ,$package->id)}}" method="POST" class="btn-group">
                                                            @csrf @method('delete')
                                                            <button

                                                                class="btn btn-danger btn-sm round"
                                                                onclick="return confirm('حذف هذه الباكدج سيقوم بحذف جميع الفروع و الالعاب المتعلقه به!! هل انت متاكد من الحذف ؟')"
                                                            >
                                                                حذف
                                                            </button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                لايوجد مستويات حاليا
                                            </tr>
                                        @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($packages->hasPages())
                    {{$packages->appends(request()->input())->links('pagination::bootstrap-4')}}
                @endif
                <!--/ Recent Transactions -->
            </div>
        </div>
    </div>
@endsection

