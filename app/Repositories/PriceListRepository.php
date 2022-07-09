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
 *
 * @return \App\Models\PriceList
 * @package App\Repositories
 */
class PriceListRepository
{
    /**
     * @return \App\Models\PriceList[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getPriceList()
    {
        return PriceList::all();
    }

    /**
     * @param string $title
     * @param string $price
     * @param string $text
     *
     * @return \App\Models\PriceList
     */
    public function addPriceList(string $title, string $price, string $text): PriceList
    {
        return PriceList::create(['title' => $title, 'price' => $price, 'text' => $text]);
    }

    /**
     * @param string $title
     * @param string $price
     * @param string $text
     * @param int    $id
     *
     * @return \App\Models\PriceList
     */
    public function editPriceList(string $title, string $price, string $text, int $id): PriceList
    {
        $editPriceList = PriceList::find($id);
        $editPriceList->title = $title;
        $editPriceList->price = $price;
        $editPriceList->text = $text;
        $editPriceList->save();
        return $editPriceList;
    }
}
