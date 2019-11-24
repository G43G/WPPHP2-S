@extends('layout.template')

@section('title')
    Snapshot | Admin Panel
@endsection

@section('center')

<section id="admin">
    <div class="inner">
        <h1>Admin Panel</h1>
        <ul class="tabs">
            <li><a href="{{ asset('/admin-panel/users') }}" class="button {{ Request::is('admin-panel/users') ? 'active' : null }}" id="buttonUsers">USERS</a></li>
            <li><a href="{{ asset('/admin-panel/roles') }}" class="button {{ Request::is('admin-panel/roles') ? 'active' : null }}" id="buttonRoles">ROLES</a></li>
            <li><a href="{{ asset('/admin-panel/pictures') }}" class="button {{ Request::is('admin-panel/pictures') ? 'active' : null }}" id="buttonPictures">PICTURES</a></li>
            <li><a href="{{ asset('/admin-panel/categories') }}" class="button {{ Request::is('admin-panel/categories') ? 'active' : null }}" id="buttonCategories">CATEGORIES</a></li>
            <li><a href="{{ asset('/admin-panel/navigation') }}" class="button {{ Request::is('admin-panel/navigation') ? 'active' : null }}" id="buttonNavigation">NAVIGATION</a></li>
            <li><a href="{{ asset('/admin-panel/polls') }}" class="button {{ Request::is('admin-panel/polls') ? 'active' : null }}" id="buttonPolls">POLL</a></li>
        </ul>
    </div>
</section>
<section class="contact">

@yield('admin')
    
</section>

@endsection

@section('scripts')

@parent
<script src="{{ asset('/') }}js/ajax.js"></script>

@endsection