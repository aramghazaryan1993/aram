<?php

namespace App\Repositories;

use App\Models\PriceList;

/**
 * Class PriceListRepository
 *
 * @param string $title
 * @param string $price
 * @param string $text
 * @param int    $id
 * @param int    $menuId
 *
 * @return \App\Models\PriceList
 * @package App\Repositories
 */
class PriceListRepository
{
    /**
     * @param int $menuId
     *
     * @return PriceList
     */
    public function getPriceList(int $menuId)
    {
        return PriceList::where('menu_id', $menuId)->get();
    }

    /**
     * @param string $title
     * @param string $price
     * @param string $text
     * @param int $menuId
     *
     * @return \App\Models\PriceList
     */
    public function addPriceList(string $title, string $price, string $text, int $menuId): PriceList
    {
        return PriceList::create(['title' => $title, 'price' => $price, 'text' => $text, 'menu_id' => $menuId]);
    }

    /**
     * @param string $title
     * @param string $price
     * @param string $text
     * @param int    $id
     * @param int    $menuId
     *
     * @return \App\Models\PriceList
     */
    public function editPriceList(string $title, string $price, string $text, int $menuId, int $id): PriceList
    {
        $editPriceList = PriceList::find($id);
        $editPriceList->title = $title;
        $editPriceList->price = $price;
        $editPriceList->text = $text;
        $editPriceList->menu_id = $menuId;
        $editPriceList->save();
        return $editPriceList;
    }


    /**
     * @param $id
     *
     * @return PriceList
     */
    public function deletePriceList($id)
    {
        $deletePriceList = PriceList::find($id);

        return $deletePriceList->delete();
    }
}
