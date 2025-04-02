@extends('admin.layouts.app')
@if (session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-success">
        {{session('error')}}
    </div>
@endif
@section('title','Danh sach ')
@section('content')
    <div class="container">
        <h2>Danh muc</h2>
        <a href="{{route('categories.create')}}" class="btn btn-primary">Them</a>
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="tìm kiếm" value="{{request('search')}}" >
                <button type="submit" class="btn btn-primary">tìm</button>
            </div>
        </form>
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>TEN</th>
                <th>TRANG THAI</th>
                <th>HANH DONG</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $c)
                <tr>
                    <td>{{$c->id}}</td>
                    <td>{{$c->name}}</td>
                    <td>{{$c->status ? "hành động" : "tạm dừng"}}</td>
                    
                    <td>
                        <a href="{{route('categories.edit', $c->id)}}" class="btn btn-warning">sua</a>
                        <a href="{{route('categories.show', $c->id)}}" class="btn btn-info">chi tiết</a>
                        <form action="{{route('categories.destroy', $c->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('chắc k')">xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$categories->links()}}
</div>
@endsection