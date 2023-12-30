@extends('Dashboard.includes.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم جدول الملاعب والتدريبات</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('/admin')}}">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">كل جدول الملاعب والتدريبات</li>
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
                                <h4 class="card-title"></h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">

                                        <li>
                                            {{--                                            <a class="btn btn-sm btn-success box-shadow-2 round btn-min-width pull-right" href="{{route('receipt.create')}}"> <i class="ft-plus ft-md"></i> اضافة ايصال جديد</a>--}}
                                        </li>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div id="calendarModalDetails" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 id="modalTitle" class="modal-title">تعديل الميعاد</h4>
                                            <button type="button" class="close" data-dismiss="modal"><span
                                                    aria-hidden="true">×</span> <span class="sr-only">close</span>
                                            </button>
                                        </div>
                                        <div id="modalBody" class="modal-body">

                                            <form class="form" id="form_id" action="" method="POST">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="branch_id"> الفرع </label>
                                                                <select
                                                                    class=" form-control branch_id"
                                                                    name="branch_id" id="branch_id">
                                                                    <option
                                                                        data-price="" value="">اختر الفرع
                                                                    </option>
                                                                    @foreach($branches as $branch)
                                                                        <option
                                                                            data-price="{{$branch->id}}"
                                                                            value="{{$branch->id}}">{{$branch->name}}</option>

                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> الملعب </label>
                                                                <select
                                                                    class=" form-control stadium_id"
                                                                    name="stadium_id" id="stadium_id">
                                                                    {{--                                                                    @foreach($stadiums as $stadium)--}}
                                                                    {{--                                                                        <option--}}
                                                                    {{--                                                                            value="{{$stadium->id}}">{{$stadium->name}}</option>--}}

                                                                    {{--                                                                    @endforeach--}}
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput3"> الالعاب </label>
                                                                <select name="sport_id" id="sport_id"
                                                                        class="form-control sport_id">
                                                                    <option value="">اختر لعبه</option>

                                                                    @foreach($sports as $sport)
                                                                        <option
                                                                            value="{{$sport->id}}">{{$sport->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput3"> المستويات </label>
                                                                <select name="level_id" id="level_id"
                                                                        class=" form-control level_id"
                                                                        style="width: 100% !important;">
                                                                    <option></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> المدرب </label>
                                                                <select
                                                                    class=" form-control user_id"
                                                                    name="user_id" id="user_id">
                                                                    @foreach($users as $user)
                                                                        <option
                                                                            value="{{$user->id}}">{{$user->name}}</option>

                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> اللاعب </label>
                                                                <select style="width: 100% !important;"
                                                                        class="select2 form-control player_id"
                                                                        multiple="multiple"
                                                                        name="player_id"
                                                                        id="player_id">
                                                                </select>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> من </label>
                                                                <input style="width: 100% !important;"
                                                                       class="form-control time_from" type="time"
                                                                       name="time_from"
                                                                       id="time_from1">

                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> الي </label>
                                                                <input style="width: 100% !important;"
                                                                       class="form-control time_to" type="time"
                                                                       name="time_to"
                                                                       id="time_to1">

                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="repeated"> مكرر خلال الشهر </label>
                                                                <input class="form-check-inline mx-1 " type="checkbox"
                                                                       name="repeated"
                                                                       id="repeated">

                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </form>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="updateEvent" class="btn btn-primary"
                                            >تعديل
                                            </button>
                                            <button type="button" id="deleteEvent" class="btn btn-danger"
                                            >حذف
                                            </button>
                                            <button type="button" class="btn btn-default close_btn"
                                                    data-dismiss="modal">الغاء
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="calendarModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 id="modalTitle" class="modal-title">انشاء ميعاد</h4>
                                            <button type="button" class="close" data-dismiss="modal"><span
                                                    aria-hidden="true">×</span> <span class="sr-only">الغاء</span>
                                            </button>
                                        </div>
                                        <div id="modalBody" class="modal-body">

                                            <form class="form" id="form_id" action="" method="POST"
                                            >
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> الفرع </label>
                                                                <select
                                                                    class=" form-control branch_id1"
                                                                    name="b ranch_id" id="branch_id">
                                                                    <option
                                                                        data-price="" value="">اختر الفرع
                                                                    </option>
                                                                    @foreach($branches as $branch)
                                                                        <option
                                                                            data-price="{{$branch->id}}"
                                                                            value="{{$branch->id}}">{{$branch->name}}</option>

                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> الملعب </label>
                                                                <select
                                                                    class=" form-control stadium_id1"
                                                                    name="stadium_id" id="stadium_id">
                                                                    {{--                                                                    @foreach($stadiums as $stadium)--}}
                                                                    {{--                                                                        <option--}}
                                                                    {{--                                                                            value="{{$stadium->id}}">{{$stadium->name}}</option>--}}

                                                                    {{--                                                                    @endforeach--}}
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput3"> الالعاب </label>
                                                                <select name="sport_id" id="sport_id"
                                                                        class="form-control sport_id1">
                                                                    <option value="">اختر لعبه</option>

                                                         {{--           @foreach($sports as $sport)
                                                                        <option
                                                                            value="{{$sport->id}}">{{$sport->name}}</option>
                                                                    @endforeach--}}
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput3"> المستويات </label>
                                                                <select name="level_id" id="level_id"
                                                                        class=" form-control level_id1"
                                                                        style="width: 100% !important;">
                                                                    <option></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> المدرب </label>
                                                                <select
                                                                    class=" form-control user_id1"
                                                                    name="user_id" id="user_id">
                                                                  {{--  @foreach($users as $user)
                                                                        <option
                                                                            value="{{$user->id}}">{{$user->name}}</option>

                                                                    @endforeach--}}
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> اللاعب </label>
                                                                <select style="width: 100% !important;"
                                                                        class="select2 form-control player_id1"
                                                                        multiple="multiple"
                                                                        name="player_id"
                                                                        id="player_id">
                                                                </select>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> من </label>
                                                                <input style="width: 100% !important;"
                                                                       class="form-control time_from1" type="time"
                                                                       name="time_from"
                                                                       id="time_from">

                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> الي </label>
                                                                <input style="width: 100% !important;"
                                                                       class="form-control time_to1" type="time"
                                                                       name="time_to"
                                                                       id="time_to">

                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="repeated"> مكرر خلال الشهر </label>
                                                                <input class="form-check-inline mx-1 " type="checkbox"
                                                                       name="repeated"
                                                                       id="repeated1">

                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </form>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="saveEvent" class="btn btn-primary"
                                            >حفظ
                                            </button>
                                            <button type="button" class="btn btn-default close_btn"
                                                    data-dismiss="modal">الغاء
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id='calendar'>

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
        $(document).ready(function () {
            $('.branch_id1').on('change', function () {
                console.log('sdsd')
                var id = $(this).val();
                var route = "{{route('get-stadiums')}}";
                $.ajax(route,   // request url
                    {
                        type: 'GET',  // http method
                        data: {"branch_id": id},
                        success: function (data, status, xhr) {// success callback function
                            console.log(data)
                            var options = [];
                            var option = $('<option>', {
                                text: 'اختر ملعب',
                            });
                            options.push(option);
                            data.forEach(function (e) {
                                console.log(e);
                                var option = $('<option>', {
                                    value: e.id,
                                    text: e.name,
                                });
                                options.push(option);
                            });
                            $('.stadium_id1').empty().append(options);


                        }
                    });
            })
            $('.sport_id1').on('change', function () {
                var id = $(this).val();
                $('.user_id1').attr('data-sport_id', id);
                var route = "{{route('get-levels')}}";
                $.ajax(route,   // request url
                    {
                        type: 'GET',  // http method
                        data: {"sport_id": id},
                        success: function (data, status, xhr) {// success callback function
                            $(".level_id1").html(data.data);

                        }
                    });
            });
            $('.level_id1').on('change', function () {
                var id = $(this).val();
                $('.user_id1').attr('data-level_id', id);
                var id = $(this).val();
                var sport_id = $('.user_id1').data('sport_id');
                var route = "{{route('get-trainers')}}";
                $.ajax(route,   // request url
                    {
                        type: 'GET',  // http method
                        data: { 'level_id': id, 'sport_id': sport_id},
                        success: function (data, status, xhr) {// success callback function
                            console.log('data' + data)

                            $('.user_id1').empty().append(data.data);
                        }
                    });

            });


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                slotDuration: '00:05:00',
                events: "{{ route('trainer-and-player.create') }}",
                selectable: true,
                selectHelper: true,

                select: function (start, end, allDay) {
                    $("#calendarModal").modal("show");
                    $("#saveEvent").click(function () {
                        console.log(start);
                        var day = $.fullCalendar.formatDate(start, 'Y-MM-DD ');
                        var stadium_id = $('.stadium_id1').val();
                        var branch_id = $('.branch_id1').val();
                        var player_id = $('.player_id1').select2("val");
                        var user_id = $('.user_id1').val();
                        var sport_id = $('.sport_id1').val();
                        var level_id = $('.level_id1').val();
                        var from = $('.time_from1').val();
                        var to = $('.time_to1').val();
                        var repeated = $('#repeated1').prop('checked');
                        var from_date = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                        var to_date = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');


                        if (user_id) {
                            var Route = "{{route('store-event')}}";
                            jQuery.ajax({
                                url: Route,
                                type: "POST",
                                dataType: 'json',
                                data: {
                                    stadium_id: stadium_id,
                                    player_id: player_id,
                                    branch_id: branch_id,
                                    user_id: user_id,
                                    sport_id: sport_id,
                                    level_id: level_id,
                                    day: day,
                                    from: from,
                                    to: to,
                                    repeated: repeated
                                },
                                success: function (data) {
                                    if (data.status == 400) {
                                        $('.modal-body').find('.alert-danger').remove();
                                        $('.modal-body').append(` <div class="alert alert-danger alert-block" style="z-index: 100000">
                                                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                                            <strong>${data.error}</strong>
                                                                        </div>
                                                                        `);
                                    } else {
                                        $('.modal-body').find('.alert-danger').remove();
                                        calendar.fullCalendar('refetchEvents');
                                        $("#calendarModal").modal("hide");
                                        location.reload();
                                    }

                                },
                                error: function (xhr, status, error) {
                                    $('.modal-body').find('.alert-danger').remove();
                                    $('.modal-body').append(` <div class="alert alert-danger alert-block" style="z-index: 100000">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>${error.to}</strong>
                                    </div>
                                    `);
                                }

                            });
                        }

                    });

                },
                editable: true,
                eventResize: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                    var title = event.title;
                    var id = event.id;
                    var Route = "{{route('update-event')}}";

                    $.ajax({
                        url: Route,
                        type: "post",
                        data: {
                            start: start,
                            end: end,
                            id: id,
                            type: 'update'
                        },
                        success: function (response) {
                            calendar.fullCalendar('refetchEvents');
                            // alert("تم تعديل المعاد  ");
                        }
                    })


                },
                eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                    var title = event.title;
                    var id = event.id;
                    var Route = "{{route('update-event')}}";

                    $.ajax({
                        url: Route,
                        type: "POST",
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            id: id,
                            type: 'update'
                        },
                        success: function (response) {
                            calendar.fullCalendar('refetchEvents');
                            // alert("تم تعديل الميعاد  ");
                        }
                    })
                },

                eventClick: function (event) {

                    var id = event.id;
                    var Route = "{{route('show-event')}}";
                    $.ajax({
                        url: Route,
                        type: "get",
                        data: {
                            id: id,
                            type: "show"
                        },
                        success: function (response) {
                            console.log(response)
                            $("#calendarModalDetails").modal("show");
                            $('.branch_id').val(response.event.branch_id);
                            $('.branch_id').each(function () {
                                var id = $(this).val();
                                var route = "{{route('get-stadiums')}}";
                                $.ajax(route,   // request url
                                    {
                                        type: 'GET',  // http method
                                        data: {"branch_id": id},
                                        success: function (data, status, xhr) {// success callback function
                                            console.log(data)
                                            var options = [];
                                            var option = $('<option>', {
                                                text: 'اختر ملعب',
                                            });

                                            options.push(option);
                                            data.forEach(function (e) {
                                                console.log(e);

                                                var option = $('<option>', {
                                                    value: e.id,
                                                    text: e.name,
                                                    selected: e.id == response.event.stadium_id
                                                });
                                                options.push(option);
                                            });
                                            $('.stadium_id').empty().append(options);
                                            $('.sport_id').val(response.event.sport_id)
                                            $('.sport_id').each(function () {
                                                var id = $(this).val();
                                                $('.user_id').attr('data-sport_id', id);
                                                var route = "{{route('get-levels')}}";
                                                $.ajax(route,   // request url
                                                    {
                                                        type: 'GET',  // http method
                                                        data: {"sport_id": id, "level_id": response.event.level_id},
                                                        success: function (data, status, xhr) {// success callback function
                                                            $(".level_id").html(data.data);
                                                            $('.level_id').each(function () {
                                                                var id = $(this).val();
                                                                $('.user_id').attr('data-level_id', id);

                                                            });
                                                        }
                                                    });
                                            });
                                            $('.user_id').val(response.event.trainer_id);
                                            $('.user_id').each(function () {
                                                var id = response.event.trainer_id;
                                                var sport_id = response.event.sport_id;
                                                var level_id = response.event.level_id;
                                                var route = "{{route('get-players')}}";
                                                $.ajax(route,   // request url
                                                    {
                                                        type: 'GET',  // http method
                                                        data: {
                                                            "user_id": id,
                                                            'level_id': level_id,
                                                            'sport_id': sport_id
                                                        },
                                                        success: function (data, status, xhr) {// success callback function

                                                            var palyers = response.players;
                                                            var options = [];
                                                            data.forEach(function (e) {
                                                                var option = $('<option>', {
                                                                    value: e.id,
                                                                    text: e.name,
                                                                    selected: palyers.includes(e.id)
                                                                });
                                                                options.push(option);
                                                            });
                                                            $('.player_id').empty().append(options);


                                                        }
                                                    });
                                            })

                                            const timeFrom = new Date(response.event.time_from);
                                            const timeFromString = `${timeFrom.getHours().toString().padStart(2, '0')}:${timeFrom.getMinutes().toString().padStart(2, '0')}`;
                                            const timeTo = new Date(response.event.time_to);
                                            const timeToString = `${timeTo.getHours().toString().padStart(2, '0')}:${timeTo.getMinutes().toString().padStart(2, '0')}`;
                                           console.log(response.event.event_repeated)
                                            if(response.event.event_repeated){
                                                $('#repeated').prop('checked',true);
                                            }



                                            $('#time_from1').val(timeFromString);
                                            $('#time_to1').val(timeToString);

                                        }
                                    });
                            })
                            $("#updateEvent").click(function () {
                                var day = response.event.date;
                                var stadium_id = $('.stadium_id').val();
                                var branch_id = $('.branch_id').val();
                                var player_id = $('.player_id').select2("val");
                                var user_id = $('.user_id').val();
                                var sport_id = $('.sport_id').val();
                                var level_id = $('.level_id').val();
                                var from = $('.time_from').val();
                                var to = $('.time_to').val();
                                var  repeated = $('#repeated').prop('checked');
                                var trainerAndPlayer_id = response.event.id;
                                if (user_id) {
                                    var Route = "{{route('update-event')}}";
                                    jQuery.ajax({
                                        url: Route,
                                        type: "POST",
                                        dataType: 'json',
                                        data: {
                                            stadium_id: stadium_id,
                                            player_id: player_id,
                                            branch_id: branch_id,
                                            user_id: user_id,
                                            sport_id: sport_id,
                                            level_id: level_id,
                                            day: day,
                                            from: from,
                                            to: to,
                                            trainerAndPlayer_id: trainerAndPlayer_id,
                                            repeated: repeated,
                                        },
                                        success: function (data) {
                                            if (data.status == 400) {
                                                $('.modal-body').find('.alert-danger').remove();
                                                $('.modal-body').append(` <div class="alert alert-danger alert-block" style="z-index: 100000">
                                                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                                            <strong>${data.error}</strong>
                                                                        </div>
                                                                        `);
                                            } else {
                                                $('.modal-body').find('.alert-danger').remove();
                                                calendar.fullCalendar('refetchEvents');
                                                $("#calendarModalDetails").modal("hide");
                                            }

                                        },
                                        error: function (data, xhr, status, error) {
                                            console.log(error)
                                            $('.modal-body').find('.alert-danger').remove();
                                            $('.modal-body').append(` <div class="alert alert-danger alert-block" style="z-index: 100000">
                                                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                                                                 <strong>${error.to}</strong>
                                                                        </div>
                                                                        `);
                                        }

                                    });
                                }

                            });

                            // $('.stadium_id').val(response.event.stadium_id);
                            // $('#trainer_name').val(response.event.trainer_id);
                            // $('.player_id').select2(response.players);
                            // $('.user_id').val();
                            // $('.sport_id').val();
                            // $('.level_id').val();
                            // $('.time_from').val();
                            // $('.time_to').val();
                            // $('#repeated').prop('checked');


                        }
                    })

                    $('#deleteEvent').click(function () {

                        if (confirm("هل انت  متاكد من حذف هذا اليعاد")) {
                            var id = event.id;
                            var Route = "{{route('delete-event')}}";
                            $.ajax({
                                url: Route,
                                type: "POST",
                                data: {
                                    id: id,
                                    type: "delete"
                                },
                                success: function (response) {
                                    calendar.fullCalendar('refetchEvents');
                                    $("#calendarModalDetails").modal("hide");

                                    // alert("تم حذف الميعاد من التقويم  ");
                                }
                            })
                        }
                    });

                }
            });

        });

        $('.user_id1').on('change', function () {
            var id = $(this).val();
            var sport_id = $(this).data('sport_id');
            var level_id = $(this).data('level_id');
            var route = "{{route('get-players')}}";
            $.ajax(route,   // request url
                {
                    type: 'GET',  // http method
                    data: {"user_id": id, 'level_id': level_id, 'sport_id': sport_id},
                    success: function (data, status, xhr) {// success callback function
                        console.log('data' + data)
                        var options = [];
                        data.forEach(function (e) {
                            var option = $('<option>', {
                                value: e.id,
                                text: e.name,
                            });
                            options.push(option);
                        });
                        $('.player_id1').empty().append(options);
                    }
                });
        })

        $('.stadium_id1').on('change', function () {
            var id = $(this).val();
            var route = "{{route('get-sports')}}";
            $.ajax(route,   // request url
                {
                    type: 'GET',  // http method
                    data: {"stadium_id": id},
                    success: function (data, status, xhr) {// success callback function
                        console.log('data' + data)
                        $('.sport_id1').empty().append(data.data);
                    }
                });
        })

        $('.user_id').on('change', function () {
            var id = $(this).val();
            var sport_id = $(this).data('sport_id');
            var level_id = $(this).data('level_id');
            var route = "{{route('get-players')}}";
            $.ajax(route,   // request url
                {
                    type: 'GET',  // http method
                    data: {"user_id": id, 'level_id': level_id, 'sport_id': sport_id},
                    success: function (data, status, xhr) {// success callback function
                        console.log('data' + data)
                        var options = [];
                        data.forEach(function (e) {
                            var option = $('<option>', {
                                value: e.id,
                                text: e.name,
                            });
                            options.push(option);
                        });
                        $('.player_id').empty().append(options);
                    }
                });
        })

        $('.close_btn').on('click', function () {
            $('.modal-body').find('.alert-danger').remove();
            $('.stadium_id').val('');
            $('.branch_id').val('');
            $('.player_id').find('option').remove();
            $('.user_id').val('');
            $('.sport_id').val('');
            $('.level_id').val('');
            $('.time_from').val('');
            $('.time_to').val('');
        })
    </script>

@endsection

