<?php

namespace App\Repositories;

use App\Models\SelectHomeService;

/**
 * Class SelectHomeServiceRepository
 *
 * @param int    $id
 * @param int    $menuID
 *
 * @return \App\Models\SelectHomeService
 * @package App\Repositories
 */
class SelectHomeServiceRepository
{
    /**
     * @return \App\Models\SelectHomeService[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getSelectHomeService()
    {
        return SelectHomeService::select('services.title','services.image', 'services.text', 'services.text_header', 'menus.type')
            ->join('menus', 'select_home_services.menu_id', '=', 'menus.id')
            ->join('services', 'select_home_services.menu_id', '=', 'services.menu_id')
            ->get();
    }

    /**
     * @param int $id
     * @param int $menuID
     *
     * @return \App\Models\SelectHomeService
     */
    public function updateSelectHomeService(int $menuID, int $id): SelectHomeService
    {
        $editSelectHomeService = SelectHomeService::find($id);
        $editSelectHomeService->menu_id = $menuID;
        $editSelectHomeService->save();
        return $editSelectHomeService;
    }
}
