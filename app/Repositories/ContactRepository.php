<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class ProductRepository
 *
 * @param string $phone
 *
 * @return Contact
 *@package App\Repositories
 */
class ContactRepository
{
    /**
     * @param int $count
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function createFakeContact(int $count)
    {
        return Contact::factory()->count($count)->create();
    }


    /**
     * 
     * @param string $phone 
     * @param string $email 
     * @param string $working 
     * @param string $textHeader 
     * @param string $textFooter 
     * @param string $facebook 
     * @param string $instagram 
     * @param mixed $logo 
     * @param mixed $imageHeader 
     * @return Contact 
     * @throws BindingResolutionException 
     */
    public function update(string $phone, string $email, string $working, string $textHeader, string $textFooter, string $facebook, string $instagram, $logo, $imageHeader): Contact
    {

        $editContact = Contact::first();

        if (!empty($logo)) {
            if (!filter_var($logo, FILTER_VALIDATE_URL)) {
                $data = str_replace('data:image/png;base64,', '', $logo);
                try {
                    $logoImage = Str::random(10) . '.' . 'webp';
                    Storage::disk('public')->put('default/' . $logoImage, base64_decode($data));
                } catch (\Exception $ex) {
                    return response()->json(['errors' => ['logo' => ['Error while deconding the logo']], 'status' => false], 422);
                }
            }
        }

        if (!empty($imageHeader)) {
            if (!filter_var($imageHeader, FILTER_VALIDATE_URL)) {
                $data = str_replace('data:image/png;base64,', '', $imageHeader);
                try {
                    $image = Str::random(10) . '.' . 'webp';
                    Storage::disk('public')->put('default/' . $logoImage, base64_decode($data));
                } catch (\Exception $ex) {
                    return response()->json(['errors' => ['image' => ['Error while deconding the image']], 'status' => false], 422);
                }
            }
        }

        $editContact->phone = $phone;
        $editContact->email = $email;
        $editContact->working = $working;
        $editContact->text_header = $textHeader;
        $editContact->text_header = $textHeader;
        $editContact->text_footer = $textFooter;
        $editContact->facebook = $facebook;
        $editContact->instagram = $instagram;
        $editContact->logo = $logoImage;
        $editContact->image = $image;
        $editContact->save();
        return $editContact;
    }

    /**
     * @return \App\Models\Contact[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getContact()
    {
        return Contact::all();
    }
}
