@extends('layout.template')

@section('title')
    Snapshot - Information
@endsection

@section('center')

<section class="contact">

    <!-- Social -->
    <div class="social column">
        <h3>About Me</h3>
        <div class="contact_wrapper">
            <p><img src="images/profile.jpg"/>My name is Bogdan Matorkić (student number 30/13) and I am currently studying Internet Technologies on ICT College of Vocational Studies, extended year in Belgrade. Only one exam left. I have interest and knowledge in front-end, as well as in back-end programming and I always eager to learn something new. Feel free to contact me for anything.</p>
            <div class="clear"></div>
        </div>
        <h3>Documentation</h3>
        <ul class="icons">
            <li><a href="{{ route('download') }}" class="icon fa-book" target="_blank"><span class="label">Documentation</span></a></li>
        </ul>
        <h3>Follow Me</h3>
        <ul class="icons">
            <li><a href="https://twitter.com/43GuitarGod" class="icon fa-twitter" target="_blank"><span class="label">Twitter</span></a></li>
            <li><a href="https://www.facebook.com/bogdan.matorkic" class="icon fa-facebook" target="_blank"><span class="label">Facebook</span></a></li>
            <li><a href="https://www.instagram.com/43guitargod/" class="icon fa-instagram" target="_blank"><span class="label">Instagram</span></a></li>
        </ul>
    </div>

    <!-- Form -->
    <div class="column">
        <h3>Contact Me</h3>
        <form action="{{ route('mail') }}" method="post">
        {{ csrf_field() }}
            <div class="field half first">
                <label for="contactName">Name</label>
                <input name="contactName" id="contactName" type="text" placeholder="Name">
            </div>
            <div class="field half">
                <label for="contactMail">E-mail</label>
                <input name="contactMail" id="contactMail" type="email" placeholder="E-mail">
            </div>
            <div class="field">
                <label for="contactMessage">Message</label>
                <textarea name="contactMessage" id="contactMessage" rows="6" placeholder="Message"></textarea>
            </div>
            <ul class="actions">
                <li><input value="Send Message" class="button" type="submit"></li>
            </ul>
        </form>
    </div>
</section>

@endsection
