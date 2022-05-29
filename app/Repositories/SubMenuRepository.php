<?php
namespace App\Repositories;
use App\Models\SubMenu;
/**
 * Class MenuRepository
 *
 * @param string $subMenu
 *
 * @return SubMenu
 *@package App\Repositories
 */
class SubMenuRepository
{
    /**
     * @return \App\Models\SubMenu[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getSubMenu(){
        return SubMenu::all();
    }

}
