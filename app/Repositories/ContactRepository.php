<?php
namespace App\Repositories;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;
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
     * @param string $phone
     *
     * @return \App\Models\Contact
     */
    public function update(string $phone, string $email,string $working, string $textHeader, string $textFooter, string $facebook, string $instagram, $logo, $imageHeader): Contact
    {
        $editContact = Contact::first();
        $imgLogo= time().'_'.$logo->getClientOriginalName();
        Storage::disk('public')->put($imgLogo, file_get_contents($logo->getRealPath()));

        if (!empty($logo)) {
            if (!filter_var($logo, FILTER_VALIDATE_URL)) {
                $data = str_replace('data:image/png;base64,', '', $logo);

                try {
                    Storage::disk('public')->put("default/" . $logo, base64_decode($data));

//                    $CustomerEventPayments['signature'] = $logo;
                } catch (\Exception $ex) {
                    return response()->json(['errors' => ['signature' => ['Error while deconding the signature']], 'status' => false], 422);
                }
            }
        }


//        if(Storage::exists('public/'.$imgLogo)){
//            Storage::delete('public/'.$imgLogo);
//        }
//
//        $image = time().'_'.$imageHeader->getClientOriginalName();
//        Storage::disk('public')->put($image, file_get_contents($imageHeader->getRealPath()));
//
//        if(Storage::exists('public/'.$image)){
//            Storage::delete('public/'.$image);
//        }

        $editContact->phone = $phone;
        $editContact->email = $email;
        $editContact->working = $working;
        $editContact->text_header = $textHeader;
        $editContact->text_header = $textHeader;
        $editContact->text_footer = $textFooter;
        $editContact->facebook = $facebook;
        $editContact->instagram = $instagram;
        $editContact->logo = $imgLogo;
//        $editContact->image = $image;
        $editContact->save();
            return $editContact;
    }

    /**
     * @return \App\Models\Contact[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getContact(){
        return Contact::all();
    }
}
