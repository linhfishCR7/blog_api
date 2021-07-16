@extends('layout')

@section('title')
Edit Blog Post
@endsection
@section('feature-title')
Edit Blog Post
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
<form action="{{URL::to('update-blog-post')}}/{{$blogPost->id}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="blogTitle" class="form-label">Blog Title</label>
        <input type="text" class="form-control" id="blogTitle" name="blogTitle" value="{{ old('blogTitle',$blogPost->title)}}">
    </div>
    <div class="mb-3">
        <label for="blogTitle" class="form-label">Blog Details</label>
        <textarea class="form-control" id="editor1" name="blogDetails" >{{ $blogPost->details }}</textarea>
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Select Category</label>
        <select name="category" id="category" class="form-control">
            @foreach($categories as $category)
            @if($blogPost->category_id == $category->id)
            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
            @else
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="imageFeature" class="form-label">Upload Image</label>
        <input type="file" class="form-control" id="imageFeature" name="imageFeature" value="{{ old('imageFeature',$blogPost->feature_image_url)}}">
    </div>
    <button type="submit" class="btn btn-primary"> Update </button>
</form>
@endsection
@section('custom-script')
<script>
        $(document).ready(function() {
            $("#imageFeature").fileinput({
                theme: 'fas'
                , showUpload: true
                , showCaption: true
                , fileType: "any"
                , append: false
                , showRemove: false
                , autoReplace: true
                , previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
                , overwriteInitial: false
                , initialPreviewShowDelete: false
                , initialPreviewAsData: true
                , initialPreview: [
                    "{{ asset('storage/upload/' . $blogPost->feature_image_url) }}"
                ]
                , initialPreviewConfig: [{
                    caption: "{{ $blogPost->feature_image_url }}"
                    , size: {{ Storage::exists('public/upload/'.$blogPost->feature_image_url) ? Storage::size('public/upload/'.$blogPost->feature_image_url) : 0 }}
                    , width: "120px"
                    , url: "{$url}"
                    , key: 1
                }, ]
            });
           
        });

    </script>
@endsection
