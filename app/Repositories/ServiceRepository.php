<?php

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class ServiceRepository
 * @package App\Repositories
 * @param string $title
 * @param string $image
 * @param string $text
 * @param string $textHeader
 * @param string $fullText
 * @param int $menuId
 * @param int $id
 * @return Service
 */
class  ServiceRepository
{
    /**
     * @param string $title
     * @param string $image
     * @param string $text
     * @param string $textHeader
     * @param string $fullText
     * @param int $menuId
     * @return Service
     */
    public function addService(string $title, string $image, string $text, string $textHeader, string $fullText, int $menuId): Service
    {
        if (!empty($image)) {
            if (!filter_var($image, FILTER_VALIDATE_URL)) {
                $data = str_replace('data:image/png;base64,', '', $image);
                try {
                    $serviceImage = Str::random(10) . '.' . 'webp';
                    Storage::disk('public')->put('service/' . $serviceImage, base64_decode($data));
                } catch (\Exception $ex) {
                    return response()->json([
                        'errors' => ['service_image' => ['Error while deconding the service image']],
                        'status' => false,
                    ], 422);
                }
            }
        }
        return Service::create(['title' => $title, 'image' => $serviceImage, 'text' => $text, 'text_header' => $textHeader, 'full_text' => $fullText, 'menu_id' => $menuId]);
    }

    /**
     * @param int $menuId
     * @return Service
     */
    public function getService(int $menuId)
    {
        return Service::where('menu_id',$menuId)->first();
    }

    /**
     * @param string $title
     * @param string $image
     * @param string $text
     * @param string $textHeader
     * @param string $fullText
     * @param int $menuId
     * @param int $id
     * @return Service
     */
    public function updateService(string $title, string $image, string $text, string $textHeader, int $menuId, string $fullText, int $id): Service
    {
        $editService = Service::find($id);

        if (!empty($image)) {
            if (!filter_var($image, FILTER_VALIDATE_URL)) {
                $data = str_replace('data:image/png;base64,', '', $image);
                try {
                    $serviceImage = Str::random(10) . '.' . 'webp';
                    Storage::disk('public')->put('service/' . $serviceImage, base64_decode($data));
                } catch (\Exception $ex) {
                    return response()->json([
                        'errors' => ['service_image' => ['Error while deconding the service image']],
                        'status' => false,
                    ], 422);
                }
            }
        }

        if (Storage::exists('public/service/' . $editService->image)) {
            Storage::delete('public/service/' .$editService->image);
        }

        $editService->title = $title;
        $editService->image = $serviceImage;
        $editService->text = $text;
        $editService->text_header = $textHeader;
        $editService->full_text = $fullText;
        $editService->menu_id = $menuId;
        $editService->save();
        return $editService;
    }

    /**
     * @param int $id
     * @return Service
     */
    public function deleteService(int $id)
    {
        $deleteService = Service::find($id);
        if (Storage::exists('public/service/' . $deleteService->image)) {
            Storage::delete('public/service/' . $deleteService->image);
        }
        return $deleteService->delete();
    }
}
