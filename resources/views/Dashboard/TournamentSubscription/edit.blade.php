@extends('Dashboard.includes.admin')

@section('content')


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">قسم  اشتراكات  المسابقات</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">اضافة اشتراك  مسابقه</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                @include('Dashboard.includes.alerts.errors')

                <div class="row justify-content-md-center">
                    <div class="col-lg-10">
                        <div class="card" style="zoom: 1;">
                            <div class="card-header">
                                <h4 class="card-title" id="bordered-layout-card-center">اضافة اشتراك مسابقه جديد</h4>
                                <a href="/sat/courses/create.php" class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form class="form" id="myForm" action="{{route('tournament-subscription.update',$tournament_edit->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="form-body">
                                            <div class="row">


                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2">      المسابقات  </label>
                                                        <select class=" form-control"  id="tournament_id" name="tournament_id" >
                                                            <option value=""> اختر مسابقه</option>
                                                            @foreach($tournaments as $tournament)
                                                                <option @if($tournament->id == $tournament_edit->id ) selected @endif value="{{$tournament->id}}">{{$tournament->name}}</option>

                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  الفروع</label>
                                                        <select class="select2-placeholder-multiple form-control" disabled multiple="multiple" id="branch_id" name="branch_id[]" >

                                                        </select>

                                                    </div>
                                                </div><div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  الاعبين</label>
                                                        <select class="select2-placeholder-multiple form-control" multiple="multiple" id="player_id" name="player_id[]" >

                                                        </select>

                                                    </div>
                                                </div>


                                            </div>

                                            <div class="form-actions center">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-primary w-100"><i class="la la-check-square-o"></i> حفظ</button>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="button"  class="btn btn-danger   w-100" onclick="resetForm();">مسح  </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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

        function resetForm() {

            document.getElementById("myForm").reset();

        }
        $(document).ready(function(){
            getTournamentInformation();

        });
        $("#tournament_id").click(function (){
            getTournamentInformation();
        });
        function getTournamentInformation(){
            var tournament_id = $("#tournament_id").val();
            var  route = "{{route('get-tournament-information')}}";

            $.ajax( route,{
                type: 'GET',  // http method
                data: { "tournament_id": tournament_id },
                success: function (data, status, xhr) {// success callback function
                    $("#branch_id").html(data.branches);
                    $("#player_id").html(data.players);

                }
            });
        }
        function getSelectedPlayers()
        {
            var tournament_id = $("#tournament_id").val();
            var  route = "{{route('get-tournament-selected-players')}}";

            $.ajax( route,{
                type: 'GET',  // http method
                data: { "tournament_id": tournament_id },
                success: function (data, status, xhr) {// success callback function
                    $("#branch_id").html(data.branches);
                    $("#player_id").html(data.players);

                }
            });
        }

    </script>
@endsection
