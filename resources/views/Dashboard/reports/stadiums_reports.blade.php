@extends('Dashboard.includes.admin')
@section('content')
    <!-- modal medium -->
    <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Filter </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('reports.subscription_reports')}}" method="GET">
                    @csrf
                    <input type="hidden" name="filter" value="1">

                    <div class="modal-body">


                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="" class="control-label mb-1"> البحث </label>
                                    <input class="form-control" type="text" name="search_keyword"
                                           value="{{request('search_keyword')}}">
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">فرع:</label>
                                    <select class="form-control" name="branch_id">
                                        <option value="">اختر فرع</option>
                                        @foreach($branches as $branch)
                                            <option value="{{$branch->id}}"
                                                    {{ $branch->id == request('branch_id') ? 'selected' : '' }}
                                            >{{$branch->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">الملعب:</label>
                                    <select class="form-control" name="stadium">
                                        <option value="">اختر ملعب</option>
                                        @foreach($stadiums as $stadium)
                                            <option value="{{$stadium->id}}"
                                                    {{ $stadium->id == request('stadium') ? 'selected' : '' }}
                                            >{{$stadium->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">من التاريخ:</label>
                                    <input class="form-control" type="date" name="fromDate"
                                           value="{{request('fromDate')}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="" class="control-label mb-1"> الي التاريخ </label>
                                    <input class="form-control" type="date" name="toDate" value="{{request('toDate')}}">
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <input type="submit" value="Confirm" class="btn btn-primary">
                        {{-- <button type="button"  class="btn btn-primary">Confirm</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal medium -->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم التقارير</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/admin')}}">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">كل التقارير</li>
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
                                <h4 class="card-title">التقارير</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div>
                                    <form action="{{route('reports.stadiums_reports')}}" method="GET">

                                        <input type="hidden" name="filter" value="1">

                                        <div class="modal-body">


                                            <div class="row">
                                                <div class="col-md-12 mt-2">
                                                    <div class="form-group">
                                                        <label for="" class="control-label mb-1">فرع:</label>
                                                        <select class="form-control" name="branch_id">
                                                            <option value="">اختر فرع</option>
                                                            @foreach($branches as $branch)
                                                                <option value="{{$branch->id}}"
                                                                        {{ $branch->id == request('branch_id') ? 'selected' : '' }}
                                                                >{{$branch->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <div class="form-group">
                                                        <label for="" class="control-label mb-1">الملعب:</label>
                                                        <select class="form-control" name="stadium">
                                                            <option value="">اختر ملعب</option>
                                                            @foreach($stadiums as $stadium)
                                                                <option value="{{$stadium->id}}"
                                                                        {{ $stadium->id == request('stadium') ? 'selected' : '' }}
                                                                >{{$stadium->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="" class="control-label mb-1"> التاريخ:</label>
                                                        <input class="form-control" type="date" name="fromDate"
                                                               value="{{request('fromDate')}}">
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Cancel
                                            </button>
                                            <input type="submit" value="Confirm" class="btn btn-primary">
                                            {{-- <button type="button"  class="btn btn-primary">Confirm</button> --}}
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-content">

                                <div class="table-responsive">
                                    {{--                                        <h6 class="text-center mt-5">@lang('validation.'.$key)</h6>--}}
                                    <table id="tablecontents" class="table table-hover table-xl mb-0 sortable">
                                        <thead>
                                        <tr>
                                            <th class="border-top-0"> التاريخ</th>
                                            <th class="border-top-0"> اليوم</th>
                                            <th class="border-top-0"> الملعب</th>
                                            <th class="border-top-0"> أسم المدرب</th>
                                            <th class="border-top-0"> أسماء اللاعبين</th>
                                            <th class="border-top-0"> من</th>
                                            <th class="border-top-0">الي</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $currentTime = \Carbon\Carbon::parse(request('fromDate').' 00:00:00'); // Start from 12 AM
                                            $endTime = \Carbon\Carbon::parse(request('fromDate').' 23:30:00');    // End at 11:30 PM
                                        @endphp

                                        @while($currentTime->lt($endTime))
                                            @php
                                                $reserved = false;
                                                $currentRow = null;
                                                $currently = $currentTime->copy();
                                                $after30Minutes = $currently->addMinutes(30);
                                                // Check if there is a row for the current time
                                                    foreach($reports as $report) {

                                                    $rowStartHour = \Carbon\Carbon::parse($report->time_from);
                                                    $rowEndHour = \Carbon\Carbon::parse($report->time_to);
                                                    if ($currentTime->timestamp >= $rowStartHour->timestamp
                                                   && $currentTime->timestamp <  $rowEndHour->timestamp
                                                    )
                                                       {
                                                            $reserved = true;
                                                            $currentRow = $report;
                                                            break;
                                                        }

                                                }
                                            @endphp

                                            <tr class="{{ $reserved ? 'row1' : 'غير محجوز' }}">
                                                <td>{{ $reserved ? \Carbon\Carbon::parse($currentRow->time_from)->format('d/m/Y') : (request('fromDate') ? request('fromDate') : $currentTime->format('d/m/Y') ) }}</td>
                                                <td>{{ $reserved ? __('validation.'.$currentRow->day) : 'غير محجوز' }}</td>
                                                <td>{{ $reserved ? $currentRow->stadiums->name : 'غير محجوز' }}</td>
                                                <td>{{ $reserved ? ($currentRow->name ?? $currentRow->traniers->name) : 'غير محجوز' }}</td>
                                                <td>
                                                    @if($currentRow)
                                                        @if($currentRow->players && $currentRow->players->count() > 1)

                                                            @foreach ($currentRow->players as $player)
                                                                {{ $player->players->name }} <br>
                                                            @endforeach
                                                        @else
                                                            غير محجوز
                                                        @endif
                                                    @else
                                                        غير محجوز
                                                    @endif
                                                </td>
                                                <td>{{ $currentTime->format('h:i A') }}</td>
                                                @php
                                                    // Increment time by 30 minutes for the next iteration
                                                    $currentTime->addMinutes(30);
                                                @endphp
                                                <td>{{  $currentTime->format('h:i A') }}</td>
                                            </tr>

                                        @endwhile
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            checkfromType();
            $('.from_type').change(function () {
                checkfromType();

            });

        });

        function checkfromType() {
            if ($('input[name="from_type"]:checked').val() == 'players') {
                $('#from_players').show();
                $('#from_others').hide();
                $('#others_id').val("");

            }
            if ($('input[name="from_type"]:checked').val() == 'others') {
                $('#from_others').show();

                $('#from_players').hide();
                $('#player_id').val("");

            }
        }
    </script>
@endsection
