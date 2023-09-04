@extends('admin.layout.app')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item active">Update Banner </li>
                            </ol>
                        </div>
                        <h4 class="page-title">Update Banner</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Form row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form id="myForm" method="post" action="{{ route('banner-update') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="hidden" name="old_image1" value="{{ $data->home_one }}">
                                <input type="hidden" name="old_image2" value="{{ $data->home_two }}">
                                <input type="hidden" name="old_image3" value="{{ $data->home_three }}">
                                <input type="hidden" name="old_image4" value="{{ $data->home_four }}">
                                <input type="hidden" name="old_image5" value="{{ $data->news_category_one }}">
                                <input type="hidden" name="old_image6" value="{{ $data->news_details_one }}">



                                <div class="row">


                                    <div class="form-group col-md-6 mb-3">
                                        <label for="example-fileinput" class="form-label">Home Banner One</label>
                                        <input type="file" name="home_one" id="image" class="form-control">
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="example-fileinput" class="form-label"> </label>
                                        <img id="showImage"
                                            src="{{ !empty($data->home_one) ? url($data->home_one) : url('no_image.jpg') }} "
                                            class=" " alt="profile-image" style="width:400px; height:60px;">
                                    </div>



                                    <div class="form-group col-md-6 mb-3">
                                        <label for="example-fileinput" class="form-label">Home Banner Two</label>
                                        <input type="file" name="home_two" id="image2" class="form-control">
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="example-fileinput" class="form-label"> </label>
                                        <img id="showImage2"
                                            src="{{ !empty($data->home_two) ? url($data->home_two) : url('no_image.jpg') }} "
                                            class=" " alt="profile-image" style="width:400px; height:60px;">
                                    </div>



                                    <div class="form-group col-md-6 mb-3">
                                        <label for="example-fileinput" class="form-label">Home Banner Three</label>
                                        <input type="file" name="home_three" id="image3" class="form-control">
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="example-fileinput" class="form-label"> </label>
                                        <img id="showImage3"
                                            src="{{ !empty($data->home_three) ? url($data->home_three) : url('no_image.jpg') }} "
                                            class=" " alt="profile-image" style="width:400px; height:60px;">
                                    </div>




                                    <div class="form-group col-md-6 mb-3">
                                        <label for="example-fileinput" class="form-label">Home Banner Four</label>
                                        <input type="file" name="home_four" id="image4" class="form-control">
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="example-fileinput" class="form-label"> </label>
                                        <img id="showImage4"
                                            src="{{ !empty($data->home_four) ? url($data->home_four) : url('no_image.jpg') }} "
                                            class=" " alt="profile-image" style="width:400px; height:60px;">
                                    </div>


                                    <div class="form-group col-md-6 mb-3">
                                        <label for="example-fileinput" class="form-label">News Category Banner</label>
                                        <input type="file" name="news_category_one" id="image5"
                                            class="form-control">
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="example-fileinput" class="form-label"> </label>
                                        <img id="showImage5"
                                            src="{{ !empty($data->news_category_one) ? url($data->news_category_one) : url('no_image.jpg') }} "
                                            class=" " alt="profile-image" style="width:400px; height:60px;">
                                    </div>


                                    <div class="form-group col-md-6 mb-3">
                                        <label for="example-fileinput" class="form-label">News Details Banner</label>
                                        <input type="file" name="news_details_one" id="image6"
                                            class="form-control">
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="example-fileinput" class="form-label"> </label>
                                        <img id="showImage6"
                                            src="{{ !empty($data->news_details_one) ? url($data->news_details_one) : url('no_image.jpg') }} "
                                            class=" " alt="profile-image" style="width:400px; height:60px;">
                                    </div>


                                </div>


                                @if (Auth::user()->can('banner.update'))
                                    <button type="submit"
                                        class="btn btn-primary waves-effect waves-light">Update</button>
                                @endif
                            </form>

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->



        </div> <!-- container -->

    </div> <!-- content -->


    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image2').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage2').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image3').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage3').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image4').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage4').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image5').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage5').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#image6').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage6').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
