<?php

namespace App\Http\Controllers;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Http\Requests\CommentRequest;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\Category;
use App\Models\PageContent;
use App\Models\SiteInfo;
use App\Models\Slider;
use App\Models\SliderImage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data['blogs'] =Blog::latest()->take(10)->get();
        return view('fronted.home', $data);
    }

    public function categoryView($id){
        $cate_name = Category::where('id', $id)->pluck('name')->first();
        $getBlogLast = Blog::where('category_id', $id)->paginate(50);
        return view('fronted.category', compact('getBlogLast', 'cate_name'));
    }

    public function blogView($id, $slug) {
        $data['post'] = Blog::with('category')->where('id', $id)->firstOrFail();
        $data['hijriDate'] = Hijri::Date('j / m / Y هـ', $data['post']->created_at);
        $data['articles'] = Blog::inRandomOrder()->limit(6)->get(); 
        $data['latestArticles'] = Blog::latest()->take(3)->get();

        // جلب المقالة التالية
        $data['nextArticle'] = Blog::where('id', '>', $id)->orderBy('id')->first();

        // جلب المقالة السابقة في حال لم تكن هناك مقالة تالية
        if (!$data['nextArticle']) {
            $data['nextArticle'] = Blog::where('id', '<', $id)->orderBy('id', 'desc')->first();
        }
        return view('fronted.post', $data);
    }

    public function pageView($id, $slug) {
        $data['page'] = PageContent::where('id', $id)->firstOrFail();
        $data['pages'] = PageContent::latest()->get();
        $data['hijriDate'] = Hijri::Date('j / m / Y هـ', $data['page']->created_at);
        return view('fronted.page', $data);
    }

    public function allNews(){
        $allNews = Blog::latest()->paginate(10);
        $Newspages = PageContent::latest()->where('location', 'NewsPaper')->get();
        return view('fronted.allNews', compact('allNews', 'Newspages'));
    }

    public function search(Request $request){
        $query = $request->input('query'); // جلب الكلمة المراد البحث عنها

        $blogs = Blog::where('title', 'LIKE', "%{$query}%") // البحث في العنوان
                     ->orWhere('content', 'LIKE', "%{$query}%") // البحث في المحتوى
                     ->paginate(10); // عرض 10 نتائج لكل صفحة

        return view('fronted.search-results', compact('blogs', 'query'));
    }
}
