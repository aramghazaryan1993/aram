<?php

namespace App\Repositories;

use App\Models\AdressMenu;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class AdressMenuRepository
 * @package App\Repositories
 * @param string $name 
 * @param int $menuId 
 * @param int $id 
 * @return AdressMenu
 */

class AdressMenuRepository
{

    /**
     * 
     * @param int $id 
     * @return AdressMenu 
     */
    public function getAdressMenu(int $id)
    {
        return AdressMenu::where('menu_id', $id)->get();
    }

    /**
     * 
     * @param string $name 
     * @param int $menuId 
     * @return AdressMenu 
     */
    public function addAdressMenu(string $name, int $menuId): AdressMenu
    {
        return AdressMenu::create(['name' => $name, 'menu_id' => $menuId]);
    }

    /**
     * 
     * @param string $name 
     * @param int $menuId 
     * @param int $id 
     * @return AdressMenu 
     */
    public function updateAdressMenu(string $name, int $menuId, int $id): AdressMenu
    {
        $editAdressMenu = AdressMenu::find($id);
        $editAdressMenu->name = $name;
        $editAdressMenu->menu_id = $menuId;
        $editAdressMenu->save();
        return $editAdressMenu;
    }

    /**
     * 
     * @param int $id 
     * @return AdressMenu 
     */
    public function deleteAdressMenu(int $id)
    {
        return AdressMenu::where('id', $id)->delete();
    }
}
