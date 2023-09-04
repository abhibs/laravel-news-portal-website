
<div class="col-md-4">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="contact-wrpp">


                <figure class="authorPage-image">
                    <img alt=""
                        src="{{ !empty($data->image) ? url('storage/user/' . $data->image) : url('no_image.jpg') }}"
                        class="avatar avatar-96 photo" height="96" width="96" loading="lazy">
                </figure>
                <h1 class="authorPage-name">
                    <a href=""> {{ $data->name }} </a>
                </h1>
                <h6 class="authorPage-name">
                    {{ $data->email }}
                </h6>



                <ul>
                    <li><a href="{{ route('user-dashboard') }}"><b>🟢 Your Profile </b></a> </li>
                    <li> <a href="{{ route('user-change-password') }}"> <b>🔵 Change Password </b> </a> </li>
                    <li> <a href="{{ route('user-logout') }}"> <b>🟠 Logout </b> </a> </li>
                </ul>

            </div>
        </div>
    </div>


</div>
