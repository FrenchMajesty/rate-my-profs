<div class="sidebar-wrapper">
    <ul class="nav">
        <li {{ (\Request::route()->getName() == 'admin.index') ? 'class=active' : ''}}>
            <a href="{{route('admin.index')}}">
                <i class="material-icons">dashboard</i>
                <p>{{__('dashboard')}}</p>
            </a>
        </li>
        <li {{ (\Request::route()->getName() == 'admin.users') ? 'class=active' : ''}}>
            <a href="{{route('admin.users')}}">
                <i class="material-icons">person</i>
                <p>{{__('Users')}}</p>
            </a>
        </li>
        <li {{ (\Request::route()->getName() == 'admin.profs') ? 'class=active' : ''}}>
            <a href="{{route('admin.profs')}}">
                <i class="material-icons">face</i>
                <p>{{__('Profs')}}</p>
            </a>
        </li>
        <li {{ (\Request::route()->getName() == 'admin.schools') ? 'class=active' : ''}}>
            <a href="{{route('admin.schools')}}">
                <i class="material-icons">account_balance</i>
                <p>{{__('schools')}}</p>
            </a>
        </li>
        <!--li>
            <a href="./settings">
                <i class="material-icons">settings</i>
                <p>{{__('settings')}}</p>
            </a>
        </li-->
    </ul>
</div>