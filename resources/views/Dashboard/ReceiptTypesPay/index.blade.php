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
                                <li class="breadcrumb-item"><a href="{{url('/admin')}}">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">كل انواع الايصالات الصرف</li>
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
                                <h4 class="card-title">الانواع ({{$types->total()}})</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">

                                            <li>
                                                <a class="btn btn-sm btn-success box-shadow-2 round btn-min-width pull-right" href="{{route('receipt-type-pay.create')}}"> <i class="ft-plus ft-md"></i> اضافة نوع ايصال</a>
                                            </li>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table id="tablecontents" class="table table-hover table-xl mb-0 sortable">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0">  اسم  الايصال </th>
                                            <th class="border-top-0">  نوع الايصال </th>
                                            <th class="border-top-0">اسم الفرع</th>


                                            <th class="border-top-0">التحكم</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($types as $type )

                                            <tr class="row1" data-id="{{ $type->id }}" >
                                                <td>{{$type->name}}</td>
                                                  @if($type->type=='Save_money')
                                                      <td> خزنه</td>
                                                      @endif
                                                @if($type->type=='bank')
                                                      <td> بنك</td>
                                                      @endif
                                                @if($type->type=='expenses')
                                                    <td>  مصروف</td>
                                                @endif

                                                @if($type->type=='Custody')
                                                    <td> عهده</td>
                                                @endif

                                                <td>
                                                    {{$type->branches->name}}
                                                </td>


                                                <td class="text-truncate">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        @if( auth()->user()->hasRole(['administrator','superadministrator'])  || auth()->user()->hasPermission('type-receipts-update'))

                                                            <a href="{{route('receipt-type-pay.edit', $type->id)}}" class="btn btn-info btn-sm round"> تعديل</a>
                                                        @endif
                                                            @if( auth()->user()->hasRole(['administrator','superadministrator'])  || auth()->user()->hasPermission('type-receipts-delete'))

                                                            <form action="{{route('receipt-type-pay.destroy' ,$type->id)}}" method="POST" class="btn-group">
                                                                @csrf @method('delete')
                                                                <button

                                                                    class="btn btn-danger btn-sm round"
                                                                    onclick="return confirm('حذف هذا النوع !! هل انت متاكد من الحذف ؟')"
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
                                            لايوجد انواع ايصالات حاليا
                                        </tr>
                                        @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($types->hasPages())
                    {{$types->appends(request()->input())->links('pagination::bootstrap-4')}}
                @endif
                <!--/ Recent Transactions -->
            </div>
        </div>
    </div>
@endsection

