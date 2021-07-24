<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link @if (Request::segment(2)=='dashboard') active @endif" href="{{ url('backend/dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link @if (Request::segment(2)=='catagory') active @endif" href="{{ url('backend/catagory') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-object-ungroup"></i></div>
                    Catagory
                </a>                
                <a class="nav-link @if (Request::segment(2)=='products') active @endif" href="{{ url('backend/products') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                    Products
                </a>
                <!--
                <a class="nav-link @if (Request::segment(2)=='grouped') active @endif" href="{{ url('backend/grouped') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Grouped
                </a>
                -->
                <a class="nav-link @if (Request::segment(2)=='order') active @endif" href="{{ url('backend/order') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                    Order
                </a>
                <a class="nav-link @if (Request::segment(2)=='member') active @endif" href="{{ url('backend/member') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                    Member
                </a>
                <a class="nav-link @if (Request::segment(2)=='maillist') active @endif" href="{{ url('backend/maillist') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-envelope-open-text"></i></div>
                    Maillist
                </a>
                <a class="nav-link @if (Request::segment(2)=='promotion') active @endif" href="{{ url('backend/promotion') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-ad"></i></div>
                    Promotion
                </a>
                @if (session('loggedUserInfo')['usertype']=='admin')
                <a class="nav-link @if (Request::segment(2)=='user') active @endif" href="{{ url('backend/user') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                    Users
                </a>
                @endif
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <span style="text-transform: capitalize">{{ session('loggedUserInfo')['usertype'] }}</span>
        </div>
    </nav>
</div>