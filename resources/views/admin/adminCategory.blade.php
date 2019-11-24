@extends('pages.admin')

@section('admin')

<div class="column admin">
    <h2>MANAGE CATEGORIES</h2>
    <div class="table-wrapper">
        @isset($categories)
            @if(count($categories) > 5)
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
                    <td>Category</td>
                    <td>Created</td>
                    <td>Updated</td>
                    <td>Edit</td>
                    <td>Delete</td>
                </tr>
            </thead>
            <tbody>
            @isset($categories)
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->category_id }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ date('d.m.Y', strtotime($category->created_at)) }}</td>
                        <td>{{ (isset($category->updated_at)) ? date('d.m.Y', strtotime($category->updated_at)) : 'NEVER' }}</td>
                        <td><a href="{{ asset('/admin-panel/categories'.'/'.$category->category_id) }}"><i class="fa fa-edit"></i></a></td>
                        <td><a href="{{ asset('/admin-panel/categories/delete/'.$category->category_id) }}"><i class="fa fa-trash"></i></a></td>
                    </tr>
                @endforeach
            @endisset
            </tbody>
        </table>
    </div>
</div>
<div class="social column">
    <h2>{{ (isset($selectedCategory)) ? 'EDIT CATEGORY' : 'ADD CATEGORY' }}</h2>
    <form action="{{ (isset($selectedCategory)) ? asset('/admin-panel/categories/update/'.$selectedCategory->category_id) : route('insertCategory') }}" method="post">
    {{ csrf_field() }}
        <div class="field half first">
            <label for="categoryNameAdmin">Name</label>
            <input type="text" name="categoryNameAdmin" id="categoryNameAdmin" value="{{ (isset($selectedCategory)) ? $selectedCategory->category_name : old('categoryNameAdmin') }}"/>
        </div>
        <div class="form-group">
            <input type="submit" name="addEditCategory" value="{{ (isset($selectedCategory))? 'UPDATE' : 'ADD' }}" class="btn btn-default"/>
            @isset($selectedCategory)
                <a href="{{ asset('admin-panel/categories/') }}" class="button cancel">CANCEL</a>
            @endisset
        </div> 
    </form>
</div>

@endsection
