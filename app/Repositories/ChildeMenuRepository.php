<?php
namespace App\Repositories;
use App\Models\ChildeMenu;
/**
 * Class MenuRepository
 *
 * @param string $ChildeMenu
 *
 * @return ChildeMenu
 *@package App\Repositories
 */
class ChildeMenuRepository
{
    /**
     * @return \App\Models\ChildeMenu[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getChildeMenu(){
        return ChildeMenu::all();
    }

}
