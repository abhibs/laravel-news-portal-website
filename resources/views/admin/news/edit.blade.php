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

                                <li class="breadcrumb-item active">Edit News </li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit News </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Form row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form id="myForm" method="post" action="{{ route('news-update') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="hidden" name="old_image" value="{{ $data->image }}">
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label">Category Name </label>
                                        <select name="category_id" class="form-select" id="example-select">
                                            <option>Select Category </option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $data->category_id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label"> Sub Category </label>
                                        <select name="subcategory_id" class="form-select" id="example-select">

                                            @if ($data->subcategory_id == null)
                                            @else
                                                <option>Select SubCategory </option>
                                                @foreach ($subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}"
                                                        {{ $subcategory->id == $data->subcategory_id ? 'selected' : '' }}>
                                                        {{ $subcategory->name }}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                    </div>


                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label">Writer </label>
                                        <select name="admin_id" class="form-select" id="example-select">
                                            <option>Select Writer </option>
                                            @foreach ($admins as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $user->id == $data->admin_id ? 'selected' : '' }}>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label">News Title </label>
                                        <input type="text" name="title" class="form-control" id="inputEmail4"
                                            value="{{ $data->title }}">
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="example-fileinput" class="form-label">News Photo</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>

                                    <div class="form-group col-md-6 mb-3">
                                        <label for="example-fileinput" class="form-label"> </label>
                                        <img id="showImage" src="{{ asset($data->image) }}"
                                            class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                    </div>



                                    <div class="col-12 mb-3">
                                        <label for="inputEmail4" class="form-label"> Details </label>
                                        <textarea class="ckeditor form-control" name="details">{!! $data->details !!}</textarea>
                                    </div>


                                    <div class="form-group col-md-6 mb-3">
                                        <label for="inputEmail4" class="form-label">Tags </label>
                                        <input type="text" name="tags" class="selectize-close-btn"
                                            value="{{ $data->tags }}">
                                    </div>



                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-check mb-2 form-check-primary">
                                                <input class="form-check-input" type="checkbox" name="breaking_news"
                                                    value="1" id="customckeck1"
                                                    {{ $data->breaking_news == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="customckeck1">Breaking News</label>
                                            </div>

                                            <div class="form-check mb-2 form-check-primary">
                                                <input class="form-check-input" type="checkbox" name="top_slider"
                                                    value="1" id="customckeck2"
                                                    {{ $data->top_slider == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="customckeck2">Top Slider</label>
                                            </div>

                                        </div>




                                        <div class="col-lg-6">
                                            <div class="form-check mb-2 form-check-danger">
                                                <input class="form-check-input" name="first_section_three" type="checkbox"
                                                    value="1" id="customckeck3"
                                                    {{ $data->first_section_three == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="customckeck3">First Section
                                                    Three</label>
                                            </div>

                                            <div class="form-check mb-2 form-check-danger">
                                                <input class="form-check-input" name="first_section_nine" type="checkbox"
                                                    value="1" id="customckeck4"
                                                    {{ $data->first_section_nine == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label" for="customckeck4">First Section
                                                    Nine</label>
                                            </div>

                                        </div>

                                    </div>




                                </div>



                                <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>

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
            $('select[name="category_id"]').on('change', function() {
                var category_id = $(this).val();
                // alert(category_id);
                if (category_id) {
                    $.ajax({
                        url: "{{ url('admin/subcategory/ajax') }}/" + category_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="subcategory_id"]').html('');
                            var d = $('select[name="subcategory_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '"> ' + value
                                    .name + '</option>');
                            });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
@endsection