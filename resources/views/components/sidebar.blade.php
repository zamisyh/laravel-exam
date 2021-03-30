<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item">
                    <a href="{{ route('dashboard.home') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>


                @role('admin')
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-person-lines-fill"></i>
                            <span>Manajamen User</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="{{ route('dashboard.role') }}">Role</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{ route('dashboard.permission') }}">Permission</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{ route('dashboard.users') }}">Users</a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-file-bar-graph"></i>
                            <span>Data</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="{{ route('dashboard.majors') }}">Majors</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{ route('dashboard.class') }}">Class</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{ route('dashboard.mapel') }}">Mapel</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{ route('dashboard.teacher') }}">Teacher</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="{{ route('dashboard.student') }}">Student</a>
                            </li>
                        </ul>
                    </li>
                @endrole
                
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>