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
                            @if (Auth::user()->can('subcategory.add'))
                                <ol class="breadcrumb m-0">
                                    <a href="{{ route('subcategory-create') }}"
                                        class="btn btn-blue waves-effect waves-light">Add
                                        SubCategory</a>
                                </ol>
                            @endif
                        </div>
                        <h4 class="page-title">SubCategory All </h4>
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
                                        <th> Category Name </th>
                                        <th>SubCategory Name </th>
                                        <th>Action </th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($subcategories as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @if (Auth::user()->can('subcategory.edit'))
                                                    <a href="{{ route('subcategory-edit', $item->id) }}"
                                                        class="btn btn-primary rounded-pill waves-effect waves-light">Edit</a>
                                                @endif
                                                @if (Auth::user()->can('subcategory.delete'))
                                                    <a href="{{ route('subcategory-delete', $item->id) }}"
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
