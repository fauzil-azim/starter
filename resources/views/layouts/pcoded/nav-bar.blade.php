<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu active pcoded-trigger">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="active">
                        <a href="{{ route('dashboard.user.index') }}">
                            <span class="pcoded-mtext">User</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                    <span class="pcoded-mtext">Widget</span>
                    <span class="pcoded-badge label label-danger">100+</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="widget-chart.htm">
                            <span class="pcoded-mtext">Chart Widget</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>