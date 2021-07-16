@extends('layout')

@section('title')
Create Category
@endsection
@section('feature-title')
Create Category
@endsection
@section('content')

@if (Session::get('alert-success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{Session::get('alert-success')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (Session::get('alert-warning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{Session::get('alert-warning')}}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<form action="{{URL::to('post-category-form')}}" method="post">
    @csrf
    <div class="mb-3">
        <label for="categoryName" class="form-label">Category Name</label>
        <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Enter Category Name" value="{{ old('categoryName')}}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
