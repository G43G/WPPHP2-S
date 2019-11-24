@extends('layout.template')

@section('title')
    Snapshot - Home
@endsection

@section('center')

<section id="banner">
    <div class="inner">
        <h1>Hey, I'm Snapshot</h1>
        <p>Share, like, enjoy!</p>
        <ul class="actions">
            <li><a href="#galleries" class="button alt scrolly big">Continue</a></li>
        </ul>
    </div>
</section>

<section id="galleries">
    <div class="gallery">
        <header class="special">
                <h2>What's New</h2>
        </header>
        <div class="content">
            @isset($pictures)
                @foreach($pictures as $picture)
                    <div class="media">
                        <a href="{{ asset('/pictures/'.$picture->picture_id ) }}"><img src="{{ ($picture->picture_show) }}" alt="{{ ($picture->picture_name) }}"/></a>
                    </div>
                @endforeach
            @endisset
        </div>
        <footer>
            <a href="{{ asset('/gallery') }}" class="button big">Full Gallery</a>
        </footer>
    </div>
</section>
@if(session()->has('user'))
    <section class="contact">
        <div class="column emptyPoll">
            <div id="poll" class="poll"></div>
            <input type="hidden" value="{{session()->get('user')[0]->user_id}}" id="idUser"></input>
            @isset($result)
               <input type="hidden" value="1" id="exist"/>
            @else
               <input type="hidden" value="0" id="exist"/>
            @endisset
            <div id="feedback"></div>
        </div>
    </section>
@else
    <section class="contact">
        <div class="column login">
            <h3>Log In</h3>
            <form action="{{ route('login') }}" method="post">
            {{ csrf_field() }}
                <div class="field half first">
                    <label for="usernameLogin">Username</label>
                    <input name="usernameLogin" id="usernameLogin" type="text" placeholder="Username"/>
                </div>
                <div class="field half">
                    <label for="passwordLogin">Password</label>
                    <input name="passwordLogin" id="passwordLogin" type="password" placeholder="Password"/>
                </div>
                <ul class="actions">
                    <li><input value="LOG IN" name="buttonLogin" id="buttonLogin" class="button" type="submit"/></li>
                </ul>
            </form>
        </div>
        <div class="social column register">
            <h3>Register</h3>
            <form action="{{ route('register') }}" method="post" id="formRegister">
            {{ csrf_field() }}
                <div class="field half first">
                    <label for="emailRegister">E-Mail</label>
                    <input name="emailRegister" id="emailRegister" type="email" onKeyUp="checkMail();" placeholder="E-Mail (required)"/>
                </div>
                <div class="field half">
                    <label for="usernameRegister">Username</label>
                    <input name="usernameRegister" id="usernameRegister" type="text" onKeyUp="checkUsername();" placeholder="Username (required)"/>
                </div>
                <div class="field half first">
                    <label for="passwordRegister">Password</label>
                    <input name="passwordRegister" id="passwordRegister" type="password" onKeyUp="checkPassword();" placeholder="Password"/>
                </div>
                <div class="field half">
                    <label for="passwordRepeat">Repeat Password</label>
                    <input name="passwordRegister_confirmation" id="passwordRegister_confirmation" onKeyUp="checkPasswordConfirm();" type="password" placeholder="Repeat Password"/>
                </div>
                <ul class="actions">
                    <li><input value="REGISTER" name="buttonRegister" id="buttonRegister" class="button" type="submit"/></li>
                </ul>
            </form>
        </div>
    </section>
@endif

@endsection

@section('scripts')

    @parent
    <script src="{{ asset('/') }}js/ajax.js"></script>
    
@endsection