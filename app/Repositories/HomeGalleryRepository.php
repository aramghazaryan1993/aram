<?php

namespace App\Repositories;

use App\Models\HomeGallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class HomeGalleryRepository
 * @package App\Repositories
 * @param string $image
 * @param int    $id
 * @return HomeGallery
 */

class HomeGalleryRepository
{
    /**
     * @return \App\Models\HomeGallery[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getHomeGallery()
    {
        return HomeGallery::all();
    }

    /**
     * @param string $image
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addHomeGallery(string $image): HomeGallery
    {
        if (!empty($image)) {
            if (!filter_var($image, FILTER_VALIDATE_URL)) {
                $data = str_replace('data:image/png;base64,', '', $image);
                try {
                    $homeGallery = Str::random(10) . '.' . 'webp';
                    Storage::disk('public')->put('home_gallery/' . $homeGallery, base64_decode($data));
                } catch (\Exception $ex) {
                    return response()->json([
                        'errors' => ['image' => ['Error while deconding the image']],
                        'status' => false,
                    ], 422);
                }
            }
        }

        return HomeGallery::create(['image' => $homeGallery]);
    }

    /**
     * @param string $image
     * @param int    $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateHomeGallery(string $image, int $id): HomeGallery
    {
        if (!empty($image)) {
            if (!filter_var($image, FILTER_VALIDATE_URL)) {
                $data = str_replace('data:image/png;base64,', '', $image);
                try {
                    $homeGallery = Str::random(10) . '.' . 'webp';
                    Storage::disk('public')->put('home_gallery/' . $homeGallery, base64_decode($data));
                } catch (\Exception $ex) {
                    return response()->json([
                        'errors' => ['image' => ['Error while deconding the image']],
                        'status' => false,
                    ], 422);
                }
            }
        }

        $editHomeGallery = HomeGallery::find($id);

        if (Storage::exists('home_gallery/' . $editHomeGallery->image)) {
            Storage::delete('home_gallery/' . $editHomeGallery->image);
        }

        $editHomeGallery->image = $homeGallery;
        $editHomeGallery->save();
        return $editHomeGallery;
    }

    /**
     * @param int $id
     *
     * @return HomeGallery
     */
    public function deleteHomeGallery(int $id)
    {
        $deleteHomeGallery = HomeGallery::find($id);
        if (Storage::exists('home_gallery/' . $deleteHomeGallery->image)) {
            Storage::delete('home_gallery/' . $deleteHomeGallery->image);
        }
        return $deleteHomeGallery->delete();
    }
}
