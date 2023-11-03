@extends('Dashboard.includes.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم طلبات التسويه</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/admin')}}">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">كل طلبات التسويه</li>
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
                                <h4 class="card-title">عدد طلبات تسويه العهده ({{$settlements->total()}})</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">

                                            <li>
{{--                                                <a class="btn btn-sm btn-success box-shadow-2 round btn-min-width pull-right" href="{{route('receipt-type.create')}}"> <i class="ft-plus ft-md"></i> اضافة نوع ايصال</a>--}}
                                            </li>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table id="tablecontents" class="table table-hover table-xl mb-0 sortable">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0">  اسم مستلم العهده  </th>
                                            <th class="border-top-0">  العهده </th>
                                            <th class="border-top-0"> اجمالي العهده</th>
                                            <th class="border-top-0">  اجمالي المصروفات من العهده</th>
                                            <th class="border-top-0">  المتبقي من العهده</th>
                                            <th class="border-top-0">  الي  </th>
                                            <th class="border-top-0">  حاله الطلب  </th>



                                            <th class="border-top-0">التحكم</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($settlements as $settlement )

                                            <tr class="row1" data-id="{{ $settlement->id }}" >
                                                <td>{{$settlement->custody->user->name }}</td>


                                                <td>
                                                    {{$settlement->custody->receipt_pay->receiptTypeTO->name }}
                                                </td>

                                                <td>
                                                    {{$settlement->custody->price }}
                                                </td>

                                                <td>
                                                    {{$settlement->custody_expenses}}
                                                </td>
                                                <td>
                                                    {{$settlement->custody->price -  $settlement->custody_expenses }}
                                                </td>

                                                <td>
                                                    {{$settlement->receiptTypeTO->name }}
                                                </td>
                                                <td>
                                                    {{$settlement->status == 0 ? 'pending' : 'active'}}
                                                </td>

                                                <td class="text-truncate">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                            <a href="{{route('custody.show', $settlement->custody)}}" class="btn btn-info btn-sm round"> تفاصيل  مصروفات العهده</a>

                                                    </div>
                                                </td>
                                            </tr>

                                        @empty
                                        <tr>
                                           لايوجد اي طلبات لتسويه العهده
                                        </tr>
                                        @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($settlements->hasPages())
                    {{$settlements->appends(request()->input())->links('pagination::bootstrap-4')}}
                @endif
                <!--/ Recent Transactions -->
            </div>
        </div>
    </div>
@endsection

