<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use App\Http\Controllers\AppBaseController;

class FollowedCategoriesAPIController extends \App\Http\Controllers\Controller
{


    public function update()
    {
        $followed_categories = request()->get('followed_categories');
        $user = auth('api')->user();


        $parents = Category::parents()->get();

        // *Unfollow all the parents first
        foreach ($parents as $key => $parentCategory) {
            if ($user->isFollowing($parentCategory)) {
                $user->unfollow($parentCategory);
            }
        }

        foreach ($followed_categories as $catId => $isFollowed) {
            try {
                $cat = Category::find($catId);
                if (!$cat) {
                    continue;
                }

                if ($isFollowed) {
                    $user->follow($cat);

                    if ($cat->parent_id) {
                        // *Follow the parent too
                        foreach ($parents as $key => $parentCategory) {
                            if ($cat->parent_id == $parentCategory->id) {

                                if (!$user->isFollowing($parentCategory)) {
                                    $user->follow($parentCategory);
                                }
                            }
                        }
                    }
                } else {
                    if ($cat->parent_id) {
                        // *Unfollow the parent too
                        foreach ($parents as $key => $parentCategory) {
                            if ($cat->parent_id == $parentCategory->id) {

                                if ($user->isFollowing($parentCategory)) {
                                    $user->unfollow($parentCategory);
                                }
                            }
                        }
                    }
                    $user->unfollow($cat);
                }
            } catch (\Throwable $th) {
                \Log::error($th);
            }
        }




        return $this->sendResponse($user->followings(Category::class)->get(), 'Followed categories updated');
    }
}