@extends('layout.template')

@section('title')
    Snapshot - Gallery
@endsection

@section('center')

<section>

    <!-- Photo Galleries -->
    <div class="gallery">
        <header>
            <h1>Gallery</h1>
            <ul class="tabs">
                <li><a href="{{ asset('/gallery') }}" class="button active">All</a></li>
                @isset($categories)
                    @foreach($categories as $category)
                        <li><a href="{{ asset('/gallery/'.$category->category_id) }}" class="button" id="{{ 'cat'.$category->category_id }}">{{ $category->category_name }}</a></li>
                    @endforeach
                @endisset
            </ul>
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
    </div>
</section>

@endsection

@section('scripts')

    @parent
    <script src="{{ asset('/') }}js/ajax.js"></script>
    
@endsection
