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
                            @if (Auth::user()->can('photo.add'))
                                <ol class="breadcrumb m-0">

                                    <a href="{{ route('photo-create') }}" class="btn btn-blue waves-effect waves-light">Add
                                        Photo</a>
                                </ol>
                            @endif
                        </div>
                        <h4 class="page-title">Photo Gallery All </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">


                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Image </th>
                                        <th>Date</th>
                                        <th>Action </th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($datas as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ asset($item->photo_gallery) }}"
                                                    style="width:50px; height:50px;"> </td>
                                            <td>{{ $item->post_date }}</td>
                                            <td>
                                                @if (Auth::user()->can('photo.edit'))
                                                    <a href="{{ route('photo-edit', $item->id) }}"
                                                        class="btn btn-primary rounded-pill waves-effect waves-light">Edit</a>
                                                @endif
                                                @if (Auth::user()->can('photo.delete'))
                                                    <a href="{{ route('photo-delete', $item->id) }}"
                                                        class="btn btn-danger rounded-pill waves-effect waves-light"
                                                        id="delete">Delete</a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->



        </div> <!-- container -->

    </div> <!-- content -->
@endsection