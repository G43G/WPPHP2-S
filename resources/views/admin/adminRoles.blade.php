@extends('pages.admin')

@section('admin')

<div class="column admin">
    <h2>MANAGE ROLES</h2>
    <div class="table-wrapper">
        @isset($roles)
            @if(count($roles) > 5)
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
                    <td>Role</td>
                    <td>Created</td>
                    <td>Updated</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody>
            @isset($roles)
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->role_id }}</td>
                        <td>{{ $role->role_name }}</td>
                        <td>{{ date('d.m.Y', strtotime($role->created_at)) }}</td>
                        <td>{{ (isset($role->updated_at)) ? date('d.m.Y', strtotime($role->updated_at)) : 'NEVER' }}</td>
                        <td><a href="{{ asset('/admin-panel/roles'.'/'.$role->role_id) }}"><i class="fa fa-edit"></i></a></td>
                        <td><a href="{{ asset('/admin-panel/roles/delete/'.$role->role_id) }}"><i class="fa fa-trash"></i></a></td>
                    </tr>
                @endforeach
            @endisset
            </tbody>
        </table>
    </div>
</div>
<div class="social column">
    <h2>{{ (isset($selectedRole))? 'EDIT ROLE' : 'ADD ROLE' }}</h2>
    <form action="{{ (isset($selectedRole)) ? asset('/admin-panel/roles/update/'.$selectedRole->role_id) : route('insertRole') }}" method="post">
    {{ csrf_field() }}
        <div class="field half first">
            <label for="roleNameAdmin">Name</label>
            <input type="text" name="roleNameAdmin" id="roleNameAdmin" value="{{ (isset($selectedRole)) ? $selectedRole->role_name : old('roleNameAdmin') }}"/>
        </div>
        <div class="form-group">
            <input type="submit" name="addEditRole" value="{{ (isset($selectedRole))? 'UPDATE' : 'ADD' }}" class="btn btn-default"/>
            @isset($selectedRole)
                <a href="{{ asset('admin-panel/roles/') }}" class="button cancel">CANCEL</a>
            @endisset
        </div> 
    </form>
</div>

@endsection
