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
    public function update(string $phone, string $email,string $working, string $textHeader, string $textFooter, string $facebook, string $instagram, $logo, $logoFooter): Contact
    {
        $editContact = Contact::first();
        $imgLogo= time().'_'.$logo->getClientOriginalName();
        Storage::disk('public')->put($imgLogo, file_get_contents($logo->getRealPath()));

        if(Storage::exists('public/'.$imgLogo)){
            Storage::delete('public/'.$imgLogo);
        }

        $imageFooter = time().'_'.$logoFooter->getClientOriginalName();
        Storage::disk('public')->put($imageFooter, file_get_contents($logoFooter->getRealPath()));

        if(Storage::exists('public/'.$imageFooter)){
            Storage::delete('public/'.$imageFooter);
        }

        $editContact->phone = $phone;
        $editContact->email = $email;
        $editContact->working = $working;
        $editContact->text_header = $textHeader;
        $editContact->text_header = $textHeader;
        $editContact->text_footer = $textFooter;
        $editContact->facebook = $facebook;
        $editContact->instagram = $instagram;
        $editContact->logo = $imgLogo;
        $editContact->image = $imageFooter;
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
