<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogPosts = BlogPost::all();
        return view('Blog.index', compact('blogPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('Blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blogPost = new BlogPost();
        $blogPost->title = $request->input('blogTitle');
        $blogPost->details = $request->input('blogDetails');
        $blogPost->category_id = $request->input('category');
        $blogPost->user_id = 0;
        if ($request->hasFile('imageFeature')) {
            $file = $request->imageFeature;

            // Lưu tên hình vào column sp_hinh
            $blogPost->feature_image_url = $file->getClientOriginalName();

            // Chép file vào thư mục "storage/public/photos"
            $fileSaved = $file->storeAs('public/upload', $blogPost->feature_image_url);
        }
        if($blogPost->save()){
            
            return redirect()->back()->with('alert-success','Thêm thành công' );
        }
        return redirect()->back()->with('alert-warning','Thêm thất bại' );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blogPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $categories = Category::all();
        $blogPost = BlogPost::find($id);
        //dd($category);
        return view('Blog.edit', compact('categories','blogPost'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blogPost = BlogPost::find($id);
        $blogPost->title = $request->input('blogTitle');
        $blogPost->details = $request->input('blogDetails');
        $blogPost->category_id = $request->input('category');
        $blogPost->user_id = 0;  
        // Kiểm tra xem người dùng có upload hình ảnh Đại diện hay không?
        if ($request->hasFile('imageFeature')) {
            // Xóa hình cũ để tránh rác
            Storage::delete('public/upload/' . $blogPost->feature_image_url);

            // Upload hình mới
            // Lưu tên hình vào column imageFeature
            $file = $request->imageFeature;
            $blogPost->feature_image_url = $file->getClientOriginalName();

            // Chép file vào thư mục "photos"
            $fileSaved = $file->storeAs('public/upload', $blogPost->feature_image_url);
        }      
        if($blogPost->save()){
            return redirect()->back()->with('alert-success','Cập nhật thành công' );
        }
        return redirect()->back()->with('alert-warning','Cập nhật thất bại' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blogPost = BlogPost::find($id);   
        $blogPost->delete();
    }
}
