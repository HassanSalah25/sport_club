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
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div id="calendarModalEdit" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span
                                                    aria-hidden="true">×</span> <span class="sr-only">close</span>
                                            </button>
                                            <h4 id="modalTitle" class="modal-title"></h4>
                                        </div>
                                        <div id="modalBody" class="modal-body">

                                            <form class="form" id="form_id" action="" method="POST">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> الفرع </label>
                                                                <select
                                                                    class=" form-control"
                                                                    name="branch_id" id="branch_id2">
                                                                    @foreach($branches as $branch)
                                                                        <option
                                                                            data-price="{{$branch->id}}"
                                                                            value="{{$branch->id}}">{{$branch->name}}</option>

                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> الملعب </label>
                                                                <select
                                                                    class=" form-control"
                                                                    name="stadium_id" id="stadium_id2">
                                                                    @foreach($stadiums as $stadium)
                                                                        <option
                                                                            data-price="{{$stadium->hour_rate}}"
                                                                            value="{{$stadium->id}}">{{$stadium->name}}</option>

                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        {{--<div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> سعر الايجار للساعه  </label>
                                                                <input  class="form-control" type="number" name="price" id="hour_rate">
                                                            </div>
                                                        </div>--}}

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 ">
                                                            <div class="form-group">
                                                                <label>مدرب </label>
                                                                <input class="from_type " type="radio" id="players2"
                                                                       name="type" value="trainer">
                                                                <label>مستاجر </label>
                                                                <input class=" from_type" type="radio" id="others2"
                                                                       name="type" value="stranger">

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 div_name" id="div_name" style="display: none;">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> اسم المستاجر </label>
                                                                <input id="name2" class=" form-control" name="name">

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 div_trainer" id="div_trainer">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> المدرب </label>
                                                                <select
                                                                    class=" form-control"
                                                                    name="user_id" id="user_id2">
                                                                    @foreach($users as $user)
                                                                        <option
                                                                            value="{{$user->id}}">{{$user->name}}</option>

                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> من الساعه </label>
                                                                <input class="form-control" type="time" name="form"
                                                                       id="from_date2">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> الي الساعه </label>
                                                                <input class="form-control" type="time" name="to"
                                                                       id="to_date2">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="repeated"> مكرر خلال الشهر </label>
                                                            <input class="form-check-inline mx-1 " type="checkbox"
                                                                   name="repeated"
                                                                   id="repeated2">

                                                        </div>
                                                    </div>

                                                </div>
                                            </form>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="updateEvent" class="btn btn-primary"
                                            >save
                                            </button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="calendarModalDetails" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span
                                                    aria-hidden="true">×</span> <span class="sr-only">close</span>
                                            </button>
                                            <h4 id="modalTitle" class="modal-title"></h4>
                                        </div>
                                        <div id="modalBody" class="modal-body">
                                            <table class="table table-bordered table-striped table-responsive">

                                                <tbody id="stadium_details">

                                                </tbody>
                                            </table>
                                            <hr>
                                            <h6 class="text-center"> اذا اردت حذف الحجز يجب عليك ذكر السبب و من
                                                مين </h6>
                                            <form class="form" action="" method="POST"
                                            >
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-6">

                                                            <div class="form-group">
                                                                <label>الاداره </label>
                                                                <input class="type_who " type="radio" name="type_who"
                                                                       value="management">
                                                                <label>مستاجر </label>
                                                                <input class=" type_who" type="radio" name="type_who"
                                                                       value="renter">

                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for=""> اذكر سبب حذف الحجز</label>
                                                                <textarea class="form-control" name="reason" id="reason"
                                                                          cols="" rows="5"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="deleteEvent" class="btn btn-danger"
                                            >حذف
                                            </button>
                                            <button type="button" id="editEvent" class="btn btn-info"
                                            >تعديل
                                            </button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">غلق
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="calendarModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span
                                                    aria-hidden="true">×</span> <span class="sr-only">close</span>
                                            </button>
                                            <h4 id="modalTitle" class="modal-title"></h4>
                                        </div>
                                        <div id="modalBody" class="modal-body">

                                            <form class="form" id="form_id" action="" method="POST">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> الفرع </label>
                                                                <select
                                                                    class=" form-control"
                                                                    name="branch_id" id="branch_id">
                                                                    @foreach($branches as $branch)
                                                                        <option
                                                                            data-price="{{$branch->id}}"
                                                                            value="{{$branch->id}}">{{$branch->name}}</option>

                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> الملعب </label>
                                                                <select
                                                                    class=" form-control"
                                                                    name="stadium_id" id="stadium_id">
                                                                    @foreach($stadiums as $stadium)
                                                                        <option
                                                                            data-price="{{$stadium->hour_rate}}"
                                                                            value="{{$stadium->id}}">{{$stadium->name}}</option>

                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        {{--<div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> سعر الايجار للساعه  </label>
                                                                <input  class="form-control" type="number" name="price" id="hour_rate">
                                                            </div>
                                                        </div>--}}

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 ">
                                                            <div class="form-group">
                                                                <label>مدرب </label>
                                                                <input class="from_type " type="radio" id="players"
                                                                       name="type" value="trainer">
                                                                <label>مستاجر </label>
                                                                <input class="from_type" type="radio" id="others"
                                                                       name="type" value="stranger">

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 div_name" id="div_name" style="display: none;">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> اسم المستاجر </label>
                                                                <input id="name" class=" form-control" name="name">

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 div_trainer" id="div_trainer">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> المدرب </label>
                                                                <select
                                                                    class=" form-control"
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
                                                                <label for="projectinput2"> من الساعه </label>
                                                                <input class="form-control" type="time" name="form"
                                                                       id="from_date">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput2"> الي الساعه </label>
                                                                <input class="form-control" type="time" name="to"
                                                                       id="to_date">
                                                            </div>
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
                                            </form>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" id="saveEvent" class="btn btn-primary"
                                            >save
                                            </button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close
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
            $('#branch_id').on('change', function () {
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
                            $('#stadium_id').empty().append(options);


                        }
                    });
            })
            $('#sport_id').on('change', function () {
                var id = $(this).val();
                var route = "{{route('get-levels')}}";
                $.ajax(route,   // request url
                    {
                        type: 'GET',  // http method
                        data: {"sport_id": id},
                        success: function (data, status, xhr) {// success callback function
                            $("#level_id").html(data.data);

                        }
                    });
            });
            $("#stadium_id").change(function () {
                var price = parseInt($("#stadium_id").find('option:selected').data('price'));
                $("#hour_rate").val(price);

            });
            $('.from_type').change(function () {
                checkfromType();
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

                events: "{{ route('stadium-rent-table.create') }}",
                selectable: true,
                selectHelper: true,

                select: function (start) {
                    $("#calendarModal").modal("show");
                    $("#saveEvent").click(function () {
                        var day = $.fullCalendar.formatDate(start, 'Y-MM-DD ');
                        var stadium_id = $('#stadium_id').val();
                        var hour_rate = $('#hour_rate').val();
                        var user_id = $('#user_id').val();

                        var name = $("#name").val();


                        // var date_from= new Date(day+$("#from_date").val());
                        var date_from = $("#from_date").val();
                        // var date_format_from = date_from.toLocaleString();
                        var date_to = $("#to_date").val();

                        var repeated = $('#repeated').prop('checked');
                        // var date_to= new Date(day+$("#to_date").val());
                        // var date_format_to = date_to.toLocaleString();


                        // var from_date = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                        // var to_date = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');


                        var Route = "{{route('store-stadium')}}";
                        jQuery.ajax({
                            url: Route,
                            type: "POST",
                            dataType: 'json',
                            data: {
                                stadium_id: stadium_id,
                                hour_rate: hour_rate,
                                user_id: user_id,
                                name: name,
                                day: day,
                                from: date_from,
                                to: date_to,
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
                                    calendar.fullCalendar('refetchEvents');
                                    $("#calendarModal").modal("hide");
                                    location.reload();
                                }

                            }

                        });


                    });

                },
                editable: true,
                eventResize: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                    var title = event.title;
                    var id = event.id;
                    var Route = "{{route('update-stadium')}}";

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
                    var Route = "{{route('update-stadium')}}";

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
                    var Route = "{{route('show-stadium')}}";
                    $.ajax({
                        url: Route,
                        type: "get",
                        data: {
                            id: id,
                            type: "show"
                        },
                        success: function (response) {
                            $('#stadium_details').html(response.html);
                            $("#calendarModalDetails").modal("show");

                        }
                    })

                    $('#editEvent').on('click', function () {

                        var Route = "{{route('show-event-stadium')}}";
                        $.ajax({
                            url: Route,
                            type: "get",
                            data: {
                                id: id,
                                type: "show"
                            },
                            success: function (response) {
                                console.log(response)
                                $("#calendarModalDetails").modal("hide");
                                $("#calendarModalEdit").modal("show");
                                $('#branch_id2').val(response.event.stadiums.branch_id);

                                $('#branch_id2').each( function () {
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
                                                        selected: e.id == response.event.stadiums.id
                                                    });
                                                    options.push(option);
                                                });
                                                $('#stadium_id2').empty().append(options);


                                            }
                                        });
                                })
                                if(response.event.type == 'trainer'){
                                    $('#players2').prop('checked', true);
                                    $('#user_id2').val(response.event.user_id)
                                }else{

                                    $('#others2').prop('checked', true);
                                }

                                const timeFrom = new Date(response.event.time_from);
                                const timeFromString = `${timeFrom.getHours().toString().padStart(2, '0')}:${timeFrom.getMinutes().toString().padStart(2, '0')}`;
                                const timeTo = new Date(response.event.time_to);
                                const timeToString = `${timeTo.getHours().toString().padStart(2, '0')}:${timeTo.getMinutes().toString().padStart(2, '0')}`;

                                if(response.event.event_repeated){
                                    $('#repeated2').prop('checked',true);
                                }



                                $('#from_date2').val(timeFromString);
                                $('#to_date2').val(timeToString);
                                $("#updateEvent").click(function () {
                                    console.log('sdsds')
                                    var stadium_id = $('#stadium_id2').val();
                                    var hour_rate = $('#hour_rate2').val();
                                    var user_id = $('#user_id2').val();

                                    var name = $("#name2").val();


                                    // var date_from= new Date(day+$("#from_date").val());
                                    var date_from = $("#from_date2").val();
                                    // var date_format_from = date_from.toLocaleString();
                                    var date_to = $("#to_date2").val();

                                    var repeated = $('#repeated2').prop('checked');
                                    // var date_to= new Date(day+$("#to_date").val());
                                    // var date_format_to = date_to.toLocaleString();


                                    // var from_date = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
                                    // var to_date = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');


                                    var Route = "{{route('update-stadium')}}";
                                    jQuery.ajax({
                                        url: Route,
                                        type: "POST",
                                        dataType: 'json',
                                        data: {
                                            id: event.id,
                                            stadium_id: stadium_id,
                                            hour_rate: hour_rate,
                                            user_id: user_id,
                                            name: name,
                                            from: date_from,
                                            to: date_to,
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
                                                calendar.fullCalendar('refetchEvents');
                                                $("#calendarModal").modal("hide");
                                            }

                                        }

                                    });


                                });

                            }
                        })
                    })

                    $('#deleteEvent').click(function () {
                        var from_who = $('input[name="type_who"]:checked').val();
                        var reason = $("#reason").val();
                        if (from_who != '' && reason != '') {

                            if (confirm("هل انت  متاكد من حذف هذا اليعاد")) {
                                var id = event.id;
                                var Route = "{{route('delete-stadium')}}";
                                $.ajax({
                                    url: Route,
                                    type: "POST",
                                    data: {
                                        id: id,
                                        from_who: from_who,
                                        reason: reason,
                                        type: "delete"
                                    },
                                    success: function (response) {
                                        calendar.fullCalendar('refetchEvents');
                                        $("#calendarModalDetails").modal("hide");

                                        // alert("تم حذف الميعاد من التقويم  ");
                                    }
                                })
                            }

                        } else {

                            alert('يرجي اختيار و ذكر سبب الالغاء الججز')
                            return false;
                        }

                    });

                }
            });

        });

        function checkfromType() {
                if ($('input[name="type"]:checked').val() == 'trainer') {
                $('.div_trainer').css('display', 'block');
                $('.div_name').css('display', 'none');
                $('#name').val('');
            }
            if ($('input[name="type"]:checked').val() == 'stranger') {
                $('.div_name').css('display', 'block');
                $('.div_trainer').css('display', 'none');
                $('#user_id').val('');
            }
        }

        $('.close').on('click', function () {
            $('.modal-body').find('.alert-danger').remove();
        })
    </script>


@endsection

