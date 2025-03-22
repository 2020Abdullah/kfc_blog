<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Models\Category;
use App\Models\FilePath;
use App\Models\PageContent;
use App\Models\SiteInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $page = new PageContent();
        $page->title = $request->title;
        $page->main_image = $imagePath;
        $page->content = $request->content;
        $page->location = $request->location;
        $page->save();
        

         // upload files pdf

        if ($request->hasFile('files')) {
            $uploadedFiles = [];

            foreach ($request->file('files') as $file) {
                $fileName = $file->getClientOriginalName();

                $file->storeAs('public/pdf', $fileName);

                $pdfUrl = asset(Storage::url('pdf/' . $fileName));

                $uploadedFile = FilePath::create([
                    'fileName' => $fileName,
                    'path' => $pdfUrl,
                    'fileable_id' => $page->id,
                    'fileable_type' => 'App\Models\PageContent',
                ]);

                $uploadedFiles[] = $uploadedFile;
            }

        }

        
        // حفظ ملفات PDF إذا تم رفعها
        if ($request->has('uploaded_files')) {
            $uploadedFiles = json_decode($request->uploaded_files, true);
    
            if (is_array($uploadedFiles)) {
                foreach ($uploadedFiles as $fileName) {
                    $pdfUrl = asset(Storage::url('pdf/' . $fileName));
                    // حفظ المسار في الداتابيز
                    FilePath::create([
                        'fileName' => $fileName,
                        'path' => $pdfUrl, // مسار الملف في storage
                        'fileable_id' => $page->id,
                        'fileable_type' => 'App\Models\PageContent',
                    ]);
                }
            }
        }

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

        // upload files pdf

        if ($request->hasFile('files')) {
            $uploadedFiles = [];

            foreach ($request->file('files') as $file) {
                $fileName = $file->getClientOriginalName();

                $file->storeAs('public/pdf', $fileName);

                $pdfUrl = asset(Storage::url('pdf/' . $fileName));

                $uploadedFile = FilePath::create([
                    'fileName' => $fileName,
                    'path' => $pdfUrl,
                    'fileable_id' => $request->id,
                    'fileable_type' => 'App\Models\PageContent',
                ]);

                $uploadedFiles[] = $uploadedFile;
            }

        }

        // حفظ ملفات PDF إذا تم رفعها
        if ($request->has('uploaded_files')) {
            $uploadedFiles = json_decode($request->uploaded_files, true);
    
            if (is_array($uploadedFiles)) {
                foreach ($uploadedFiles as $fileName) {
                    $pdfUrl = asset(Storage::url('pdf/' . $fileName));
                    // حفظ المسار في الداتابيز
                    FilePath::create([
                        'fileName' => $fileName,
                        'path' => $pdfUrl, // مسار الملف في storage
                        'fileable_id' => $page->id,
                        'fileable_type' => 'App\Models\PageContent',
                    ]);
                }
            }
        }
    

        toast('تم تحديث الخبر بنجاح','success');

        return redirect()->route('page.view')->with('success', 'تم تحديث الخبر بنجاح');
    }

    public function deletePage(Request $request){
        $blog = PageContent::where('id', $request->id);
        $blog->delete();
        toast('تم حذف الصفحة بنجاح','success');
        return back()->with('success', 'تم حذف الصفحة بنجاح!');
    }

    public function deleteFile(Request $request){
        $file = FilePath::findOrFail($request->id);

        $filePath = storage_path("app/public/pdf/" . $file->fileName);
    
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    
        $file->delete(); 
        toast('تم حذف الملف بنجاح','success');
        return back();
    }

    public function showPage($id){
        $data['page'] = PageContent::where('id', $id)->first();
        return view('dashboard.page.show', $data);
    }

    public function uploadFile(Request $request){
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName(); // الاحتفاظ بالاسم الأصلي مع الوقت لتجنب التكرار
            $filePath = $file->storeAs('public/pdf', $fileName); // حفظ الملف
    
            return response()->json([
                'file_name' => $fileName,
                'file_path' => Storage::url($filePath) // إرجاع مسار الملف لاستخدامه في العرض
            ]);
        }
    
        return response()->json(['error' => 'لم يتم رفع أي ملف'], 400);
    }
}
