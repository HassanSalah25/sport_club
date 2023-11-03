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
                                <li class="breadcrumb-item"><a href="{{url('/admin')}}">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">كل العقودات</li>
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
{{--                                <h4 class="card-title">العقود ({{$contractPartners->total()}})</h4>--}}
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">

                                        <li>
                                            <a class="btn btn-sm btn-success box-shadow-2 round btn-min-width pull-right" href="{{route('contract-partner.create')}}"> <i class="ft-plus ft-md"></i> اضافة عقد جديد</a>
                                        </li>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table id="tablecontents" class="table table-hover table-xl mb-0 sortable">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0">  اسم  الطرف الاول</th>
                                            <th class="border-top-0">     الشركاء </th>
                                            <th class="border-top-0">   مده التعاقد من </th>
                                            <th class="border-top-0">   مده التعاقد الي </th>
                                            <th class="border-top-0">     نسبه التعاقد  </th>



                                            <th class="border-top-0">  نوع التعاقد  </th>

                                            <th>
                                                مشاهد العقد

                                            </th>

                                            <th class="border-top-0">التحكم</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($contractPartners as $contract )

                                            <tr class="row1" data-id="{{ $contract->id }}" >
                                                <td>{{$contract->Partners->name}}</td>
                                                <td>
                                                @foreach($contract->contractPartners as $partner)
                                                   {{$partner->name}} ,
                                                @endforeach
                                                </td>
                                                <td>{{$contract->from}}</td>
                                                <td>{{$contract->to}}</td>
                                                <td>{{$contract->percentage}}</td>
                                                <td>{{$contract->type_of_contract}}</td>

                                                <td><a    href="{{ URL::asset($contract->file)}}"  target="_blank" >
                                                        <i class="icon-eye"></i>
                                                    </a> </td>
                                                <td class="text-truncate">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        @if( auth()->user()->hasRole(['administrator','superadministrator']) || auth()->user()->hasPermission('contracts-partners-update') )

                                                        <a href="{{route('contract-partner.edit', $contract->id)}}" class="btn btn-info btn-sm round"> تعديل</a>
                                                        @endif
                                                            @if( auth()->user()->hasRole(['administrator','superadministrator']) || auth()->user()->hasPermission('contracts-partners-delete') )

                                                            <form action="{{route('contract-partner.destroy' ,$contract->id)}}" method="POST" class="btn-group">
                                                            @csrf @method('delete')
                                                            <button

                                                                class="btn btn-danger btn-sm round"
                                                                onclick="return confirm('حذف هذا  العقود سيقوم بحذف جميع الفروع و الالعاب المتعلقه به!! هل انت متاكد من الحذف ؟')"
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
                                                لايوجد عقود للشركاء  حاليا
                                            </tr>
                                        @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--                @if($contracts->hasPages())--}}
{{--                    {{$contracts->appends(request()->input())->links('pagination::bootstrap-4')}}--}}
{{--                @endif--}}
                <!--/ Recent Transactions -->
            </div>
        </div>
    </div>
@endsection

