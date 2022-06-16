<?php
namespace App\Repositories;

use App\Models\ServiceHeaderImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * class ServiceHeaderImageRepository
 * @package App\Repositories
 * @param string $image
 * @param int $menuId
 * @param int $id
 * @returns  ServiceHeaderImage
 */
class ServiceHeaderImageRepository
{
    /**
     * @param int $menuId
     * @return ServiceHeaderImage
     */
    public function getServiceHeaderImage(int $menuId)
    {
        return ServiceHeaderImage::where('menu_id', $menuId)->get();
    }

    /**
     * @param string $image
     * @param int $menuId
     * @return ServiceHeaderImage
     */
    public function addServiceHomeImage(string $image, int $menuId): ServiceHeaderImage
    {
        if (!empty($image)) {
            if (!filter_var($image, FILTER_VALIDATE_URL)) {
                $data = str_replace('data:image/png;base64,', '', $image);
                try {
                    $imageHeader = Str::random(10) . '.' . 'webp';
                    Storage::disk('public')->put('service/' . $imageHeader, base64_decode($data));
                } catch (\Exception $ex) {
                    return response()->json([
                        'errors' => ['header_image' => ['Error while deconding the header image']],
                        'status' => false,
                    ], 422);
                }
            }
        }
        return ServiceHeaderImage::create(['image' => $imageHeader, 'menu_id' => $menuId]);
    }

    /**
     * @param string $image
     * @param int $menuId
     * @param int $id
     * @return ServiceHeaderImage
     */
    public function updateServiceHeaderImage(string $image, int $menuId, int $id): ServiceHeaderImage
    {
        $editServiceHeaderImage = ServiceHeaderImage::find($id);

        if (!empty($image)) {
            if (!filter_var($image, FILTER_VALIDATE_URL)) {
                $data = str_replace('data:image/png;base64,', '', $image);
                try {
                    $headerImage = Str::random(10) . '.' . 'webp';
                    Storage::disk('public')->put('service/' . $headerImage, base64_decode($data));
                } catch (\Exception $ex) {
                    return response()->json([
                        'errors' => ['header_image' => ['Error while deconding the header image']],
                        'status' => false,
                    ], 422);
                }
            }
        }

        if (Storage::exists('public/service/' . $editServiceHeaderImage->image)) {
            Storage::delete('public/service/' . $editServiceHeaderImage->image);
        }

        $editServiceHeaderImage->image = $headerImage;
        $editServiceHeaderImage->menu_id = $menuId;
        $editServiceHeaderImage->save();
        return $editServiceHeaderImage;
    }

    /**
     * @param int $id
     * @return ServiceHeaderImage
     */
    public function deleteServiceHeaderImage(int $id)
    {
        $deleteServiceHeaderImage = ServiceHeaderImage::find($id);
        if (Storage::exists('public/service/' . $deleteServiceHeaderImage->image)) {
            Storage::delete('public/service/' . $deleteServiceHeaderImage->image);
        }
        return $deleteServiceHeaderImage->delete();
    }
}
