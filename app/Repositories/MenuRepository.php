<?php
namespace App\Repositories;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

/**
 * Class MenuRepository
 *
 * @param string $menu
 *
 * @return Menu
 * @package App\Repositories
 */
class MenuRepository
{
    /**
     * @return \App\Models\Menu[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getMenu(){
        return Menu::getList();
    }

}
