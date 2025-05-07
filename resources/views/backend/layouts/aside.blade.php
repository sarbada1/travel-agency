@section('aside')
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="{{ route('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
              

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-rp" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-lock-fill"></i><span>Role & Permission</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-rp" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        @can('roles_list')
                            <li>
                                <a href="{{ route('roles.index') }}">
                                    <i class="bi bi-circle"></i><span>Manage Roles</span>
                                </a>
                            </li>
                        @endcan
                        @can('permissions_list')
                            <li>
                                <a href="{{ route('manage-permission') }}">
                                    <i class="bi bi-circle"></i><span>Manage Permissions</span>
                                </a>
                            </li>
                        @endcan


                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-account" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-people-fill"></i><span>Admin</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-account" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('manage-account-type') }}">
                                <i class="bi bi-circle"></i><span> Account Types</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('admin.index') }}">
                                <i class="bi bi-circle"></i><span> Admin</span>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-attribute" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-tags-fill"></i><span>Attribute</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-attribute" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('manage-attribute-group.index') }}">
                                <i class="bi bi-circle"></i><span>Manage Attribute Groups</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage-attribute-group.create') }}">
                                <i class="bi bi-circle"></i><span>Add Attribute Groups</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage-package-attribute.index') }}">
                                <i class="bi bi-circle"></i><span>Manage Package Attribute</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage-package-attribute.create') }}">
                                <i class="bi bi-circle"></i><span>Add Package Attribute</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-category" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-folder2-open"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-category" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('manage-category.index') }}">
                                <i class="bi bi-circle"></i><span>Manage Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage-category.create') }}">
                                <i class="bi bi-circle"></i><span>Add Category</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-tour" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-folder2-open"></i><span>Tour Package</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-tour" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('manage-tour-package.index') }}">
                                <i class="bi bi-circle"></i><span>Manage Tour package</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage-tour-package.create') }}">
                                <i class="bi bi-circle"></i><span>Add Tour Package</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-banner" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-folder2-open"></i><span>Banner</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-banner" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('banner.index') }}">
                                <i class="bi bi-circle"></i><span>Manage Banner</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('banner.create') }}">
                                <i class="bi bi-circle"></i><span>Add Banner</span>
                            </a>
                        </li>

                    </ul>
                </li>
            


        
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-pages" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-folder-fill"></i><span>Pages</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-pages" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('manage-page.index') }}">
                                <i class="bi bi-circle"></i><span> Manage Page</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage-testimonial.index') }}">
                                <i class="bi bi-circle"></i><span> Testimonial</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('manage-faqs.index') }}">
                                <i class="bi bi-circle"></i><span> Faqs</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('manage-member-type') }}">
                                <i class="bi bi-circle"></i><span> Member Types</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage-team.index') }}">
                                <i class="bi bi-circle"></i><span> Our Teams</span>
                            </a>
                        </li>


                    </ul>
                </li>


                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-posts" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-newspaper"></i><span>Blog</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-posts" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('manage-blog-category.index') }}">
                                <i class="bi bi-circle"></i><span>Manage Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage-blog.create') }}">
                                <i class="bi bi-circle"></i><span>Add Blog</span>
                            </a>
                            <a href="{{ route('manage-blog.index') }}">
                                <i class="bi bi-circle"></i><span>Show Blogs</span>
                            </a>
                        </li>

                    </ul>
                </li>
           


                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-setting" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-gear"></i><span>Setting</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-setting" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('setting') }}">
                                <i class="bi bi-circle"></i><span>General</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage-social-media.index') }}">
                                <i class="bi bi-circle"></i><span>Social Media</span>
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="{{ route('contact-list') }}">
                        <i class="bi bi-envelope"></i>
                        <span>Contact List</span>
                    </a>
                </li>
            
        </ul>

    </aside><!-- End Sidebar-->
@endsection
