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

                                <li class="breadcrumb-item active">Admin Profile</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Admin Profile</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-4 col-xl-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="{{ !empty($admin->image) ? url('storage/admin/' . $admin->image) : url('no_image.jpg') }}"
                                class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                            <h4 class="mb-0">{{ @$admin->name }}</h4>
                            {{-- <p class="text-muted">@ {{ @$admin->name }}</p> --}}

                            {{-- <button type="button"
                                class="btn btn-success btn-xs waves-effect mb-2 waves-light">Follow</button>
                            <button type="button"
                                class="btn btn-danger btn-xs waves-effect mb-2 waves-light">Message</button> --}}

                            <div class="text-start mt-3">


                                <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span
                                        class="ms-2">{{ $admin->name }}</span></p>

                                <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span
                                        class="ms-2">{{ $admin->phone }}</span></p>

                                <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span
                                        class="ms-2">{{ $admin->email }}</span></p>


                            </div>


                        </div>
                    </div> <!-- end card -->



                </div> <!-- end col-->

                <div class="col-lg-8 col-xl-8">
                    <div class="card">
                        <div class="card-body">




                            <div class="tab-pane" id="settings">
                                <form method="post" action="{{ route('admin-profile-update') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>Admin
                                        Personal Info</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label"> Name</label>
                                                <input type="text" name="name" class="form-control" id="firstname"
                                                    autocomplete="off" value="{{ $admin->name }}">
                                            </div>
                                        </div>
                                        <!-- end col -->


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label"> Email </label>
                                                <input type="email" name="email" class="form-control" id="lastname"
                                                    autocomplete="off" value="{{ $admin->email }}">
                                            </div>
                                        </div> <!-- end col -->


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label"> Phone </label>
                                                <input type="text" name="phone" class="form-control" id="lastname"
                                                    autocomplete="off" value="{{ $admin->phone }}">
                                            </div>
                                        </div> <!-- end col -->


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label"> Address </label>
                                                <input type="text" name="address" class="form-control" id="lastname"
                                                    value="{{ $admin->address }}" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label">Admin Photo</label>
                                                <input type="file" name="image" id="image" class="form-control">
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label"> </label>
                                                <img id="showImage"
                                                    src="{{ !empty($admin->image) ? url('storage/admin/' . $admin->image) : url('no_image.jpg') }}"
                                                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label"> Facebook </label>
                                                <input type="text" name="facebook" class="form-control" id="lastname"
                                                    autocomplete="off" value="{{ $admin->facebook }}">
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label"> Twitter </label>
                                                <input type="text" name="twitter" class="form-control" id="lastname"
                                                    value="{{ $admin->twitter }}" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label"> Youtube </label>
                                                <input type="text" name="youtube" class="form-control" id="lastname"
                                                    autocomplete="off" value="{{ $admin->youtube }}">
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label"> LinkedIn </label>
                                                <input type="text" name="linkedin" class="form-control"
                                                    id="lastname" value="{{ $admin->linkedin }}" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="lastname" class="form-label"> Instagram </label>
                                                <input type="text" name="instagram" class="form-control"
                                                    id="lastname" autocomplete="off" value="{{ $admin->instagram }}">
                                            </div>
                                        </div> <!-- end col -->














                                    </div> <!-- end row -->


                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end settings content-->

                        </div> <!-- end tab-content -->
                    </div>
                </div> <!-- end card-->

            </div> <!-- end col -->
        </div>
        <!-- end row-->

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
@endsection
