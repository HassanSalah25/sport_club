@extends('Dashboard.includes.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم الفروع</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/admin')}}">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">كل الفروع</li>
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
                                <h4 class="card-title">الفروع ({{$branches->total()}})</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">

                                            <li>
                                                <a class="btn btn-sm btn-success box-shadow-2 round btn-min-width pull-right" href="{{route('branch.create')}}"> <i class="ft-plus ft-md"></i> اضافة فرع جديد</a>
                                            </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-hover table-xl mb-0 sortable">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0">اسم الفرع</th>
                                            <th class="border-top-0"> الرقم الارضي</th>
                                            <th class="border-top-0"> الهاتف</th>
                                            <th class="border-top-0"> المدينه</th>
                                            <th class="border-top-0"> العنوان</th>
                                            <th class="border-top-0"> لوكشان</th>

                                            <th class="border-top-0">التحكم</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($branches as $branch )
                                            <tr class="row1" data-id="{{ $branch->id }}" >
                                                <td>{{$branch->name}}</td>
                                                <td>{{$branch->landline}}</td>
                                                <td>{{$branch->phone}}</td>
                                                <td>{{$branch->city}}</td>
                                                <td>{{$branch->address}}</td>
                                                <td>{{$branch->location}}</td>

                                                <td class="text-truncate">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        @if( auth()->user()->hasRole(['administrator','superadministrator']) || auth()->user()->hasPermission('branches-update')  )

                                                        <a href="{{route('branch.edit', $branch->id)}}" class="btn btn-info btn-sm round"> تعديل</a>
                                                        @endif
                                                            @if( auth()->user()->hasRole(['administrator','superadministrator']) || auth()->user()->hasPermission('branches-delete')  )

                                                            <form action="{{route('branch.destroy' ,$branch->id)}}" method="POST" class="btn-group">
                                                                @csrf @method('delete')
                                                                <button

                                                                    class="btn btn-danger btn-sm round"
                                                                    onclick="return confirm('حذف هذا الفرع سيقوم بحذف جميع الالعاب  و المتدربين و والمدربين  المتعلقة بهذا الفرع!! هل انت متاكد من الحذف ؟')"
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
                                            لايوجد فروع حاليا
                                        </tr>
                                        @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($branches->hasPages())
                    {{$branches->appends(request()->input())->links('pagination::bootstrap-4')}}
                @endif
                <!--/ Recent Transactions -->
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script>
        let table = new DataTable('#myTable');
    </script>
@endsection
