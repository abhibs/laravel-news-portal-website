@extends('user.body.app')
@section('content')
@section('title')
    User Change Password | Online Easy News
@endsection
<div class="container">


    <div class="row">
        @include('user.body.sidebar')

        <div class="col-md-8">


            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="contact-wrpp">
                        <h4 class="contactAddess-title text-center">
                            Change Password </h4>
                        <div role="form" class="wpcf7" id="wpcf7-f437-o1" lang="en-US" dir="ltr">
                            <div class="screen-reader-response">
                                <p role="status" aria-live="polite" aria-atomic="true"></p>
                                <ul></ul>
                            </div>
                            <form action="{{ route('user-change-password-update') }}" method="POST">
                                @csrf
                                <div style="display: none;">

                                </div>

                                <div class="main_section">
                                    <div class="row">
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @elseif(session('error'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ session('error') }}
                                            </div>
                                        @endif

                                        <div class="col-md-12 col-sm-12">
                                            <div class="contact-title ">
                                                Old Password *
                                            </div>
                                            <div class="contact-form">
                                                <span class="wpcf7-form-control-wrap sub_title"><input type="password"
                                                        name="old_password" value="" size="40"
                                                        class="form-control @error('old_password') is-invalid @enderror"
                                                        aria-invalid="false"></span>
                                                @error('old_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="col-md-12 col-sm-12">
                                            <div class="contact-title ">
                                                New Password *
                                            </div>
                                            <div class="contact-form">
                                                <span class="wpcf7-form-control-wrap sub_title"><input type="password"
                                                        name="new_password" value="" size="40"
                                                        class="form-control @error('new_password') is-invalid @enderror"
                                                        aria-invalid="false"></span>
                                                @error('new_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-sm-12">
                                            <div class="contact-title ">
                                                Confirm Password *
                                            </div>
                                            <div class="contact-form">
                                                <span class="wpcf7-form-control-wrap sub_title">
                                                    <input type="password" name="new_password_confirmation"
                                                        value="" size="40" class="form-control "
                                                        aria-invalid="false"></span>
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
                                {{-- <div class="wpcf7-response-output" aria-hidden="true"></div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>




        </div>

    </div> <!--  // end row -->




</div>
@endsection
