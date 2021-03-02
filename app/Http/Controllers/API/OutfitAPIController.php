<?php

namespace App\Http\Controllers\API;

use Response;
use App\Models\Outfit;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\OutfitRepository;
use App\Http\Controllers\AppBaseController;
use App\Notifications\OutfitAddedToWishlist;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Http\Requests\API\CreateOutfitAPIRequest;
use App\Http\Requests\API\UpdateOutfitAPIRequest;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;

/**
 * Class OutfitController
 * @package App\Http\Controllers\API
 */

class OutfitAPIController extends \App\Http\Controllers\Controller
{


  public function store(CreateOutfitAPIRequest $request)
  {
    $input = $request->all();

    $productsInput = collect($input['products_ids']);
    $productsIds = $productsInput->pluck('productId');
    unset($input['products_ids']);
    if (!isset($productsIds) || empty($productsIds)) {
      return $this->sendError('Se requiere subir al menos un producto en el outfit');
    }

    if (!isset($input['media']) || empty($input['media'])) {
      return $this->sendError('Se requiere subir al menos una imagen');
    }

    $input['store_id'] = auth('api')->user()->store->id;

    $media = ($input['media']); // [color => [img1,img2,vd1]]
    unset($input['media']);


    $products = Product::whereIn('id', $productsIds)->get();
    $input['final_price'] = $products->sum('final_price');
    $outfit = Outfit::create($input);

    $productRelatedData = $productsInput->mapWithKeys(function ($p) {
      return [
        $p['productId'] => ['order' => $p['order']]
      ];
    });
    $outfit->products()->sync($productRelatedData);

    if (!empty($media)) {
      foreach ($media as $keyName => $path) {
        if (!empty($path)) {
          $outfit->saveImage($keyName, $path);
        }
      }
    }

    return $outfit;
  }



  public function update($id, UpdateOutfitAPIRequest $request)
  {
    $input = $request->all();

    $outfit = Outfit::find($id);

    if (empty($outfit)) {
      return $this->sendError('Outfit no encontrad@');
    }

    $productsInput = collect($input['products_ids']);
    $productsIds = $productsInput->pluck('productId');
    unset($input['products_ids']);
    if (!isset($productsIds) || empty($productsIds)) {
      return $this->sendError('Se requiere subir al menos un producto en el outfit');
    }

    if (!isset($input['media']) || empty($input['media'])) {
      return $this->sendError('Se requiere subir al menos una imagen');
    }

    $input['store_id'] = auth('api')->user()->store->id;

    $media = ($input['media']); // [color => [img1,img2,vd1]]
    unset($input['media']);

    $productRelatedData = $productsInput->mapWithKeys(function ($p) {
      return [
        $p['productId'] => ['order' => $p['order']]
      ];
    });
    $outfit->products()->sync($productRelatedData);
    $input['final_price'] = $outfit->products->sum('final_price');
    $outfit->update($input);

    $outfit = $outfit->fresh();


    if (!empty($media)) {
      foreach ($media as $keyName => $path) {
        if (!empty($path)) {

          $hasChanged = true;
          foreach ($outfit->all_media as $image) {

            if (
              $image->hasCustomProperty('key')
              && $image->getCustomProperty('key') == $keyName
            ) {
              if ($image->getFullUrl() == $path) { // Has not changed
                $hasChanged = false;
                continue;
              }
              $image->delete();
            }
          }
          if (!$hasChanged) {
            continue;
          }

          $outfit->saveImage($keyName, $path);
        }
      }



      foreach ($outfit->all_media as $media) {

        $keyToFind = $media->getCustomProperty('key');
        $deleted = true;

        foreach ($media as $key => $path) {

          if ($keyToFind == $key) {
            $deleted = false;
          }
        }

        if ($deleted) {
          $media->delete();
        }
      }
    }

    return $outfit;
  }


  public function destroy($id)
  {
    /** @var Outfit $outfit */
    $outfit = $this->outfitRepository->findWithoutFail($id);

    if (empty($outfit)) {
      return $this->sendError('Outfit not found');
    }

    $outfit->delete();

    return $this->sendResponse($id, 'Outfit ha sido eliminado');
  }


  public function toggleFavorite($id)
  {
    if (!auth('api')->check()) {
      return $this->sendError('Inicia sesión para activar tu lista de deseados');
    }

    $user = auth('api')->user();

    $outfit = Outfit::find($id);

    // * If any product not in favorites, add all
    if (!$outfit->is_favorited) {
      foreach ($outfit->products as $key => $product) {
        // * only add & notify if not added before
        if (!$user->hasFavorited($product)) {
          $user->toggleFavorite($product);
        }
      }
      $user->notify(new OutfitAddedToWishlist($outfit));
    } else {
      // * if All favorited, remove all
      foreach ($outfit->products as $key => $product) {
        $product = Product::find($id);

        // * only add if added before somehow
        if ($user->hasFavorited($product)) {
          $user->toggleFavorite($product);
        }
      }
    }

    return $this->sendResponse(['is_favorite' => $outfit->isFavorited()], 'Producto agregado/borrado de lista de deseados');
  }
}
