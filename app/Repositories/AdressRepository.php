<?php

namespace App\Repositories;

use App\Models\Adress;

/**
 * Class AdressRepository
 * @package App\Repositories
 * @param string $map
 * @param string $text
 * @param int $adressMenuId
 * @return Adress
 */
class AdressRepository
{
    /**
     * @param $adressMenuId
     *
     * @return Adress
     */
    public function getAdress(int $adressMenuId)
    {
        return Adress::select('adress.id', 'adress.map', 'adress.text', 'adress_menus.url', 'adress.adress_menu_id', 'adress_menus.name')
        ->join('adress_menus','adress.adress_menu_id', '=', 'adress_menus.id')
        ->where('adress.id', $adressMenuId)->get();
    }

    /**
     * @param string $map
     * @param string $text
     * @param int    $adressMenuId
     *
     * @return \App\Models\Adress
     */
    public function addAdress(string $map, string $text, int $adressMenuId): Adress
    {
        return Adress::create([ 'map' => $map, 'text' => $text, 'adress_menu_id' => $adressMenuId ]);
    }

    /**
     * @param string $map
     * @param string $text
     * @param int    $id
     *
     * @return \App\Models\Adress
     */
    public function updateAdress(string $map, string $text, int $id): Adress
    {
        $editAdress = Adress::find($id);
        $editAdress->map = $map;
        $editAdress->text = $text;
        $editAdress->save();
        return  $editAdress;
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function deleteAdress(int $id)
    {
        return Adress::find($id)->delete();
    }
}
