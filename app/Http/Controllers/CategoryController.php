<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $Allcategory = Category::all();
        return view('dashboard.category.index', compact('Allcategory'));
    }

    public function store(CategoryRequest $request){
        Category::create([
            'name' => $request->name
        ]);
        toast('تم إضافة القسم بنجاح','success');
        return back()->with('success', 'تم إضافة القسم بنجاح');
    }

    public function update(CategoryRequest $request){
        $category = Category::where('id', $request->cate_id)->first();
        $category->update([
            'name' => $request->name
        ]);
        toast('تم تحديث القسم بنجاح','success');
        return back()->with('success', 'تم تحديث القسم بنجاح');
    }

    public function delete(Request $request){
        $category = Category::where('id', $request->cate_id)->first();
        $category->delete();
        return back()->with('success', 'تم حذف القسم بنجاح');
    }
}
