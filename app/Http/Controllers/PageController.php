<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Models\Category;
use App\Models\PageContent;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function pageView(){
        $pages = PageContent::paginate(10);
        return view('dashboard.page.index', compact('pages'));
    }

    public function addPage(){
        return view('dashboard.page.create');
    }

    public function storePage(PageRequest $request){
         // حفظ الصورة الرئيسية في مجلد داخل public/images/pages
         if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/pages/'), $imageName);
            $imagePath = 'images/pages/' . $imageName; // المسار للحفظ في قاعدة البيانات
        }
        
         PageContent::create([
             'title' => $request->title,
             'main_image' => $imagePath,
             'content' => $request->content,
             'location' => $request->location,
         ]);

         toast('تم حفظ الصفحة بنجاح','success');
         return redirect()->route('page.view')->with('success', 'تم حفظ الصفحة بنجاح!');
    }

    public function editPage($id){
        $data['page'] = PageContent::where('id', $id)->first();
        return view('dashboard.page.edit', $data);
    }

    public function updatePage(Request $request){

        $page = PageContent::find($request->id);

        // تحديث العنوان
        $page->title = $request->input('title');

        // تحديث الصورة الرئيسية
        if ($request->hasFile('main_image')) {
            // حذف الصورة القديمة من مجلد public/images/
            $oldImagePath = public_path('public/images/pages/' . $page->main_image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // حذف الصورة القديمة
            }

            // رفع الصورة الجديدة
            $image = $request->file('main_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/pages/'), $imageName);
            $imagePath = 'images/pages/' . $imageName; // المسار للحفظ في قاعدة البيانات

            $page->main_image = $imagePath;
        }

        // تحديث المحتوى
        $page->content = $request->input('content');

        // تحديث مكان الظهور
        $page->location = $request->input('location');

        $page->save();

        toast('تم تحديث الخبر بنجاح','success');

        return redirect()->route('blog.view')->with('success', 'تم تحديث الخبر بنجاح');
    }

    public function deletePage(Request $request){
        $blog = PageContent::where('id', $request->id);
        $blog->delete();
        toast('تم حذف الصفحة بنجاح','success');
        return back()->with('success', 'تم حذف الصفحة بنجاح!');
    }

    public function showPage($id){
        $data['page'] = PageContent::where('id', $id)->first();
        return view('dashboard.page.show', $data);
    }
}
