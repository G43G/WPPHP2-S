@isset($cats)
    @if($cats->isEmpty())
    <div class="empty">
        <h1>SORRY, THERE ARE NO PICTURES IN THIS CATEGORY. PLEASE TRY ANOTHER.</h1>
    </div>
    @else
        @foreach($cats as $cat)
            <div class="media">
                <a href="{{ asset('/pictures/'.$cat->picture_id ) }}"><img src="{{ asset($cat->picture_show) }}" alt="{{ ($cat->picture_name) }}"/></a>
            </div>
        @endforeach
    @endif
@endisset

