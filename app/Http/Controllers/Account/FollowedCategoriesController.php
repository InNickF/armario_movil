<?php

namespace App\Http\Controllers\Account;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\NotificationType;
use App\Http\Controllers\AppBaseController;

class FollowedCategoriesController extends \App\Http\Controllers\Controller
{
  
    public function index(Request $request)
    {
        $followed_categories = auth()->user()->followings(Category::class)->get();
        $categories = Category::parents()->get()->map(function($c) {
            $c->isFollowed = $c->isFollowedBy(auth()->user());
            return $c;
        });
        $subcategories = Category::childrens()->get()->map(function($c) {
            $c->isFollowed = $c->isFollowedBy(auth()->user());
            return $c;
        });

        return view('account.followed_categories.index', compact('followed_categories', 'categories', 'subcategories'));
    }

    // public function update(Request $request)
    // {
    //     $input = $request->all();
    //     // dd($input);
    //     $notificationTypes = NotificationType::all();

    //     foreach ($notificationTypes as $key => $type) {
    //         if(isset($input['settings'][$type->id]) && !empty($input['settings'][$type->id])) {
    //             $value = $input['settings'][$type->id];
    //             $setting = auth()->user()->getNotificationSetting($type->id);
    //             // dd($value);
    //             $setting->send_push = $value['send_push'] ?? false;
    //             $setting->send_email = $value['send_email'] ?? false;
    //             $setting->save();
    //         }
    //     }

    //     alert()->success('Ajustes actualizados');

    //     return redirect(route('account.notificationSettings'));
    // }

}
