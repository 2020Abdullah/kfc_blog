<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    public function viewBlog(){
        $blogs = Blog::with('category')->paginate(50);
        return view('dashboard.blog.index', compact('blogs'));
    }

    public function showBlog($id){
        $data['blog'] = Blog::where('id', $id)->with('category')->first();
        return view('dashboard.blog.show', $data);
    }

    public function addBlog(){
        $categories = Category::all();
        return view('dashboard.blog.create', compact('categories'));
    }

    public function editBlog($id){
        $data['categories'] = Category::all();
        $data['blog'] = Blog::where('id', $id)->with('category')->first();
        return view('dashboard.blog.edit', $data);
    }

    public function updateBlog(Request $request){

        $blog = Blog::find($request->id);

        // تحديث العنوان
        $blog->title = $request->input('title');

        // تحديث الصورة الرئيسية
        if ($request->hasFile('main_image')) {
            // حذف الصورة القديمة من مجلد public/images/
            $oldImagePath = public_path('public/images/blogs/' . $blog->main_image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // حذف الصورة القديمة
            }

            // رفع الصورة الجديدة
            $image = $request->file('main_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/blogs/'), $imageName);
            $imagePath = 'images/blogs/' . $imageName; // المسار للحفظ في قاعدة البيانات

            $blog->main_image = $imagePath;
        }

        // تحديث القسم
        $blog->category_id = $request->input('category_id');

        // تحديث المحتوى
        $blog->content = $request->input('content');

        $blog->save();

        toast('تم تحديث الخبر بنجاح','success');

        return redirect()->route('blog.view')->with('success', 'تم تحديث الخبر بنجاح');
    }

    public function storeBlog(BlogRequest $request){
         // حفظ الصورة الرئيسية في مجلد داخل public/images/{id}
         if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName; // المسار للحفظ في قاعدة البيانات
        }
        
         Blog::create([
             'title' => $request->title,
             'main_image' => $imagePath,
             'content' => $request->content,
             'category_id' => $request->category_id,
         ]);
         toast('تم حفظ الخبر بنجاح','success');
         return redirect()->route('blog.view')->with('success', 'تم حفظ الخبر بنجاح!');
    }

    public function deleteBlog(Request $request){
        $blog = Blog::where('id', $request->blog_id);
        $blog->delete();
        toast('تم حذف الخبر بنجاح','success');
        return back()->with('success', 'تم حذف الخبر بنجاح!');
    }

    // رفع الصور داخل المقالة (دعم رفع صور متعددة)
    public function uploadImages(Request $request)
    {
        if ($request->hasFile('images')) {
            $uploadedImages = [];

            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('images/content'); // المسار داخل مجلد public
                
                // نقل الصورة إلى المجلد المطلوب
                $file->move($destinationPath, $filename);
                $imagePath = 'images/content/' . $filename;

                // تخزين الرابط في المصفوفة
                $uploadedImages[] = asset($imagePath);
            }

            // إرجاع الروابط كـ JSON لعرضها داخل المقالة
            return response()->json(['images' => $uploadedImages, 'message' => 'تم رفع الصور بنجاح']);
        }

        return response()->json(['error' => 'لم يتم تحديد أي صور'], 400);
    }

}
