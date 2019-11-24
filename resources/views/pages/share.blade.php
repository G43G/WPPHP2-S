@extends('layout.template')

@section('title')
    Snapshot - Share
@endsection

@section('center')

<section class="contact">
    <div class="social column">
        <h1>Share something and contribute to our community!</h1>
        <h3>Keep in mind that there are few rules:</h3>
        <ul>
            <li>Name must be unique.</li>
            <li>Picture must be in .jpg or .jpeg format.</li>
            <li>Be original, do not share pictures from other users.</li>
            <li>Enjoy!</li>
        </ul>
        <form action="{{ asset('/share/share') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="field half first">
                <label for="pictureName">Name</label>
                <input name="pictureName" id="pictureName" type="text" placeholder="Name"/>
            </div>
            <div class="field half">
                <label for="pictureUpload">Picture</label>
                <input name="pictureUpload" id="pictureUpload" type="file"/>
            </div>
            <div class="field half first">
                <label for="pictureCategory">Category</label>
                <select name="pictureCategory" id="pictureCategory">
                    <option value="0">Choose</option>
                    @isset($categories)
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                        @endforeach
                    @endisset
                </select>
            </div>
            <ul class="actions">
                <li><input value="Share" name="buttonShare" id="buttonShare" class="button" type="submit"/></li>
            </ul>
        </form>
    </div>
    <div class="column">
        <h1>Your pictures</h1>
        @isset($pictures)
            @if($pictures->isEmpty())
                <h4>YOU DON'T HAVE ANY PICTURES. TRY TO SHARE ONE!</h4>
            @else
                <div class="userPicturesWrapper">
                    @foreach($pictures as $picture)
                        <div class="overlay">
                            <img src="{{ asset($picture->picture_show) }}" class="image" alt="{{ asset($picture->picture_name) }}"/>
                            <a href="{{ asset('/share/delete/'.$picture->picture_id) }}" class="icon fa-trash middle"><span class="label">Delete</span></a>
                        </div>
                    @endforeach
                </div>
            @endif
        @endisset
        <h1>Change profile</h1>
        @isset($loggedUsers)
            <form action="{{ asset('/share/change/'.$loggedUsers->user_id) }}" method="post">
                {{ csrf_field() }}
                <div class="field half first">
                    <label for="userEmailChange">E-Mail</label>
                    <input type="email" name="userEmailChange" id="userEmailAdmin" value="{{ $loggedUsers->user_mail }}"/>
                </div>
                <div class="field half">
                    <label for="userUsernameChange">Username</label>
                    <input type="text" name="userUsernameChange" id="userUsernameAdmin" value="{{ $loggedUsers->user_name }}"/>
                </div> 
                <div class="field half">
                <label for="userPasswordChange">Password</label>		  
                    <input type="password" name="userPasswordChange" id="userPasswordAdmin" value="{{ $loggedUsers->user_pass }}"/>
                </div>
                <div class="form-group">
                    <input type="submit" name="changeUser" value="CHANGE" class="btn btn-default"/>
                </div> 
            </form>
        @endisset
    </div>
</section>

@endsection
