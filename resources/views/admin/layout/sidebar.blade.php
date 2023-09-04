        <div class="left-side-menu">

            <div class="h-100" data-simplebar>

                @php
                    $id = Auth::user()->id;
                    $admin = App\Models\Admin::find($id);

                    $status = $admin->status;

                @endphp

                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    <ul id="side-menu">
                        <li>
                            <a href="{{ route('admin-dashboard') }}">
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>
                        @if ($status == 1)
                            @if (Auth::user()->can('category.menu'))
                                <li>
                                    <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                                        <i class="mdi mdi-cart-outline"></i>
                                        <span> Category </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarEcommerce">
                                        <ul class="nav-second-level">
                                            @if (Auth::user()->can('category.list'))
                                                <li>
                                                    <a href="{{ route('category') }}">All Categories</a>
                                                </li>
                                            @endif
                                            @if (Auth::user()->can('category.add'))
                                                <li>
                                                    <a href="{{ route('category-create') }}">Add Category</a>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>
                                </li>
                            @endif
                            @if (Auth::user()->can('subcategory.menu'))
                                <li>
                                    <a href="#sidebarCrm" data-bs-toggle="collapse">
                                        <i class="mdi mdi-account-multiple-outline"></i>
                                        <span> Sub Category </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarCrm">
                                        <ul class="nav-second-level">
                                            @if (Auth::user()->can('subcategory.list'))
                                                <li>
                                                    <a href="{{ route('subcategory') }}">All Sub Categories</a>
                                                </li>
                                            @endif
                                            @if (Auth::user()->can('subcategory.add'))
                                                <li>
                                                    <a href="{{ route('subcategory-create') }}">Add Sub Category</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                            @endif
                            @if (Auth::user()->can('news.menu'))
                                <li>
                                    <a href="#sidebarTasks" data-bs-toggle="collapse">
                                        <i class="mdi mdi-clipboard-multiple-outline"></i>
                                        <span> News </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarTasks">
                                        <ul class="nav-second-level">
                                            @if (Auth::user()->can('news.list'))
                                                <li>
                                                    <a href="{{ route('news') }}">All News</a>
                                                </li>
                                            @endif

                                            @if (Auth::user()->can('news.add'))
                                                <li>
                                                    <a href="{{ route('news-create') }}">Add News</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                            @endif

                            @if (Auth::user()->can('banner.menu'))
                                <li>
                                    <a href="#sidebarContacts" data-bs-toggle="collapse">
                                        <i class="mdi mdi-book-account-outline"></i>
                                        <span> Banner </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarContacts">
                                        <ul class="nav-second-level">
                                            <li>
                                                <a href="{{ route('banner') }}">All Banner</a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>
                            @endif

                            @if (Auth::user()->can('photo.menu'))

                                <li>
                                    <a href="#sidebarTickets" data-bs-toggle="collapse">
                                        <i class="mdi mdi-lifebuoy"></i>
                                        <span> Photo Gallery </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarTickets">
                                        <ul class="nav-second-level">
                                            @if (Auth::user()->can('photo.list'))
                                                <li>
                                                    <a href="{{ route('photo') }}">All Photo Gallery</a>
                                                </li>
                                            @endif
                                            @if (Auth::user()->can('photo.add'))
                                                <li>
                                                    <a href="{{ route('photo-create') }}">Add Photo Gallery</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                            @endif
                            @if (Auth::user()->can('video.menu'))

                                <li>
                                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                                        <i class="mdi mdi-account-circle-outline"></i>
                                        <span> Video Gallery </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarAuth">
                                        <ul class="nav-second-level">
                                            @if (Auth::user()->can('video.list'))
                                                <li>
                                                    <a href="{{ route('video') }}">All Video Galleries</a>
                                                </li>
                                            @endif
                                            @if (Auth::user()->can('video.add'))
                                                <li>
                                                    <a href="{{ route('video-create') }}">Add Video Gallery</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                            @endif

                            @if (Auth::user()->can('live.menu'))
                                <li>
                                    <a href="#sidebarExpages" data-bs-toggle="collapse">
                                        <i class="mdi mdi-text-box-multiple-outline"></i>
                                        <span> Live TV </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarExpages">
                                        <ul class="nav-second-level">
                                            <li>
                                                <a href="{{ route('live-tv') }}">Update Live TV</a>
                                            </li>


                                        </ul>
                                    </div>
                                </li>
                            @endif
                            @if (Auth::user()->can('seo.menu'))
                                <li>
                                    <a href="#sidebarBaseui" data-bs-toggle="collapse">
                                        <i class="mdi mdi-black-mesa"></i>
                                        <span> Seo </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarBaseui">
                                        <ul class="nav-second-level">
                                            <li>
                                                <a href="{{ route('seo') }}">Update Seo</a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>
                            @endif


                            @if (Auth::user()->can('review.menu'))

                                <li>
                                    <a href="#sidebarExtendedui" data-bs-toggle="collapse">
                                        <i class="mdi mdi-layers-outline"></i>
                                        <span>Reviews</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarExtendedui">
                                        <ul class="nav-second-level">
                                            @if (Auth::user()->can('pending.review.list'))
                                                <li>
                                                    <a href="{{ route('pending-reviews') }}">Pending Reviews</a>
                                                </li>
                                            @endif
                                            @if (Auth::user()->can('approve.review.list'))
                                                <li>
                                                    <a href="{{ route('approved-reviews') }}">Approved Reviews</a>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>
                                </li>
                            @endif
                            @if (Auth::user()->can('user.menu'))

                                <li>
                                    <a href="#sidebarIcons" data-bs-toggle="collapse">
                                        <i class="mdi mdi-bullseye"></i>
                                        <span> Users List </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarIcons">
                                        <ul class="nav-second-level">
                                            @if (Auth::user()->can('user.list'))
                                                <li>
                                                    <a href="{{ route('user-list') }}">All User</a>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>
                                </li>
                            @endif


                            @if (Auth::user()->can('contact.menu'))

                                <li>
                                    <a href="#sidebarForms" data-bs-toggle="collapse">
                                        <i class="mdi mdi-bookmark-multiple-outline"></i>
                                        <span> Contact Us List </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarForms">
                                        <ul class="nav-second-level">
                                            @if (Auth::user()->can('contact.list'))
                                                <li>
                                                    <a href="{{ route('contact-list') }}">All Contact</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </li>
                            @endif

                            @if (Auth::user()->can('admin.menu'))
                                <li>
                                    <a href="#sidebarEmail" data-bs-toggle="collapse">
                                        <i class="mdi mdi-email-multiple-outline"></i>
                                        <span> Admin </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarEmail">
                                        <ul class="nav-second-level">
                                            <li>
                                                <a href="{{ route('admin-all-list') }}">All Admins</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('admin-create') }}">Add Admin</a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>
                            @endif
                            @if (Auth::user()->can('role.menu'))
                                <li>
                                    <a href="#sidebarProjects" data-bs-toggle="collapse">
                                        <i class="mdi mdi-briefcase-check-outline"></i>
                                        <span> Roles and Permission </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarProjects">
                                        <ul class="nav-second-level">
                                            <li>
                                                <a href="{{ route('all-permission') }}">All Permissions</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('add-permission') }}">Add Permission</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('all-roles') }}">All Roles</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('add-roles') }}">Add Role</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('all-roles-permission') }}">All Roles in
                                                    Permission</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('add-roles-permission') }}">Add Roles in
                                                    Permission</a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>
                            @endif
                        @else
                        @endif

                    </ul>

                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
