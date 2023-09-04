@extends('user.body.app')
@section('content')
@section('title')
    Contact Us | Online Easy News
@endsection
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="contact-wrpp">
                <h4 class="contactAddess-title text-center">
                    Contact Us </h4>
                <div role="form" class="wpcf7" id="wpcf7-f437-o1" lang="en-US" dir="ltr">
                    <div class="screen-reader-response">
                        <p role="status" aria-live="polite" aria-atomic="true"></p>
                        <ul></ul>
                    </div>
                    <form action="{{ route('contact-us-post') }}" method="post" class="wpcf7-form init"
                        enctype="multipart/form-data" novalidate="novalidate" data-status="init">
                        @csrf
                        <div style="display: none;">

                        </div>
                        <div class="main_section">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="contact-title ">
                                        Name
                                    </div>
                                    <div class="contact-form">
                                        <span class="wpcf7-form-control-wrap sub_title"><input type="text"
                                                name="name" value="" size="40" autocomplete="off"
                                                class="wpcf7-form-control wpcf7-text" aria-invalid="false"
                                                placeholder="Enter Name"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="contact-title">
                                        Email
                                    </div>
                                    <div class="contact-form">
                                        <span class="wpcf7-form-control-wrap news_title"><input type="email"
                                                name="email" value="" size="40"
                                                class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                aria-required="true" aria-invalid="false" placeholder="Enter Email"
                                                autocomplete="off"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="contact-title">
                                        Phone Number
                                    </div>
                                    <div class="contact-form">
                                        <span class="wpcf7-form-control-wrap news_title"><input type="text"
                                                name="phone" value="" size="40"
                                                class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required"
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Phone Number" autocomplete="off"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="contact-title">
                                        Comments
                                    </div>
                                    <div class="contact-form">
                                        <span class="wpcf7-form-control-wrap news_details">
                                            <textarea name="comments" cols="40" rows="10"
                                                class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" aria-required="true" aria-invalid="false"
                                                placeholder="Comments...."></textarea>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="contact-btn">
                                    <input type="submit" value="Submit"
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
@endsection
