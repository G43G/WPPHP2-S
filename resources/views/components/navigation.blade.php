<nav id="nav">
    <ul>
    @if(session()->has('user'))
        @if(session()->get('user')[0]->role_name == 'administrator')
            @isset($navigations)
                @foreach($navigations as $navigation)
                    <li><a href="{{ asset($navigation->navigation_path) }}" class="{{ Request::is($navigation->navigation_path) ? 'active' : null }}"><span class="icon {{ ($navigation->navigation_icon) }}"></span></a></li>
                @endforeach
            @endisset
        @elseif(session()->get('user')[0]->role_name == 'user')
            @isset($authNavigations)
                @foreach($authNavigations as $authNavigation)
                    <li><a href="{{ asset($authNavigation->navigation_path) }}" class="{{ Request::is($authNavigation->navigation_path) ? 'active' : null }}"><span class="icon {{ ($authNavigation->navigation_icon) }}"></span></a></li>
                @endforeach
            @endisset
        @endif
    @else
        @isset($noAuthNavigations)
            @foreach($noAuthNavigations as $noAuthNavigation)
                <li><a href="{{ asset($noAuthNavigation->navigation_path) }}" class="{{ Request::is($noAuthNavigation->navigation_path) ? 'active' : null }}"><span class="icon {{ ($noAuthNavigation->navigation_icon) }}"></span></a></li>
            @endforeach
        @endisset
    @endif
    </ul>
</nav>
