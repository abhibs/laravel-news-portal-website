@extends('user.body.app')
@section('content')
@section('title')
    User Dashboard | Online Easy News
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="container">


    <div class="row">
        @include('user.body.sidebar')

        <div class="col-md-8">


            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="contact-wrpp">
                        <h4 class="contactAddess-title text-center">
                            User Account </h4>
                        <div role="form" class="wpcf7" id="wpcf7-f437-o1" lang="en-US" dir="ltr">
                            <div class="screen-reader-response">
                                <p role="status" aria-live="polite" aria-atomic="true"></p>
                                <ul></ul>
                            </div>
                            <form method="POST" action="{{ route('user-profile-update') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div style="display: none;">

                                </div>

                                <div class="main_section">
                                    <div class="row">


                                        <div class="col-md-12 col-sm-12">
                                            <div class="contact-title ">
                                                User Name *
                                            </div>
                                            <div class="contact-form">
                                                <span class="wpcf7-form-control-wrap sub_title"><input type="text"
                                                        name="name" value="{{ $data->name }}" size="40"
                                                        class="wpcf7-form-control wpcf7-text" aria-invalid="false"
                                                        placeholder="Name"></span>
                                            </div>
                                        </div>



                                        <div class="col-md-12 col-sm-12">
                                            <div class="contact-title ">
                                                Email *
                                            </div>
                                            <div class="contact-form">
                                                <span class="wpcf7-form-control-wrap sub_title"><input type="email"
                                                        name="email" value="{{ $data->email }}" size="40"
                                                        class="wpcf7-form-control wpcf7-text" aria-invalid="false"
                                                        placeholder="Email"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-sm-12">
                                            <div class="contact-title ">
                                                Phone *
                                            </div>
                                            <div class="contact-form">
                                                <span class="wpcf7-form-control-wrap sub_title"><input type="text"
                                                        name="phone" value="{{ $data->phone }}" size="40"
                                                        class="wpcf7-form-control wpcf7-text" aria-invalid="false"
                                                        placeholder="Phone"></span>
                                            </div>
                                        </div>


                                        <div class="col-md-12 col-sm-12">
                                            <div class="contact-title ">
                                                Photo *
                                            </div>
                                            <div class="contact-form">
                                                <span class="wpcf7-form-control-wrap sub_title"><input type="file"
                                                        name="image" size="40"
                                                        class="wpcf7-form-control wpcf7-text"
                                                        aria-invalid="false"></span>
                                            </div>
                                            <div class="contact-form">
                                                <span class="wpcf7-form-control-wrap sub_title">
                                                    <img id="showImage"
                                                        src="{{ !empty($data->image) ? url('storage/user/' . $data->image) : url('no_image.jpg') }} "
                                                        class="rounded-circle avatar-lg img-thumbnail"
                                                        alt="profile-image" style="width:100px; height:100px;"></span>
                                            </div>
                                        </div>
                                    </div>



                                </div>




                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="contact-btn">
                                            <input type="submit" value="Save Changes"
                                                class="wpcf7-form-control has-spinner wpcf7-submit"><span
                                                class="wpcf7-spinner"></span>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="wpcf7-response-output" aria-hidden="true"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




    </div>

</div> <!--  // end row -->




</div>
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
@endsection
