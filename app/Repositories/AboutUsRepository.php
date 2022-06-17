<?php

namespace App\Repositories;

use App\Models\AboutUs;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class AboutUsRepository
 * @package App\Repositories
 * @param string $title
 * @param string $miniText
 * @param string $image
 * @param string $text
 * @return AboutUs
 */
class AboutUsRepository
{
    /**
     * @return AboutUs[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAboutUs()
    {
        return AboutUs::all();
    }

    /**
     * @param string $title
     * @param string $miniText
     * @param string $image
     * @param string $text
     * @return AboutUs
     */
    public function updateAboutUs(string $title, string $miniText, string $image, string $text): AboutUs
    {
        $editAboutUs = AboutUs::first();

        if (!empty($image)) {
            if (!filter_var($image, FILTER_VALIDATE_URL)) {
                $data = str_replace('data:image/png;base64,', '', $image);
                try {
                    $aboutImage = Str::random(10) . '.' . 'webp';
                    Storage::disk('public')->put('about_us/' . $aboutImage, base64_decode($data));
                } catch (\Exception $ex) {
                    return response()->json([
                        'errors' => ['about_image' => ['Error while deconding the about']],
                        'status' => false,
                    ], 422);
                }
            }
        }

        if (Storage::exists('public/about_us/' . $editAboutUs->image)) {
            Storage::delete('public/about_us/' . $editAboutUs->image);
        }

        $editAboutUs->title = $title;
        $editAboutUs->mini_text = $miniText;
        $editAboutUs->image = $aboutImage;
        $editAboutUs->text = $text;
        $editAboutUs->save();
        return $editAboutUs;
    }
}
