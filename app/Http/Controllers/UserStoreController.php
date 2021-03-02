<?php

namespace App\Http\Controllers;

use App\Models\UserStore;
use App\Notifications\StoreFollowed;
use App\Notifications\StoreUnfollowed;
use App\Repositories\UserStoreRepository;
use SEO;

class UserStoreController extends \App\Http\Controllers\Controller
{
    /** @var UserStoreRepository */
    private $userStoreRepository;

    public function __construct(UserStoreRepository $userStoreRepo)
    {
        $this->userStoreRepository = $userStoreRepo;
    }

    public function show($slug)
    {
        $userStore = UserStore::with('active_stories')->whereSlug($slug)->first();
        if (empty($userStore)) {
            alert()->error('Tienda no encontrada');

            return redirect(url('/'));
        }

        SEO::setTitle($userStore->name);
        SEO::setDescription($userStore->description);
        SEO::opengraph()->setUrl(url()->current());
        SEO::setCanonical(url()->current());
        SEO::opengraph()->addProperty('type', 'website')->addProperty('image', $userStore->logo_image_thumbnail);

        return view('user_stores.show')->with(compact('userStore'));
    }

    public function toggleFollow($id)
    {
        $store = UserStore::find($id);
        $user = auth()->user();
        $user->toggleFollow($store);

        try {
            if ($user->isFollowing($store)) {
                // Send push to Store Owner
                $store->user->notify(new StoreFollowed($store, $user));
                // Alert to user who follows
                alert()->success('Has comenzado a seguir a '.$store->name);
            } else {
                // Send push to Store Owner
                $store->user->notify(new StoreUnfollowed($store, $user));
                // Alert to user who unfollows
                alert()->success('Has dejado de seguir a '.$store->name);
            }
        } catch (\Throwable $th) {
            alert()->error('Ha ocurrido un error al actualizar tus tiendas a las que sigues');
        }

        return redirect($store->url);
    }
}