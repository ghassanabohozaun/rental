<nav class="sidebar sidebar-offcanvas pt-3" id="sidebar">
    <ul class="nav">


        <li class="nav-item">
            <a class="nav-link @if (Request::routeIs('employees.overview')) active @endif" href="{!! route('employees.overview') !!}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">{!! __('dashboard.dashboard') !!}</span>
            </a>
        </li>
        {{--
        <li class="nav-item">
            <a class="nav-link" href="{{ route('employees.dailyReports.index') }}">
                <i class="menu-icon fa fa-bookmark"></i>
                <span class="menu-title">{!! __('dashboard.daily_reports') !!}</span>
            </a>
        </li> --}}

        <li class="nav-item">
            <a class="nav-link" href="{{ route('employees.monthlyReports.index') }}">
                <i class="menu-icon fa fa-pencil"></i>
                <span class="menu-title">{!! __('dashboard.monthly_reports') !!}</span>
            </a>

        </li>

        <li class="nav-item">
            <a class="nav-link @if (Request::routeIs('employees.messages.*')) active @endif" href="{!! route('employees.messages.index') !!}">
                <i class="mdi mdi-email-outline menu-icon"></i>
                <span class="menu-title">{!! __('dashboard.messages') !!}</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link @if (Request::routeIs('employees.tasks.*')) active @endif" href="{!! route('employees.tasks.index') !!}">
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                <span class="menu-title">{!! __('dashboard.tasks') !!}</span>
            </a>
        </li>



        {{-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-account-circle-outline"></i>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank
                            Page </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404
                        </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500
                        </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html">
                            Register </a></li>
                </ul>
            </div>
        </li> --}}


    </ul>
</nav>
