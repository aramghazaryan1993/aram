<?php

namespace App\Repositories;

use App\Models\ServiceGallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class ServiceGalleryRepository
 * @package App\Repositories
 * @param string $image
 * @param int $menuId
 * @param int $id
 * @return ServiceGallery
 */
class ServiceGalleryRepository
{
    /**
     * @param int $menuId
     * @return ServiceGallery
     */
    public function getServiceGallery(int $menuId)
    {
        return ServiceGallery::where('menu_id', $menuId)->get();
    }

    /**
     * @param string $image
     * @param int $menuId
     * @return ServiceGallery
     */
    public function addServiceGallery(string $image, int $menuId): ServiceGallery
    {
        if (!empty($image)) {
            if (!filter_var($image, FILTER_VALIDATE_URL)) {
                $data = str_replace('data:image/png;base64,', '', $image);
                try {
                    $gallery = Str::random(10) . '.' . 'webp';
                    Storage::disk('public')->put('service/' . $gallery, base64_decode($data));
                } catch (\Exception $ex) {
                    return response()->json([
                        'errors' => ['gallery' => ['Error while deconding the gallery']],
                        'status' => false,
                    ], 422);
                }
            }
        }
        return ServiceGallery::create(['image' => $gallery, 'menu_id' => $menuId]);
    }

    /**
     * @param string $image
     * @param int $menuId
     * @param int $id
     * @return ServiceGallery
     */
    public function updateServiceGallery(string $image, int $menuId, int $id):ServiceGallery
    {
        $editServiceGallery = ServiceGallery::find($id);

        if (!empty($image)) {
            if (!filter_var($image, FILTER_VALIDATE_URL)) {
                $data = str_replace('data:image/png;base64,', '', $image);
                try {
                    $gallery = Str::random(10) . '.' . 'webp';
                    Storage::disk('public')->put('service/' . $gallery, base64_decode($data));
                } catch (\Exception $ex) {
                    return response()->json([
                        'errors' => ['gallery' => ['Error while deconding the gallery']],
                        'status' => false,
                    ], 422);
                }
            }
        }

        if (Storage::exists('public/service/' . $editServiceGallery->image)) {
            Storage::delete('public/service/' . $editServiceGallery->image);
        }

        $editServiceGallery->image = $gallery;
        $editServiceGallery->menu_id = $menuId;
        $editServiceGallery->save();
        return $editServiceGallery;
    }

    /**
     * @param int $id
     * @return ServiceGallery
     */
    public function deleteServiceGallery(int $id)
    {
        $deleteServiceGallery = ServiceGallery::find($id);
        if (Storage::exists('public/service/' . $deleteServiceGallery->image)) {
            Storage::delete('public/service/' . $deleteServiceGallery->image);
        }
        return $deleteServiceGallery->delete();
    }
}
