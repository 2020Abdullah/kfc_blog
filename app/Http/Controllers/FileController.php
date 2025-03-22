<?php

namespace App\Http\Controllers;

use App\Models\FilePath;
use App\Models\SiteInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'files.*' => 'required|mimes:pdf|max:100048',
        ], [
            'files.*.required' => 'يجب اختيار ملف !',
            'files.*.mimes' => 'يجب أن يكون الملف بصيغة PDF فقط!',
            'files.*.max' => 'يجب ألا يزيد حجم الملف عن 100 ميغابايت!',
        ]);


    // التحقق من وجود ملفات
    if ($request->hasFile('files')) {
        $uploadedFiles = [];

        $logo = SiteInfo::value('site_logo');

        foreach ($request->file('files') as $file) {
            $fileName = time().'_'.$file->getClientOriginalName();

            $file->storeAs('public/pdf', $fileName);

            $pdfUrl = asset(Storage::url('pdf/' . $fileName));

            $uploadedFile = FilePath::create([
                'fileName' => $fileName,
                'path' => $pdfUrl,
                'fileable_id' => $request->page_id,
                'fileable_type' => 'App\Models\PageContent',
            ]);

            $uploadedFiles[] = $uploadedFile;
        }

        return response()->json([
            'success' => 'تم رفع الملفات بنجاح!',
            'files' => $uploadedFiles,
            'logo' => asset($logo)
        ]);
    }

    return response()->json(['error' => 'لم يتم العثور على أي ملفات!'], 400);
    
       
    }

    public function fetch(){
        $files = FilePath::latest()->get();
        return response()->json($files);
    }

}
