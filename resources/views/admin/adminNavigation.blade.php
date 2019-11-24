@extends('pages.admin')

@section('admin')

<div class="column admin">
    <h2>MANAGE NAVIGATION LINKS</h2>
    <div class="table-wrapper">
        @isset($navigations)
            @if(count($navigations) > 5)
                <div class="wrapper-paging">
                    <ul>
                        <li><a class="paging-back"><i class="fa fa-arrow-left"></i></a></li>
                        <li><a class="paging-this"><strong>0</strong> of <span>x</span></a></li>
                        <li><a class="paging-next"><i class="fa fa-arrow-right"></i></a></li>
                    </ul>
                </div>
            @endif
        @endisset
        <table class="table">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Path</td>
                    <td>Image</td>
                    <td>Created</td>
                    <td>Updated</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody>
            @isset($navigations)
                @foreach($navigations as $navigation)
                    <tr>
                        <td>{{ $navigation->navigation_id }}</td>
                        <td>{{ $navigation->navigation_name }}</td>
                        <td>{{ $navigation->navigation_path }}</td>
                        <td><i class="icon {{ $navigation->navigation_icon }}"</i> ({{ $navigation->navigation_icon }})</td>
                        <td>{{ date('d.m.Y', strtotime($navigation->created_at)) }}</td>
                        <td>{{ (isset($navigation->updated_at)) ? date('d.m.Y', strtotime($navigation->updated_at)) : 'NEVER' }}</td>
                        <td><a href="{{ asset('/admin-panel/navigation'.'/'.$navigation->navigation_id) }}"><i class="fa fa-edit"></i></a></td>
                        <td><a href="{{ asset('/admin-panel/navigation/delete/'.$navigation->navigation_id) }}"><i class="fa fa-trash"></i></a></td>
                    </tr>
                @endforeach
            @endisset
            </tbody>
        </table>
    </div>
</div>
<div class="social column">
    <h2>{{ (isset($selectedNavigation))? 'EDIT NAVIGATION LINK' : 'ADD NAVIGATION LINK' }}</h2>
    <form action="{{ (isset($selectedNavigation)) ? asset('/admin-panel/navigation/update/'.$selectedNavigation->navigation_id) : route('insertNavigation') }}" method="post">
    {{ csrf_field() }}
        <div class="field half first">
            <label for="navigationNameAdmin">Name</label>
            <input type="text" name="navigationNameAdmin" id="navigationNameAdmin" value="{{ (isset($selectedNavigation)) ? $selectedNavigation->navigation_name : old('navigationNameAdmin') }}"/>
        </div>
        <div class="field half">
            <label for="navigationPathAdmin">Path</label>
            <input type="text" name="navigationPathAdmin" id="navigationPathAdmin" value="{{ (isset($selectedNavigation)) ? $selectedNavigation->navigation_path : old('navigationPathAdmin') }}"/>
        </div>
        <div class="field half first">
            <label for="navigationIconAdmin">Icon (manually choose from <a href="https://fontawesome.com/icons?d=gallery" target="_blank">Font Awesome</a> website)</label>
            <input type="text" name="navigationIconAdmin" id="navigationIconAdmin" value="{{ (isset($selectedNavigation)) ? $selectedNavigation->navigation_icon : old('navigationIconAdmin') }}"/>
        </div>
        <div class="form-group">
            <input type="submit" name="addEditNavigation" value="{{ (isset($selectedNavigation))? 'UPDATE' : 'ADD' }}" class="btn btn-default"/>
            @isset($selectedNavigation)
                <a href="{{ asset('admin-panel/navigation/') }}" class="button cancel">CANCEL</a>
            @endisset
        </div> 
    </form>
</div>

@endsection
