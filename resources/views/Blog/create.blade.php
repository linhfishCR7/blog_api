@extends('layout')

@section('title')
Create Blog
@endsection
@section('feature-title')
Create Blog
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
<form action="{{URL::to('store-blog-post')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="blogTitle" class="form-label">Blog Title</label>
        <input type="text" class="form-control" id="blogTitle" name="blogTitle" placeholder="Enter Blog Title" value="{{ old('blogTitle')}}">
    </div>
    <div class="mb-3">
        <label for="blogTitle" class="form-label">Blog Details</label>
        <textarea class="form-control" id="editor1" name="blogDetails" value="{{ old('blogDetails')}}"></textarea>
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Select Category</label>
        <select name="category" id="category" class="form-control">
            @foreach($categories as $category)
            @if(old('id') == $category->id)
            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
            @else
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="imageFeature" class="form-label">Upload Image</label>
        <input type="file" class="form-control" id="imageFeature" name="imageFeature" value="{{ old('imageFeature')}}">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
@section('custom-script')
<script>
    $(document).ready(function() {
        $("#imageFeature").fileinput({
            theme: 'fas'
            , showUpload: false
            , showCaption: true
            , fileType: "any"
            ,initialPreviewAsData: true
            , previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
            , overwriteInitial: false
        });
    });

</script>
@endsection