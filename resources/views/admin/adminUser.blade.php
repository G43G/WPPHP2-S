@extends('pages.admin')

@section('admin')

<div class="column admin">
    <h2>MANAGE USERS</h2>
    <div class="table-wrapper">
        @isset($users)
            @if(count($users) > 5)
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
                    <td>E-Mail</td>
                    <td>Username</td>
                    <td>Role</td>
                    <td>Registered</td>
                    <td>Changed</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody>
            @isset($users)
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->user_id }}</td>
                    <td>{{ $user->user_mail }}</td>
                    <td>{{ $user->user_name }}</td>
                    <td>{{ $user->role_name }}</td>
                    <td>{{ date('d.m.Y', strtotime($user->registered_at)) }}</td>
                    <td>{{ (isset($user->changed_at)) ? date('d.m.Y', strtotime($user->changed_at)) : 'NEVER' }}</td>
                    <td><a href="{{ asset('/admin-panel/users/'.$user->user_id) }}"><i class="fa fa-edit"></i></a></td>
                    <td><a href="{{ asset('/admin-panel/users/delete/'.$user->user_id) }}"><i class="fa fa-trash"></i></a></td>
                </tr>
                @endforeach
            @endisset
            </tbody>
        </table>
    </div>
</div>
<div class="social column">
    <h2>{{ (isset($selectedUser))? 'EDIT USER' : 'ADD USER' }}</h2>
    <form action="{{ (isset($selectedUser)) ? asset('/admin-panel/users/update/'.$selectedUser->user_id) : route('insertUser') }}" method="post">
    {{ csrf_field() }}
        <div class="field half first">
            <label for="userEmailAdmin">E-Mail</label>
            <input type="email" name="userEmailAdmin" id="userEmailAdmin" value="{{ (isset($selectedUser)) ? $selectedUser->user_mail : old('userEmailAdmin') }}"/>
        </div>
        <div class="field half">
            <label for="userUsernameAdmin">Username</label>
            <input type="text" name="userUsernameAdmin" id="userUsernameAdmin" value="{{ (isset($selectedUser)) ? $selectedUser->user_name : old('userUsernameAdmin') }}"/>
        </div> 
        <div class="field half">
        <label for="userPasswordAdmin">Password</label>		  
            <input type="password" name="userPasswordAdmin" id="userPasswordAdmin" value="{{ (isset($selectedUser)) ? $selectedUser->user_pass : old('userPasswordAdmin') }}"/>
        </div>
        <div class="field half left">
            <label for="userRoleAdmin">Role</label>
            <select name="userRoleAdmin" id="userRoleAdmin">
                <option value="0">Choose</option>
                @isset($roles)
                    @foreach($roles as $role)
                        <option value="{{ $role->role_id }}" {{ (isset($selectedUser) && $selectedUser->role_id == $role->role_id) ? 'selected' : (old('userRoleAdmin')==$role->role_id) ? 'selected' : '' }}>{{ $role->role_name }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="form-group">
            <input type="submit" name="addEditUser" value="{{ (isset($selectedUser))? 'UPDATE' : 'ADD' }}" class="btn btn-default"/>
            @isset($selectedUser)
                <a href="{{ asset('admin-panel/users/') }}" class="button cancel">CANCEL</a>
            @endisset
        </div> 
    </form>
</div>

@endsection
