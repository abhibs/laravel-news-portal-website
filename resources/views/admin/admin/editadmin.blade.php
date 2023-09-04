@extends('admin.layout.app')
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item active">Edit Admin</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Admin</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Form row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form id="myForm" method="post" action="{{ route('admin-update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">

                                <div class="row">


                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label"> Name </label>
                                        <input type="text" name="name" class="form-control" id="inputEmail4"
                                            value="{{ $data->name }}">
                                    </div>


                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label">Email </label>
                                        <input type="email" name="email" class="form-control" id="inputEmail4"
                                            value="{{ $data->email }}">
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label">Phone </label>
                                        <input type="text" name="phone" class="form-control" id="inputEmail4"
                                            value="{{ $data->phone }}">
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label"> Address </label>
                                        <input type="text" name="address" class="form-control" id="inputEmail4"
                                            value="{{ $data->address }}">
                                    </div>




                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label">Asign Roles </label>
                                        <select name="roles" class="form-select" id="example-select">
                                            <option> Select One Roles </option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ $data->hasRole($role->name) ? 'selected' : '' }}>
                                                    {{ $role->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>


                                </div>



                                <button type="submit" class="btn btn-primary waves-effect waves-light">Add</button>

                            </form>

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->



        </div> <!-- container -->

    </div> <!-- content -->
@endsection
