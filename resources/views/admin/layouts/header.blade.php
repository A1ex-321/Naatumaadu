<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->


        <!-- Messages Dropdown Menu -->
        <li class="nav-item ">
            <a class="nav-link" href="{{ url('admin/logout') }}">
                <i class="fas fa-sign-out-alt"></i>

                Logout

            </a>

        </li>
        <!-- Notifications Dropdown Menu -->

        <li class="nav-item">
            <a class="nav-link " data-toggle="dropdown" href="#">
                <i class="fa fa-bell" aria-hidden="true"></i>
                Inbox
            </a>

        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ url('public/admin/assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Naatu Maadu</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <!-- <img src="{{ url('public/admin/assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
          alt="User Image"> -->
            </div>
            <!-- <div class="info">
        <a href="#" class="d-block">Naatu Maadu</a>
      </div> -->
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->



                <!-- <li class="nav-item">
          <a href="{{ url('admin/dashboard') }}" class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard

            </p>
          </a>

        </li> -->
                <li class="nav-item">
                    <a href="{{ url('/admin/admin/list') }}"
                        class="nav-link {{ request()->segment(2) === 'admin' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Users

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/category/list') }}"
                        class="nav-link {{ request()->segment(2) === 'catetory' ? 'active' : '' }}">
                        <i class="fa fa-tasks" aria-hidden="true"></i>

                        <p>
                            Category

                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('brand-list') }}"
                        class="nav-link {{ request()->segment(2) === 'brand' ? 'active' : '' }}">
                        <i class="fa fa-tasks" aria-hidden="true"></i>

                        <p>
                            Brand
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('products.index') }}"
                        class="nav-link {{ request()->segment(2) === 'products' ? 'active' : '' }}">
                        <i class="fa fa-tasks" aria-hidden="true"></i>

                        <p>
                            Product
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('list-orders') }}"
                        class="nav-link {{ request()->segment(2) === 'allOrders' ? 'active' : '' }}">
                        <i class="fa fa-tasks" aria-hidden="true"></i>

                        <p>
                            Orders
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('gallery.index') }}"
                        class="nav-link {{ request()->segment(2) === 'gallery' ? 'active' : '' }}">
                        <i class="fa fa-tasks" aria-hidden="true"></i>

                        <p>
                            Gallery
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('backgroundgallery.index') }}"
                        class="nav-link {{ request()->segment(2) === 'backgroundgallery' ? 'active' : '' }}">
                        <i class="fa fa-tasks" aria-hidden="true"></i>

                        <p>
                            Backgroung Image
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('herogallery.index') }}"
                        class="nav-link {{ request()->segment(2) === 'herogallery' ? 'active' : '' }}">
                        <i class="fa fa-tasks" aria-hidden="true"></i>

                        <p>
                            Hero Image
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('socialmedia.index') }}"
                        class="nav-link {{ request()->segment(2) === '' ? 'active' : '' }}">
                        <i class="fa fa-tasks" aria-hidden="true"></i>

                        <p>
                            social link
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('messages.index') }}"
                        class="nav-link {{ request()->segment(2) === 'messages' ? 'active' : '' }}">
                        <i class="fa fa-tasks" aria-hidden="true"></i>

                        <p>
                            Messages </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
