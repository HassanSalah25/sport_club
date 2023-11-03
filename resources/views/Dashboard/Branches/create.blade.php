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
                                <li class="breadcrumb-item"><a href="">لوحة التحكم</a></li>
                                <li class="breadcrumb-item active">اضافة فرع</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                @include('Dashboard.includes.alerts.errors')

                <div class="row justify-content-md-center align-items-end">
                    <div class="col-lg-10">
                        <div class="card" style="zoom: 1;">
                            <div class="card-header">
                                <h4 class="card-title" id="bordered-layout-card-center">اضافة فرع جديد</h4>
                                <a href="/sat/courses/create.php" class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">
                                    <form class="form" id="myForm" action="{{route('branch.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  اسم الفرع </label>
                                                        <input type="text" class="form-control" name="name" value="{{old('name')}}"  required>

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2"> الرقم الارضي</label>
                                                        <input type="number" class="form-control" name="landline"  value="{{old('landline')}}"  required>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">المدينه</label>
                                                        <input type="text" class="form-control" name="city" value="{{old('city')}}"   required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">  الهاتف</label>
                                                        <input type="number" class="form-control" name="phone"  value="{{old('phone')}}"  required>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">العنوان</label>
                                                        <input type="text" class="form-control" name="address" value="{{old('address')}}"   >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">

                                                        <label for="projectinput2">لوكشان</label>
                                                        <input type="text" class="form-control mb-2" name="location"  value="{{old('location')}}" id="map-link" >
                                                        <div id="map"></div>

                                                        <!-- Input field to display the map link -->
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
    </script>

    <script>
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 0, lng: 0 }, // Default center position
                zoom: 10 // Default zoom level
            });

            map.addListener('click', function(event) {
                var lat = event.latLng.lat();
                var lng = event.latLng.lng();
                var mapLink = "https://www.google.com/maps?q=" + lat + "," + lng;

                // Update the input field with the map link
                document.getElementById('map-link').value = mapLink;
            });
        }

        // Call the initMap function to initialize the map
        initMap();
    </script>
@endsection
