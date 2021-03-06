<nav class="navbar navbar-toggleable-md navbar-dark bg-primary fixed-top primary" style="overflow: visible;">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav1" aria-controls="navbarNav1" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ route('index') }}">
        <strong>{{env('APP_NAME')}}</strong>
    </a>
    <div class="navbar-collapse" style="overflow: visible;">
        <form action="{{route('pages.search')}}" class="form-inline col-md-4 mx-auto" style="position: unset;">
            <input class="form-control search-bar" type="text" name="search" placeholder="{{__('search')}}" autocomplete="off">
            <input type="hidden">
        </form>
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a href="{{route('index')}}" class="nav-link">{{__('home')}} <span class="sr-only">(current)</span></a>
            </li>
            @if (Auth::guest())
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">{{__('sign in')}}</a>
                </li>
            @else
                <li class="nav-item dropdown btn-group">
                    <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{__('account')}}</a>
                    <div class="dropdown-menu dropdown-menu-right dropdown" aria-labelledby="dropdownMenu1">
                        <a href="{{ route('profile') }}" class="dropdown-item primary-hover">{{__('my profile')}}</a>
                        <a href="{{ route('logout') }}" class="dropdown-item primary-hover" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                     {{__('log out')}}</a>
                        @if(Auth::user()->account_type == 'admin') 
                            <a href="{{route('admin.index')}}" class="dropdown-item primary-hover">{{__('control panel')}} ({{__('admin')}})</a>
                        @endif
                    </div>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            @endif
        </ul>
    </div>
</nav>