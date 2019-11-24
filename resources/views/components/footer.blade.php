<footer id="footer">
    <div class="copyright">
        <div class="footer_menu">
            <ul>
            @if(session()->has('user'))
                @if(session()->get('user')[0]->role_name == 'administrator')
                    @isset($navigations)
                        @foreach($navigations as $navigation)
                            <li><a href="{{ asset($navigation->navigation_path) }}">{{ ($navigation->navigation_name) }}</a></li>
                        @endforeach
                    @endisset
                @elseif(session()->get('user')[0]->role_name == 'user')
                    @isset($authNavigations)
                        @foreach($authNavigations as $authNavigation)
                            <li><a href="{{ asset($authNavigation->navigation_path) }}">{{ ($authNavigation->navigation_name) }}</a></li>
                        @endforeach
                    @endisset
                @endif
            @else
                @isset($noAuthNavigations)
                    @foreach($noAuthNavigations as $noAuthNavigation)
                        <li><a href="{{ asset($noAuthNavigation->navigation_path) }}">{{ ($noAuthNavigation->navigation_name) }}</a></li>
                    @endforeach
                @endisset
            @endif
            </ul>
            <p>Copyright &copy; Bogdan Matorkić 2018, Snapshot</p>
        </div>
    </div>
</footer>
