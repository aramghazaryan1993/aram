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
    public function update(string $phone, string $email,string $working, string $textHeader, string $textFooter, string $facebook, string $instagram, $logoHeader, $logoFooter): Contact
    {
        $editContact = Contact::first();
        $imageHeader = time().'_'.$logoHeader->getClientOriginalName();
        Storage::disk('public')->put($imageHeader, file_get_contents($logoHeader->getRealPath()));

        if(Storage::exists('public/'.$imageHeader)){
            Storage::delete('public/'.$imageHeader);
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
        $editContact->logo_header = $imageHeader;
        $editContact->logo_footer = $imageFooter;
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
