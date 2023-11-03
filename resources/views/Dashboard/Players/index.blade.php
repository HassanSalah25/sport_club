@extends('Dashboard.includes.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم اللاعبيين</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/admin')}}">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">كل اللاعبيين</li>
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
                                <h4 class="card-title">اللاعبيين ({{$players->count()}})</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">

                                        <li>
                                            <a class="btn btn-sm btn-success box-shadow-2 round btn-min-width pull-right" href="{{route('player.create')}}"> <i class="ft-plus ft-md"></i> اضافة لاعب جديد</a>
                                        </li>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-hover table-xl mb-0 sortable">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">  اسم اللاعب</th>
                                            <th class="border-top-0"> تاريخ الميلاد</th>

                                            <th class="border-top-0">   تاريخ الالتحاق</th>
                                            <th class="border-top-0">   اسم الاب</th>
                                            <th class="border-top-0">   هاتف الاب</th>
                                            <th class="border-top-0">   وظيفه الاب</th>
                                            <th class="border-top-0">   البريد الالكتروني لاب</th>
                                            <th class="border-top-0">   الفرع</th>
                                            <th class="border-top-0">   اللعبه</th>
                                            <th class="border-top-0">   المستوي</th>
                                            <th class="border-top-0">   الباكدج</th>
                                            <th class="border-top-0">   االالعاب اخري</th>
                                            <th class="border-top-0">  الانضمام عن طريق</th>
                                            <th class="border-top-0">   الهدف من اللعبه</th>


                                            <th class="border-top-0">التحكم</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($players as $player )

                                            <tr class="row1" data-id="{{ $player->id }}" >
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$player->name}}</td>
                                                <td>{{$player->birth_day}}</td>
                                                <td>{{$player->join_day}}</td>
                                                <td>{{$player->father_name}}</td>
                                                <td>{{$player->father_phone}}</td>
                                                <td>{{$player->father_job}}</td>
                                                <td>{{$player->father_email}}</td>
                                                <td>{{$player->branches?->name}}</td>
                                                <td>{{$player->sports?->name}}</td>
                                                <td>{{$player->level?->name ?? '---'}}</td>
                                                <td>{{$player->package->name ?? '---'}}</td>
                                                <td>{{$player->anther_sport}}</td>
                                                <td>{{$player->join_by}}</td>
                                                <td>{{$player->goal_of_sport}}</td>






                                                <td class="text-truncate">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        @if( auth()->user()->hasRole(['administrator','superadministrator']) || auth()->user()->hasPermission('players-update')  )

                                                        <a href="{{route('player.edit', $player->id)}}" class="btn btn-info btn-sm round"> تعديل</a>
                                                        @endif
                                                            @if( auth()->user()->hasRole(['administrator','superadministrator']) || auth()->user()->hasPermission('players-delete')  )

                                                            <form action="{{route('player.destroy' ,$player->id)}}" method="POST" class="btn-group">
                                                            @csrf @method('delete')
                                                            <button

                                                                class="btn btn-danger btn-sm round"
                                                                onclick="return confirm('حذف هذا الاعب سيقوم بحذف جميع الملفات و الالعاب المتعلق به!! هل انت متاكد من الحذف ؟')"
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
                                                <td colspan="20">
                                                    لايوجد لاعبين حاليا

                                                </td>
                                            </tr>
                                        @endforelse

                                        </tbody>
                                    </table>
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
        let table = new DataTable('#myTable');
    </script>
@endsection
