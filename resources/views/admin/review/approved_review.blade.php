@extends('admin.layout.app')
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Approved Review <span class="btn btn-danger"> {{ count($review) }} </span>
                        </h4>
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
                                        <th>News Image</th>
                                        <th>News Title</th>
                                        <th>User Image</th>
                                        <th>User Name</th>
                                        <th>Comment </th>
                                        <th>Status </th>
                                        <th>Action </th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($review as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ asset($item->news->image) }} "
                                                    style="width: :50px; height:50px;"></td>
                                            <td>{{ $item->news->title }}</td>
                                            <td><img src="{{ !empty($item->user->image) ? url('storage/user/' . $item->user->image) : url('no_image.jpg') }}"
                                                    style="width: :50px; height:50px;"></td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ Str::limit($item->comments, 25) }}</td>
                                            <td>
                                                @if ($item->status == 0)
                                                    <span class="badge badge-pill bg-danger">Pending</span>
                                                @else
                                                    <span class="badge badge-pill bg-success">Publish</span>
                                                @endif


                                            </td>
                                            <td>
                                                @if (Auth::user()->can('approve.review.delete'))
                                                    <a href="{{ route('delete-review', $item->id) }}"
                                                        class="btn btn-primary rounded-pill waves-effect waves-light"
                                                        id="delete">Delete </a>
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
