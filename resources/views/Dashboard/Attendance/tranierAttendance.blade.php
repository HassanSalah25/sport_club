@extends('Dashboard.includes.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم الحضور و الانصراف للاعبيين </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/admin')}}">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">كل الحضور و الانصراف للاعبيين</li>
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
                                <h4 class="card-title">الحضور و الانصراف للاعبيين ({{$trainers->total()}})</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">

                                </div>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table id="tablecontents" class="table table-hover table-xl mb-0 sortable">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0"> اسم المدرب</th>
                                            <th class="border-top-0"> حضور</th>

                                            <th class="border-top-0"> انصراف</th>
                                            <th class="border-top-0">حضر من</th>
                                            <th class="border-top-0">انصرف في</th>


                                            {{--                                            <th class="border-top-0">مشاهده التفاصيل </th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($trainers as $trainer )

                                            <tr class="row1" data-id="{{ $trainer->id }}">
                                                <td>{{$trainer->traniers->name}}</td>

                                                <td>
                                                    @if(\App\Models\TrainerAttendance::where('trainer_id',$trainer->id)->whereDate('check_in',\Carbon\Carbon::today())->count() == 0)
                                                        <form action="{{route('attendance-trainer.store')}}"
                                                              method="post">
                                                            @csrf
                                                            <input type="hidden" name="trainer_id"
                                                                   value="{{$trainer->id}}">

                                                            <button class="btn btn-success" name="check" value="in">
                                                                حضور
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(\App\Models\TrainerAttendance::where('trainer_id',$trainer->id)->whereDate('check_out',\Carbon\Carbon::today())->count() == 0)
                                                    <form action="{{route('attendance-trainer.store')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="trainer_id" value="{{$trainer->id}}">

                                                        <button class="btn btn-danger" name="check" value="out">
                                                            انصراف
                                                        </button>
                                                    </form>
                                                    @endif
                                                </td>
                                                @php
                                                    $check_in =
                                                    \App\Models\TrainerAttendance::where('trainer_id',$trainer->id)
                                                    ->whereDate('check_in',\Carbon\Carbon::today())->first()?->check_in;

                                                    $checkout =
                                                    \App\Models\TrainerAttendance::where('trainer_id',$trainer->id)
                                                    ->whereDate('check_out',\Carbon\Carbon::today())->first()?->check_out;
                                                    $time_from = $check_in ? \Carbon\Carbon::parse($check_in)->format('h:i A') : null;
                                                    $time_to = $checkout ? \Carbon\Carbon::parse($checkout)->format('h:i A') : null;
                                                @endphp
                                                <td>
                                                    {{$time_from ?? "-----"}}
                                                </td>
                                                <td>
                                                    {{$time_to ?? "-----"}}
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                لايوجد حضور و انصراف حاليا
                                            </tr>
                                        @endforelse

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($trainers->hasPages())
                    {{$trainers->appends(request()->input())->links('pagination::bootstrap-4')}}
                @endif
                <!--/ Recent Transactions -->
            </div>
        </div>
    </div>
@endsection

