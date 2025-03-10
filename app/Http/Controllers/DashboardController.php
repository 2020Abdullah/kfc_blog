<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\Category;
use App\Models\SiteInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(){
        $data['categoryCount'] = Category::count();
        $data['blogCount'] = Blog::count();
        $data['siteInfo'] = SiteInfo::latest()->first();
        return view('dashboard.index', $data);
    }

    public function updateData(Request $request){

        $siteInfo = SiteInfo::where('user_id', auth()->user()->id)->first();

        // logo update 
        if ($request->hasFile('site_logo')) {

            if($siteInfo !== null){
                $site_logo_old = $siteInfo->site_logo;
    
                if($site_logo_old !== null){
                    // حذف الصورة القديمة من مجلد public/images/
                    $oldImagePath = public_path($site_logo_old);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath); // حذف الصورة القديمة
                    }
                }
            }

            $site_logo = $request->file('site_logo');

            $siteLogoName = time() . '.' . $site_logo->getClientOriginalExtension();

            $site_logo->move(public_path('images/logo/'), $siteLogoName);

            $site_logo_path = 'images/logo/' . $siteLogoName; 

        }
        else {
            $site_logo_path = $siteInfo->site_logo;
        }

        SiteInfo::updateOrCreate([
            'user_id' => auth()->user()->id
        ], [
            'site_name' => $request->site_name,
            'site_logo' => $site_logo_path,
            'address' => $request->address,
            'site_email' => $request->site_email,
            'zip_code' => $request->zip_code,
            'intagram_link' => $request->intagram_link,
            'linkedin_link' => $request->linkedin_link,
            'snapchat_link' => $request->snapchat_link,
            'youtube_link' => $request->youtube_link,
            'twitter_link' => $request->twitter_link,
            'google_play' => $request->google_play,
            'app_store' => $request->app_store,
            'whatsUp_number' => $request->whatsUp_number,
            'phone_number' => $request->phone_number,
            'user_id' => auth()->user()->id,
        ]);

        $user = User::where('id', auth()->user()->id)->first();

        $user->name = $request->name;
        $user->name = $request->email;

        if($request->pass !== null){
            $user->password = Hash::make($request->pass);
        }

        $user->save();

        toast('تم تحديث البيانات بنجاح','success');

        return back()->with('success', 'تم تحديث البيانات بنجاح');
    }
}
