@extends('pages.admin')

@section('admin')

<div class="column admin">
    <h2>MANAGE PICTURES</h2>
    <div class="table-wrapper">
        @isset($pictures)
            @if($pictures->count() > 5)
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
                    <td>Picture</td>
                    <td>Name</td>
                    <td>Category</td>
                    <td>User</td>
                    <td>Shared</td>
                    <td>Updated</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody>
            @isset($pictures)
                @foreach($pictures as $picture)
                    <tr>
                        <td>{{ $picture->picture_id }}</td>
                        <td class="show">PREVIEW<img src="{{ asset($picture->picture_path) }}" class="hide"/></td>
                        <td>{{ $picture->picture_name }}</td>
                        <td>{{ $picture->category_name }}</td>
                        <td>{{ $picture->user_name }}</td>
                        <td>{{ date('d.m.Y', strtotime($picture->shared_at)) }}</td>
                        <td>{{ (isset($picture->pictureUpdated)) ? date('d.m.Y', strtotime($picture->pictureUpdated)) : 'NEVER' }}</td>
                        <td><a href="{{ asset('/admin-panel/pictures'.'/'.$picture->picture_id) }}"><i class="fa fa-edit"></i></a></td>
                        <td><a href="{{ asset('/admin-panel/pictures/delete/'.$picture->picture_id) }}"><i class="fa fa-trash"></i></a></td>
                        <td class="hide"></td>
                    </tr>
                @endforeach
            @endisset
            </tbody>
        </table>
    </div>
</div>
<div class="social column">
    <h2>{{ (isset($selectedPicture))? 'EDIT PICTURE' : 'ADD PICTURE' }}</h2>
    <form action="{{ (isset($selectedPicture)) ? asset('/admin-panel/pictures/update/'.$selectedPicture->picture_id) : route('insertPicture') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
        <div class="field half first">
            <label for="pictureNameAdmin">Name</label>
            <input type="text" name="pictureNameAdmin" id="pictureNameAdmin" value="{{ (isset($selectedPicture)) ? $selectedPicture->picture_name : old('pictureNameAdmin') }}"/>
        </div>
        <div class="field half">
            <label for="pictureFileAdmin">Picture</label>
            <input type="file" name="pictureFileAdmin" id="pictureFileAdmin" value="{{ (isset($selectedPicture)) ? $selectedPicture->picture_path : old('pictureFileAdmin') }}"/>
        </div>
        <div class="field half first">
            <label for="pictureCategoryAdmin">Category</label>
            <select name="pictureCategoryAdmin" id="pictureCategoryAdmin">
                <option value="0">Choose</option>
                @isset($categories)
                    @foreach($categories as $category)
                        <option value="{{ $category->category_id }}" {{ (isset($selectedPicture) && $selectedPicture->category_id == $category->category_id) ? 'selected' : (old('pictureCategoryAdmin')==$category->category_id)? 'selected' : '' }}>{{ $category->category_name }}</option>
                    @endforeach
                @endisset
            </select>
        </div> 
        <div class="field half">
            <label for="pictureUserAdmin">User:</label>
            <select name="pictureUserAdmin" id="pictureUserAdmin">
                <option value="0">Choose</option>
                @isset($users)
                    @foreach($users as $user)
                        <option value="{{ $user->user_id }}" {{ (isset($selectedPicture) && $selectedPicture->user_id == $user->user_id) ? 'selected' : (old('pictureUserAdmin')==$user->user_id) ? 'selected' : '' }}>{{ $user->user_name }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="form-group">
            <input type="submit" name="addEditPicture" value="{{ (isset($selectedPicture))? 'UPDATE' : 'ADD' }}" class="btn btn-default"/>
            @isset($selectedPicture)
                <a href="{{ asset('admin-panel/pictures/') }}" class="button cancel">CANCEL</a>
            @endisset
        </div> 
    </form>
</div>

@endsection