<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">{{ ucfirst(auth()->user()->username) }}</span>
                        <span class="text-muted text-xs block">{{ ucfirst(auth()->user()->position) }}</b></span>
                    </a>
                </div>
                <div class="logo-element">
                    LBG
                </div>
            </li>
            <li class="{{ request()->is('home') ? 'active' : '' }}">
                <a href="home"><i class="fa fa-dashboard"></i> <span class="nav-label">Beranda</span></a>
            </li>
            <li class="{{ request()->is('keyword-view') ? 'active' : '' }}">
                <a href="keyword-view"><i class="fa fa-file-text-o"></i> <span class="nav-label">Peribahasa</span></a>
            </li>
        </ul>
    </div>
</nav>