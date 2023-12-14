<body id="page-top">
<!-- Page Wrapper -->

        <div id="wrapper">    

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
             
                <div class="sidebar-brand-text ">Blog Sitesi Admin </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item @if(Request::segment(2)==='panel') active @endif">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Panel</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                İçerik Yönetimi
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link  @if(Request::segment(2)==='articles') in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Makaleler</span>
                </a>
                <div id="collapseTwo" class="collapse @if(Request::segment(2)==='articles') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Makale İşlemleri :</h6>
                        <a class="collapse-item  @if(Request::segment(2)==='articles' and !Request::segment(3)) active  @endif" href="{{ route('admin.articles.index') }}">Tüm Makaleler</a>
                        <a class="collapse-item  @if(Request::segment(3)==='create') active  @endif" href="{{ route('admin.articles.create') }}">Makale Oluştur</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item @if(Request::segment(2)==='categories') active @endif">
                <a class="nav-link" href="{{ route('admin.category.index') }}"  >
                    <i class="fas fa-fw fa-list"></i>
                    <span>Kategoriler</span>
                </a>
               
            </li>
            <li class="nav-item">
                <a class="nav-link  @if(Request::segment(2)==='pages') in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapsePage"
                    aria-expanded="true" aria-controls="collapsePage">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Sayfalar</span>
                </a>
                <div id="collapsePage" class="collapse @if(Request::segment(2)==='pages') show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sayfa İşlemleri :</h6>
                        <a class="collapse-item  @if(Request::segment(2)==='pages' and !Request::segment(3)) active  @endif" href="{{ route('admin.pages.index') }}">Tüm Sayfalar</a>
                        <a class="collapse-item  @if(Request::segment(3)==='create') active  @endif" href="{{ route('admin.pages.create') }}">Sayfa Oluştur</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
               Site Ayarları
            </div>
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.config.index') }}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Ayarlar</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->
